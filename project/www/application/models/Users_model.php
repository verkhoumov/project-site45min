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

		$temp = [
			'courses' => []
		];

		$subquery = '';

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
			->order_by('id', 'DESC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['courses'][] = $data;
				$temp['courses'][] = $data['id'];
			}
		}

		/**
		 *  Навыки.
		 *
		 *  Используется UNION запрос, чтобы объединить навыки, указанные автором, и технологии,
		 *  применённые в уроке.
		 */
		if ($user_id != 1)
		{
			if (!empty($temp['courses']))
			{
				$subquery = 'UNION (SELECT `tech_id` FROM `'.$this->db_courses_techs.'` WHERE `course_id` IN ('.implode(', ', $temp['courses']).'))';
			}

			$this->db
				->reset_query()
				->select('`B`.*')
				->from('((SELECT `tech_id` FROM `'.$this->db_users_techs.'` WHERE `user_id` = '.$user_id.') '.$subquery.') AS `A`')
				->join($this->db_techs.' AS `B`', '`A`.`tech_id` = `B`.`id`')
				->order_by('`B`.`id`', 'ASC');

			if ($query = $this->db->get())
			{
				foreach ($query->result_array() as $data)
				{
					$result['techs'][] = $data;
				}
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

		return (array) $result;
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

		return (array) $result;
	}

	/**
	 *  Список пользователей для формы обратной связи.
	 *  
	 *  @param   boolean  $with_array_key  [Создание массива с ключём по ID или без]
	 *  @return  array
	 */
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

		return (array) $result;
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
			->select('A.user_id as id, A.rating, B.name, B.avatar', FALSE)
			->from('(SELECT * FROM '.$this->db_courses.' ORDER BY rating DESC) AS A')
			->join($this->db_users.' AS B', 'B.id = A.user_id AND B.id != 1') // NOTE: id = 1 - Анонимный автор, его не надо показывать.
			->group_by('A.user_id')
			->order_by('A.rating', 'DESC')
			->order_by('A.user_id', 'ASC')
			->limit($limit);

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result[] = $data;
			}
		}

		return (array) $result;
	}
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */