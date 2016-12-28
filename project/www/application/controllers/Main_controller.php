<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends MY_Controller
{
	/**
	 *  Данные контроллера.
	 *  
	 *  @var  array
	 */
	protected $data = [];

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Главная страница сайта.
	 *  
	 *  @return  void
	 */
	public function index()
	{
		// Подключение зависимостей.
		$this->load();

		// Заголовок.
		$this->data['meta'] = [
			'title'       => $this->get_title(),
			'description' => $this->get_description()
		];
		
		// Фильтры, указанные к урокам.
		$techs = get_techs_data($this->techs_model->get_techs());

		$this->data['techs'] = [
			'list' => $techs,
			'count' => get_techs_count(count($techs)),
			'list_with_image' => get_techs_with_image($techs)
		];

		// Авторы уроков.
		$users = get_users_data($this->users_model->get_users());

		$this->data['authors'] = [
			'list'  => array_slice($users, 0, 30),
			'count' => get_users_count(count($users)),
			'best' => get_users_data($this->users_model->get_best_users())
		];

		// Пользователи для обратной связи.
		$feedback = $this->users_model->get_feedback_users();

		$this->data['feedback'] = [
			'list' => get_users_data($feedback)
		];
		
		$this->parser->parse('index', $this->get_render_index());
	}

	/**
	 *  Компоненты главной страницы.
	 *  
	 *  @return  array
	 */
	private function get_render_index()
	{
		return [
			'meta'      => $this->get_render_meta($this->data['meta']),
			'scroller'  => $this->get_render_scroller(),
			'preloader' => $this->get_render_preloader(),
			'menu'      => $this->get_render_menu(['url' => site_url()]),
			'header'    => $this->get_render_header(),
			'main'      => $this->get_render_main($this->data['authors']),
			'courses'   => $this->get_render_courses(),
			'techs'     => $this->get_render_techs($this->data['techs']),
			'authors'   => $this->get_render_authors($this->data['authors']),
			'feedback'  => $this->get_render_feedback($this->data['feedback']),
			'footer'    => $this->get_render_footer(),
			'templates' => $this->get_render_templates($this->data['techs']),
			'scripts'   => $this->get_render_scripts()
		];
	}

	/**
	 *  Подключение зависимостей.
	 *  
	 *  @return  void
	 */
	private function load()
	{
		$this->load->library('parser');
		$this->load->model('techs_model');
		$this->load->model('users_model');
	}
}

/* End of file Main_controller.php */
/* Location: ./application/controllers/Main_controller.php */