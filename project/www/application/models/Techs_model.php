<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techs_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Список технологий, которые хотя бы раз были
	 *  использованы в уроках.
	 *  
	 *  @param   integer  $limit  [Ограничение]
	 *  @return  array
	 */
	public function get_techs($limit = 200)
	{
		$limit = (int) $limit;
		$result = [];

		$this->db
			->reset_query()
			->select('A.*')
			->from($this->db_techs.' AS A')
			->join($this->db_courses_techs.' AS B', 'B.tech_id = A.id')
			->where('B.id !=', NULL)
			->where('A.code !=', NULL)
			->where('A.name !=', NULL)
			->order_by('A.image', 'DESC')
			->order_by('A.code', 'ASC')
			->group_by('A.id')
			->limit($limit);

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result[] = $data;
			}
		}

		return $result;
	}

	/**
	 *  Информация о технологии и список авторов.
	 *  
	 *  @param   integer  $tech_id  [ID технологии]
	 *  @return  array
	 */
	public function get_tech_by_id($tech_id = 0)
	{
		$tech_id = (int) $tech_id;

		$result = [
			'tech'    => [],
			'users'   => [],
			'courses' => []
		];

		/**
		 *  Технологии.
		 */
		$this->db
			->reset_query()
			->from($this->db_techs)
			->where('id', $tech_id);

		if ($query = $this->db->get())
		{
			$result['tech'] = $query->row_array();
		}

		/**
		 *  Специалисты.
		 */
		$this->db
			->reset_query()
			->select('B.*')
			->from($this->db_users_techs.' AS A')
			->join($this->db_users.' AS B', 'B.id = A.user_id')
			->where('A.tech_id', $tech_id)
			->order_by('B.id', 'DESC')
			->group_by('B.id')
			->limit(10);

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['users'][] = $data;
			}
		}

		/**
		 *  Уроки.
		 */
		$this->db
			->reset_query()
			->select('B.*')
			->from($this->db_courses_techs.' AS A')
			->where('A.tech_id', $tech_id)
			->join($this->db_courses.' AS B', 'B.id = A.course_id')
			->order_by('B.rating', 'DESC')
			->order_by('B.id', 'DESC')
			->group_by('B.id')
			->limit(3);

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['courses'][] = $data;
			}
		}

		return $result;
	}
}

/* End of file Techs_model.php */
/* Location: ./application/models/Techs_model.php */