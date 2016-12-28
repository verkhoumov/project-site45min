<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_controller extends MY_Controller
{
	/**
	 *  Пароль для доступа к обработчику.
	 */
	private $password = 'UYRgY3B1hYfMzyG7tCskbQSigA8xoy';

	/**
	 *  Настройки для Sitemap.
	 */
	private $sitemap_path       = 'sitemap/';
	private $sitemap_path_index = '';
	private $sitemap_name       = 'sitemap';
	private $sitemap_gzip       = FALSE;

	/**
	 *  Максимальное время выполнения скрипта - 10 минут.
	 */
	const SITEMAP_TIMELIMIT = 600;

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------
    
	/**
	 *  Генерация карты сайта.
	 *  
	 *  @return  void
	 */
	public function get_sitemap($password = '')
	{
		if ($password != $this->password)
		{
			$this->error();
		}

		// Подключение зависимостей.
		$this->load();

		$this
			->sitemap
			->setPath($this->get_path())               // Расположение основных sitemap-файлов.
			->setIndexPath($this->get_path_index())    // Расположение индексного sitemap-файла.
			->setFilename($this->get_sitemap_name())   // Имя для sitemap-файлов.
			->setGzipStatus($this->get_gzip_status())  // Файлы будут заархивированы, поэтому в индексном sitemap.xml надо указать ссылки на архивы.
			->clearSitemapFiles();                     // Удаление старых sitemap-файлов.

		// Генерация страниц сайта для sitemap-файлов.
		$this
			->get_main_page()
			->get_courses_pages();
	
		// Создание sitemap-index-файла.
		// Первый параметр - путь до основных sitemap-файлов.
		$this->sitemap->createSitemapIndex(site_url() . $this->get_path(), 'Today');
	}

	// ------------------------------------------------------------------------

	/**
	 *  Карта сайта для главной страницы.
	 *  
	 *  @return  $this
	 */
	private function get_main_page()
	{
		$this->sitemap->addItem('', '1.0', 'weekly', 'Today');

		return $this;
	}

	/**
	 *  Карта сайта для страниц с уроками.
	 *  
	 *  @return  $this
	 */
	private function get_courses_pages()
	{
		$data = $this->get_courses();
		$site = site_url();

		if (!empty($data))
		{
			foreach ($data as $course)
			{
				$link = str_replace($site, '', $course['link']);

				$this->sitemap->addItem($link, '0.8', 'weekly', strtotime($course['date_original']));
			}
		}

		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 *  Список уроков.
	 *  
	 *  @return  array
	 */
	private function get_courses()
	{
		// Список всех уроков.
		$data = $this->courses_model->get_courses();

		if (empty($data['courses']))
		{
			$this->error();
		}

		return get_courses_data($data['courses']);
	}

	// ------------------------------------------------------------------------
	
	/**
	 *  Подключение зависимостей.
	 *  
	 *  @return  void
	 */
	private function load()
	{
		// Ограничение по времени.
		set_time_limit(self::SITEMAP_TIMELIMIT);

		// Подключение библиотеки для создания Sitemap.xml.
		$this->load->library('sitemap', ['url' => site_url()]);

		// Уроки.
		$this->load->model('courses_model');
	}

	/**
	 *  Где будут хранится основные карты сайта.
	 *  
	 *  @return string
	 */
	protected function get_path()
	{
		return (string) $this->sitemap_path;
	}

	/**
	 *  Где будет хранится индексная карта сайта.
	 *  
	 *  @return string
	 */
	protected function get_path_index()
	{
		return (string) $this->sitemap_path_index;
	}

	/**
	 *  Имя для карты сайта.
	 *  
	 *  @return string
	 */
	protected function get_sitemap_name()
	{
		return (string) $this->sitemap_name;
	}

	/**
	 *  Включён ли GZIP.
	 *  
	 *  @return boolean
	 */
	protected function get_gzip_status()
	{
		return (boolean) $this->sitemap_gzip;
	}
}

/* End of file Sitemap_controller.php */
/* Location: ./application/controllers/Cron/Sitemap_controller.php */