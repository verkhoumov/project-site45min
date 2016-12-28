<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/**
	 *  Массив с параметрами из конфига.
	 *  
	 *  @var  array
	 */
	protected $_config = [];

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// Конфиги.
		$this->_config = $this->config->item('site');
	}

	// ------------------------------------------------------------------------

	/**
	 *  Ручной запуск страницы с 404 ошибкой.
	 *  
	 *  @param   string  $page  [Страница]
	 *  @return  void
	 */
	protected function error($page = '')
	{
		$page = (string) $page;

		if (empty($page))
		{
			$page = '/page-not-found';
		}

		redirect($page);
	}

	/**
	 *  Генерация заголовка страницы.
	 *  
	 *  @param   string  $data  [Подставляемая часть заголовка]
	 *  @return  string
	 */
	protected function get_title($data = '')
	{
		return get_title($data, $this->_config['title']);
	}

	/**
	 *  Генерация описания страницы.
	 *  
	 *  @param   string  $data  [Собственное описание]
	 *  @return  string
	 */
	protected function get_description($data = '')
	{
		return $this->_config['description'];
	}

	// ------------------------------------------------------------------------

	/**
	 *  Ответ на запрос.
	 *  
	 *  @param   array   $result  [Итоговые данные]
	 *  @return  void
	 */
	protected function reply($result = [])
	{
		echo json_encode($result);
	}

	// ------------------------------------------------------------------------

	/**
	 *  Мета-теги страницы, заголовок, описание.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_meta($data = [])
	{
		return $this->parser->parse('meta', (array) $data, TRUE);
	}

	/**
	 *  Скроллинг в начало страницы.
	 *  
	 *  @return  string
	 */
	protected function get_render_scroller($data = [])
	{
		return $this->parser->parse('elements/scroller', (array) $data, TRUE);
	}

	/**
	 *  Прелоадер при загрузке контента через AJAX.
	 *  
	 *  @return  string
	 */
	protected function get_render_preloader($data = [])
	{
		return $this->parser->parse('elements/preloader', (array) $data, TRUE);
	}

	/**
	 *  Навигация по сайту.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_menu($data = [])
	{
		return $this->parser->parse('menu', (array) $data, TRUE);
	}

	/**
	 *  Шапка сайта.
	 *  
	 *  @return  string
	 */
	protected function get_render_header($data = [])
	{
		return $this->parser->parse('header', (array) $data, TRUE);
	}

	/**
	 *  Информация об уроках, технологиях и авторах.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_main($data = [])
	{
		return $this->parser->parse('main', $this->_get_render_main($data), TRUE);
	}

	protected function _get_render_main($data = [])
	{
		return [
			'courses' => $this->parser->parse('courses/main', (array) $data, TRUE),
			'techs'   => $this->parser->parse('techs/main', (array) $data, TRUE),
			'authors' => $this->parser->parse('authors/main', (array) $data, TRUE)
		];
	}

	/**
	 *  Уроки.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_courses($data = [])
	{
		return $this->parser->parse('courses/index', $this->_get_render_courses($data), TRUE);
	}

	protected function _get_render_courses($data = [])
	{
		return [
			'header'  => $this->parser->parse('courses/header', (array) $data, TRUE),
			'list'    => $this->parser->parse('courses/list', (array) $data, TRUE),
			'authors' => $this->parser->parse('courses/authors', (array) $data, TRUE)
		];
	}

	/**
	 *  Технологии.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_techs($data = [])
	{
		return $this->parser->parse('techs/index', $this->_get_render_techs($data), TRUE);
	}

	protected function _get_render_techs($data = [])
	{
		return [
			'header'  => $this->parser->parse('techs/header', (array) $data, TRUE),
			'list'    => $this->parser->parse('techs/list', (array) $data, TRUE)
		];
	}

	/**
	 *  Авторы.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_authors($data = [])
	{
		return $this->parser->parse('authors/index', $this->_get_render_authors($data), TRUE);
	}

	protected function _get_render_authors($data = [])
	{
		return [
			'header'  => $this->parser->parse('authors/header', (array) $data, TRUE),
			'list'    => $this->parser->parse('authors/list', (array) $data, TRUE)
		];
	}

	/**
	 *  Форма обратной связи.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_feedback($data = [])
	{
		return $this->parser->parse('feedback', (array) $data, TRUE);
	}

	/**
	 *  Подвал сайта.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_footer($data = [])
	{
		return $this->parser->parse('footer', (array) $data, TRUE);
	}

	/**
	 *  Шаблоны.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_templates($data = [], $in = [])
	{
		return $this->parser->parse('templates', $this->_get_render_templates($data, $in), TRUE);
	}

	protected function _get_render_templates($data = [], $in = [])
	{
		$data = (array) $data;
		$in = (array) $in;

		$templates = [
			'course'       => $this->parser->parse('templates/course', (array) $data, TRUE),
			'modal_course' => $this->parser->parse('templates/modal_course', (array) $data, TRUE),
			'modal_filter' => $this->parser->parse('templates/modal_filter', (array) $data, TRUE),
			'modal_tech'   => $this->parser->parse('templates/modal_tech', (array) $data, TRUE),
			'modal_user'   => $this->parser->parse('templates/modal_user', (array) $data, TRUE),
			'best_authors' => $this->parser->parse('templates/best_authors', (array) $data, TRUE),
			'select'       => $this->parser->parse('templates/select', (array) $data, TRUE)
		];

		if (!empty($in))
		{
			foreach ($templates as $template => $data)
			{
				if (!in_array($template, $in))
				{
					$templates[$template] = '';
				}
			}
		}

		return $templates;
	}

	/**
	 *  Скрипты.
	 *  
	 *  @param   array   $data  [Параметры]
	 *  @return  string
	 */
	protected function get_render_scripts($data = [])
	{
		return $this->parser->parse('scripts', (array) $data, TRUE);
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */