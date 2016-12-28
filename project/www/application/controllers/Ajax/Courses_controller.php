<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Информация об уроке.
	 *  
	 *  @return  void
	 */
	public function get_course()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_course__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$course_id = (int) $this->input->post('document_id');
		$data = $this->courses_model->get_course_by_id($course_id);

		if (!empty($data['course']))
		{
			$data['course'] = get_course_data($data['course']);
			$data['techs'] = get_techs_data($data['techs']);
			$data['courses'] = get_courses_data($data['courses']);

			$result['status'] = 200;
			$result = array_replace_recursive($result, $data);
		}

		// Ответ на запрос.
		$this->reply($result);
	}

	/**
	 *  Получение списка уроков.
	 *  
	 *  @return  void
	 */
	public function get_courses_list()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_courses_list__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$offset    = (int) $this->input->post('offset');
		$limit     = (int) $this->input->post('limit');
		$filter_in = (array) $this->input->post('filter_in');

		$data = $this->courses_model->get_courses($offset, $limit, [], $filter_in);

		if (!empty($data['courses']))
		{
			$result = [
				'status'        => 200,
				'courses'       => get_courses_data($data['courses']),
				'courses_count' => $data['courses_count'],
				'best_authors'  => get_users_data($data['best_authors'])
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
	private function get_course__default()
	{
		return [
			'status' => 400,
			'course' => [
				'id'          => 0,
				'title'       => NULL,
				'description' => NULL,
				'link'        => NULL,
				'image'       => NULL,
				'video'       => NULL,
				'duration'    => 0,
				'rating'      => 0,
				'example'     => NULL,
				'sources'     => NULL,
				'date'        => NULL,
				'user_id'     => 0,
				'user_name'   => NULL,
				'user_avatar' => NULL
			],
			'techs'   => [],
			'courses' => []
		];
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_courses_list__default()
	{
		return [
			'status'        => 400,
			'courses'       => [],
			'courses_count' => 0,
			'best_authors'  => []
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

/* End of file Courses_controller.php */
/* Location: ./application/controllers/Ajax/Courses_controller.php */
