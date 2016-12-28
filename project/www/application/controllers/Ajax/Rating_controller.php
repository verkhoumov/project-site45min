<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Оценка урока.
	 *  
	 *  @return  void
	 */
	public function set_rating()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->set_rating__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$course_id = (int) $this->input->post('course_id');
		$rating = (int) $this->input->post('rating');

		if ($rating < 1 || $rating > 5)
		{
			return FALSE;
		}

		// Изменение рейтинга.
		$new_rating = $this->courses_model->update_course_rating($course_id, $rating);

		if ($new_rating)
		{
			$result = [
				'status' => 200,
				'course_id' => $course_id,
				'course_rating' => $new_rating
			];
		}

		// Ответ на запрос.
		$this->reply($result);
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function set_rating__default()
	{
		return [
			'status' => 400,
			'course_id' => 0,
			'course_rating' => 0
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
		$this->load->model('courses_model');
	}
}

/* End of file Rating_controller.php */
/* Location: ./application/controllers/Ajax/Rating_controller.php */