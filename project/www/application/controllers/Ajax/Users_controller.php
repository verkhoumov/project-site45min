<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Получение информации о пользователе.
	 *  
	 *  @return  void
	 */
	public function get_user()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_user__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$user_id = (int) $this->input->post('document_id');
		$data = $this->users_model->get_user_by_id($user_id);

		if (!empty($data['user']))
		{
			$data['user']     = get_user_data($data['user']);
			$data['techs']    = get_techs_data($data['techs']);
			$data['contacts'] = get_contacts_data($data['contacts']);
			$data['courses']  = get_courses_data($data['courses']);

			$result['status'] = 200;
			$result = array_replace_recursive($result, $data);
		}

		// Ответ на запрос.
		$this->reply($result);
	}

	/**
	 *  Получение списка пользователей.
	 *  
	 *  @return  void
	 */
	public function get_users_list()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_users_list__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		/**
		 *  Работа с данными.
		 */
		$users = $this->users_model->get_users();

		if (!empty($users))
		{
			$result = [
				'status' => 200,
				'users' => get_users_data($users)
			];
		}

		/**
		 *  Ответ на запрос.
		 */
		$this->reply($result);
	}

	/**
	 *  Получение списка пользователей для формы обратной связи.
	 *  
	 *  @return  void
	 */
	public function get_users_feedback()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_users_feedback__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		$data = $this->users_model->get_feedback_users();

		if (!empty($data))
		{
			$result = [
				'status' => 200,
				'users' => get_users_data($data)
			];
		}

		$this->reply($result);
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_user__default()
	{
		return [
			'status' => 400,
			'user' => [
				'id'     => 0,
				'name'   => NULL,
				'city'   => NULL,
				'about'  => NULL,
				'avatar' => NULL,
				'date'   => NULL
			],
			'techs'    => [],
			'contacts' => [
				'link'     => [],
				'email'    => [],
				'skype'    => [],
				'personal' => []
			],
			'courses'  => []
		];
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_users_list__default()
	{
		return [
			'status' => 400,
			'users' => []
		];
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_users_feedback__default()
	{
		return [
			'status' => 400,
			'users' => []
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
		$this->load->model('users_model');
	}
}

/* End of file Users_controller.php */
/* Location: ./application/controllers/Ajax/Users_controller.php */