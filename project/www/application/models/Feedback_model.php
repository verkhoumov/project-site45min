<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Сохранение информации об отправленном письме.
	 *  
	 *  @param  array  $data  [Информация]
	 */
	public function set_feedback($data = [])
	{
		$data = (array) $data;

		$this->db->trans_start();

		$this->db
			->reset_query()
			->set('date', 'NOW()', FALSE)
			->insert($this->db_feedback, $data);
			
		$this->db->trans_complete();

		return $this->db->trans_status();
	}
}

/* End of file Feedback_model.php */
/* Location: ./application/models/Feedback_model.php */