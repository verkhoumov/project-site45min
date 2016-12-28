<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techs_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Информация о технологии.
	 *  
	 *  @return  void
	 */
	public function get_tech()
	{
		// Подключение зависимостей.
		$this->load();

		// Ответ на запрос по-умолчанию.
		$result = $this->get_tech__default();

		// Проверка AJAX-запроса.
		if (!$this->input->is_ajax_request())
		{
			return;
		}

		// Работа с данными.
		$tech_id = (int) $this->input->post('document_id');
		$data = $this->techs_model->get_tech_by_id($tech_id);

		if (!empty($data['tech']))
		{
			$data['tech'] = get_tech_data($data['tech']);
			$data['users'] = get_users_data($data['users']);
			$data['courses'] = get_courses_data($data['courses']);

			$result['status'] = 200;
			$result = array_replace_recursive($result, $data);
		}

		// Ответ на запрос.
		$this->reply($result);
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_tech__default()
	{
		return [
			'status' => 400,
			'tech' => [
				'id'           => 0,
				'code'         => NULL,
				'name'         => NULL,
				'link'         => NULL,
				'description'  => NULL,
				'image'        => NULL,
				'image_status' => FALSE,
				'date'         => NULL
			],
			'users'   => [],
			'courses' => []
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
		$this->load->model('techs_model');
	}
}

/* End of file Techs_controller.php */
/* Location: ./application/controllers/Ajax/Techs_controller.php */