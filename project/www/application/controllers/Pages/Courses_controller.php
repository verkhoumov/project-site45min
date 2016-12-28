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
	 *  Обработчик страницы с уроком.
	 *  
	 *  @param   integer  $id    [ID урока]
	 *  @param   string   $link  [Ссылка на урок]
	 *  @return  void
	 */
	public function index($id = 0, $link = '')
	{
		$id   = (integer) $id;
		$link = (string) $link;

		// Подключение зависимостей.
		$this->load();

		// Данные по-умолчанию.
		$default = $this->get_course__default();

		// Проверка входных данных.
		if ($id <= 0 || $link == '')
		{
			$this->error();
		}

		// Получаем информацию об уроке.
		$data = $this->courses_model->get_course_by_id($id, ['link' => $link]);

		if (empty($data['course']))
		{
			$this->error();
		}

		// Данные об уроке.
		$this->data['course'] = [
			'course'  => get_course_data($data['course']),
			'techs'   => get_techs_data($data['techs']),
			'courses' => get_courses_data($data['courses'])
		];

		$this->data['course'] = array_replace_recursive($default, $this->data['course']);

		// Заголовок.
		$this->data['meta'] = [
			'title'       => $this->get_title($this->data['course']['course']['title']),
			'description' => $this->data['course']['course']['description']
		];

		$this->parser->parse('pages/courses/index', $this->get_render_index());
	}

	/**
	 *  Компоненты страницы.
	 *  
	 *  @return  array
	 */
	private function get_render_index()
	{
		return [
			'meta'      => $this->get_render_meta($this->data['meta']),
			'preloader' => $this->get_render_preloader(),
			'menu'      => $this->get_render_menu(['url' => site_url()]),
			'course'    => $this->get_render_course($this->data['course']),
			'footer'    => $this->get_render_footer(),
			'templates' => $this->get_render_templates([], ['modal_course', 'modal_tech', 'modal_user']),
			'scripts'   => $this->get_render_scripts()
		];
	}

	/**
	 *  Шаблон с информацией об уроке.
	 *  
	 *  @param   array   $data  [Данные по уроку]
	 *  @return  string
	 */
	private function get_render_course($data = [])
	{
		return $this->parser->parse('pages/courses/course', (array) $data, TRUE);
	}

	/**
	 *  Данные по-умолчанию.
	 *  
	 *  @return  array
	 */
	private function get_course__default()
	{
		return [
			'course' => [
				'id'          => 0,
				'title'       => NULL,
				'title_page'  => NULL,
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
	 *  Подключение зависимостей.
	 *  
	 *  @return  void
	 */
	private function load()
	{
		$this->load->model('courses_model');
		$this->load->model('users_model');
		$this->load->library('parser');
	}
}

/* End of file Courses_controller.php */
/* Location: ./application/controllers/Pages/Courses_controller.php */