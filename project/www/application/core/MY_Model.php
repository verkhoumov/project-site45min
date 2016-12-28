<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	/**
	 *  Таблицы базы данных.
	 */
	protected $db_techs          = 'techs';
	protected $db_users          = 'users';
	protected $db_users_techs    = 'users_techs';
	protected $db_users_contacts = 'users_contacts';
	protected $db_courses        = 'courses';
	protected $db_courses_techs  = 'courses_techs';
	protected $db_votes          = 'votes';
	protected $db_feedback       = 'feedback';

	public function __construct()
	{
		parent::__construct();

		// Загрузка базы данных.
		$this->load->database();
	}
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */