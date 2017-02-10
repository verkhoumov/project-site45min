<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Обработчик AJAX-запроса на отправку сообщения 
	 *  через форму обратной связи.
	 *  
	 *  @return  void
	 */
	public function send_message()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->send_message__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$data = (array) $this->input->post('feedback');

		// Если получены данные через AJAX-запрос.
		if (!empty($data))
		{
			// Передаём входящие данные в обработчик.
			$feedback = $this->try_send_message($data);
			$result = array_replace_recursive($result, $feedback);
		}

		// Ответ на запрос.
		$this->reply($result);
	}

	/**
	 *  Попытка отправить сообщение автору урока или тех. поддержке.
	 *  
	 *  @param   array   $data  [Данные]
	 *  @return  array
	 */
	private function try_send_message($data = [])
	{
		$data   = $this->get_feedback_data($data);
		$errors = $this->get_feedback_errors($data);
		$status = 400;

		// Если форма обратной связи прошла валидацию,
		// отправляем сообщение.
		if (empty($errors))
		{
			$message = $this->parser->parse('email/feedback', $data + ['url' => site_url()], TRUE);

			$this->email->initialize(['mailtype' => 'html', 'protocol' => 'sendmail']);
			$this->email->from($this->_config['support']['email'], $this->_config['title']);
			$this->email->to($data['to']);
			$this->email->subject('Личное сообщение');
			$this->email->message(nl2br($message));
			
			if ($this->email->send())
			{
				$status = 200;

				$this->feedback_model->set_feedback($data);
			}
		}

		return [
			'form' => $data,
			'errors' => $errors,
			'status' => $status
		];
	}

	/**
	 *  Обработка данных формы обратной связи.
	 *  
	 *  @param   array   $data  [Данные]
	 *  @return  array
	 */
	private function get_feedback_data($data = [])
	{
		// Прогоняем через обычный обработчик.
		$data = get_feedback_data($data);

		// В значение 'to' подставляем Email получателя.
		$data['to'] = $this->get_email_by_id($data['to']);

		return $data;
	}

	/**
	 *  Получение Email получателя по ID.
	 *  
	 *  @param   integer  $id  [ID получателя]
	 *  @return  string
	 */
	private function get_email_by_id($id = 0)
	{
		$id = (integer) $id;

		$result = '';

		// Техническая поддержка.
		if ($id == 0)
		{
			$result = $this->_config['support']['email'];
		}
		else
		{
			// Автор урока.
			$authors = $this->users_model->get_feedback_users(TRUE);

			if (!empty($authors) && array_key_exists($id, $authors))
			{
				$result = $authors[$id]['email'];
			}
		}

		return $result;
	}

	/**
	 *  Валидация данных формы обратной связи.
	 *  
	 *  @param   array   $data  [Данные из формы]
	 *  @return  array
	 */
	private function get_feedback_errors($data = [])
	{
		$data = (array) $data;
		$errors = [];

		if (!isset($data['name']) || mb_strlen($data['name'], 'UTF-8') < 2 || mb_strlen($data['name'], 'UTF-8') > 50)
		{
			$errors['name'] = 'Имя должно быть длинной не менее 2 и не более 50 символов.';
		}

		if (!isset($data['from']) || !filter_var($data['from'], FILTER_VALIDATE_EMAIL))
		{
			$errors['from'] = 'Адрес электронной почты указан неверно!';
		}

		if (!isset($data['to']) || !filter_var($data['to'], FILTER_VALIDATE_EMAIL))
		{
			$errors['to'] = 'Выбранный Вами получатель не существует!';
		}

		if (!isset($data['theme']) || mb_strlen($data['theme'], 'UTF-8') < 5 || mb_strlen($data['theme'], 'UTF-8') > 50)
		{
			$errors['theme'] = 'Тема сообщения должна быть длинной не менее 5 и не более 50 символов.';
		}

		if (!isset($data['message']) || mb_strlen($data['message'], 'UTF-8') < 10 || mb_strlen($data['message'], 'UTF-8') > 1000)
		{
			$errors['message'] = 'Текст сообщения должен быть длинной не менее 10 и не более 1000 символов.';
		}

		return $errors;
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function send_message__default()
	{
		return [
			'status' => 400,
			'form' => [
				'name'    => NULL,
				'from'    => NULL,
				'to'      => 0,
				'theme'   => NULL,
				'message' => NULL
			],
			'errors' => []
		];
	}

	// ------------------------------------------------------------------------

	/**
	 *  Подключение зависимостей.
	 *  
	 *  @return  void
	 */
	private function load()
	{
		$this->load->library('parser');
		$this->load->model('feedback_model');
		$this->load->library('email');
		$this->load->model('users_model');
	}
}

/* End of file Feedback_controller.php */
/* Location: ./application/controllers/Ajax/Feedback_controller.php */