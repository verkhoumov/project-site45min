<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Обработчик 404 страницы.
	 *  
	 *  @return  void
	 */
	public function page404()
	{
		// Подключение зависимостей.
		$this->load();

		// Код страницы 404.
		$this->output->set_status_header(404);

		// Заголовок.
		$this->data['meta'] = [
			'title'       => 'Страница не найдена',
			'description' => 'Запрашиваемая страница не найдена. Скорее всего она уже удалена, либо ещё не создана.'
		];

		$this->parser->parse('pages/errors/index', $this->get_render());
	}

	/**
	 *  Интерфейс страницы.
	 *  
	 *  @return  array
	 */
	private function get_render()
	{
		return [
			'meta'   => $this->get_render_meta($this->data['meta']),
			'menu'   => $this->get_render_menu(['url' => site_url()]),
			'error'  => $this->get_render_404(),
			'footer' => $this->get_render_footer()
		];
	}

	/**
	 *  Генерация шаблона с самой ошибкой.
	 *  
	 *  @param   array   $data  [Данные]
	 *  @return  string
	 */
	private function get_render_404($data = [])
	{
		return $this->parser->parse('pages/errors/404', (array) $data, TRUE);
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
	}
}

/* End of file Errors_controller.php */
/* Location: ./application/controllers/Errors_controller.php */