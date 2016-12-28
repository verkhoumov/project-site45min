<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Полная информация о пользователе.
	 *  
	 *  @param   integer  $user_id  [ID пользователя]
	 *  @return  array
	 */
	public function get_user_by_id($user_id = 0)
	{
		$user_id = (int) $user_id;

		$result = [
			'user'     => [],
			'contacts' => [],
			'techs'    => [],
			'courses'  => []
		];

		/**
		 *  Пользователь.
		 */
		$this->db
			->reset_query()
			->from($this->db_users)
			->where('id', $user_id);

		if ($query = $this->db->get())
		{
			$result['user'] = $query->row_array();
		}

		/**
		 *  Уроки.
		 */
		$this->db
			->reset_query()
			->from($this->db_courses)
			->where('user_id', $user_id)
			->order_by('date', 'DESC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['courses'][] = $data;
			}
		}

		/**
		 *  Навыки.
		 */
		$this->db
			->reset_query()
			->select('B.*')
			->from($this->db_users_techs.' AS A')
			->where('A.user_id', $user_id)
			->join($this->db_techs.' AS B', 'A.tech_id = B.id')
			->order_by('B.id', 'ASC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['techs'][] = $data;
			}
		}

		/**
		 *  Контакты.
		 */
		$this->db
			->reset_query()
			->from($this->db_users_contacts)
			->where('user_id', $user_id)
			->order_by('type', 'DESC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['contacts'][$data['type']][] = $data;
			}
		}

		return $result;
	}

	/**
	 *  Список пользователей с основной информацией.
	 *  
	 *  @param   integer  $limit  [Ограничение]
	 *  @return  array
	 */
	public function get_users($limit = 100)
	{
		$limit = (int) $limit;
		$result = [];

		$this->db
			->reset_query()
			->select('id, name, avatar')
			->from($this->db_users)
			->where('avatar !=', NULL)
			->order_by('id', 'ASC')
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

	public function get_feedback_users($with_array_key = FALSE)
	{
		$with_array_key = (boolean) $with_array_key;

		$result = [];

		$this->db
			->reset_query()
			->select('A.*, B.link AS email')
			->from($this->db_users.' AS A')
			->join($this->db_users_contacts.' AS B', 'B.user_id = A.id')
			->where('B.type', 'email')
			->where('B.link !=', '')
			->group_by('A.id')
			->order_by('id', 'ASC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				if ($with_array_key)
				{
					$result[$data['id']] = $data;
				}
				else
				{
					$result[] = $data;
				}
			}
		}

		return $result;
	}

	/**
	 *  Список лучших авторов.
	 *  
	 *  @param   integer  $limit  [Ограничение]
	 *  @return  array
	 */
	public function get_best_users($limit = 4)
	{
		$limit = (int) $limit;
		$result = [];

		$this->db
			->reset_query()
			->select('a.user_id as id, a.rating, '.$this->db_users.'.name, '.$this->db_users.'.avatar', FALSE)
			->from('(SELECT * FROM '.$this->db_courses.' ORDER BY rating DESC) AS a')
			->join($this->db_users, $this->db_users.'.id = a.user_id')
			->group_by('a.user_id')
			->order_by('a.rating', 'DESC')
			->order_by('a.user_id', 'ASC')
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

	public function test($limit = 4)
	{
		$limit = (int) $limit;
		$result = [];

		$this->db
			->reset_query()
			->select('B.*, A.rating_summary')
			->from('(SELECT user_id, SUM(rating) AS rating_summary FROM '.$this->db_courses.' GROUP BY user_id ORDER BY rating_summary DESC, user_id ASC) AS A')
			->join($this->db_users.' AS B', 'B.id = A.user_id')
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
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */