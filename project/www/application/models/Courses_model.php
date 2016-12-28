<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------

	/**
	 *  Получение списка уроков по нескольким условиям.
	 *  Важно отметить, что уроки сортируются сначала по релевантности (фильтрам),
	 *  потом по рейтингу.
	 *  
	 *  @param   integer  $offset     [Пропуск]
	 *  @param   integer  $limit      [Ограничение]
	 *  @param   array    $where      [Условие]
	 *  @param   array    $filter_in  [Фильтры]
	 *  @return  array
	 */
	public function get_courses($offset = 0, $limit = 0, $where = [], $filter_in = [])
	{
		$offset    = (integer) $offset;
		$limit     = (integer) $limit;
		$where     = (array) $where;
		$filter_in = (array) $filter_in;

		if ($limit == 0)
		{
			$limit = 100;
		}

		$result = [
			'courses'       => [],
			'best_authors'  => [],
			'courses_count' => 0
		];

		$select = 'A.*, B.name AS user_name, B.avatar AS user_avatar';

		if (!empty($filter_in))
		{
			$select .= ', COUNT(D.name) AS techs_count, GROUP_CONCAT(D.name ORDER BY D.id DESC SEPARATOR ", ") AS techs_inline';
		}

		$this->db
			->reset_query()
			->select($select)
			->from($this->db_courses.' AS A')
			->join($this->db_users.' AS B', 'B.id = A.user_id');

		if (!empty($where))
		{
			$this->db->where($where);
		}

		if (!empty($filter_in))
		{
			$this->db
				->join($this->db_courses_techs.' AS C', 'C.course_id = A.id')
				->join($this->db_techs.' AS D', 'D.id = C.tech_id')
				->where_in('D.code', $filter_in)
				->order_by('techs_count', 'DESC');
		}

		$this->db
			->order_by('A.rating', 'DESC')
			->group_by('A.id');

		if ($query = $this->db->get())
		{
			$courses_counter = 1;
			$authors_counter = 1;
			$users = [];

			foreach ($query->result_array() as $data)
			{
				// Общее количество уроков согласно запросу.
				++$result['courses_count'];

				// Уроки согласно Offset и Limit.
				if ($courses_counter > $offset && $courses_counter <= ($offset + $limit))
				{
					// Уроки.
					$result['courses'][] = $data;
				}

				++$courses_counter;

				// Авторы лучших уроков, а поскольку уроки сортируются по тому же
				// признаку, то первых 6 уроков.
				if ($authors_counter <= 6)
				{
					if (isset($users[$data['user_id']]))
					{
						continue;
					}

					$result['best_authors'][] = [
						'id'     => $data['user_id'],
						'name'   => $data['user_name'],
						'avatar' => $data['user_avatar']
					];

					$users[$data['user_id']] = TRUE;
					++$authors_counter;
				}
			}
		}

		return $result;
	}

	/**
	 *  Информация об уроке.
	 *  
	 *  @param   integer  $course_id  [ID урока]
	 *  @return  array
	 */
	public function get_course_by_id($course_id = 0, $where = [])
	{
		$course_id = (int) $course_id;
		$where     = (array) $where;

		$result = [
			'course' => [],
			'techs'  => []
		];

		$subquery = [];

		/**
		 *  Урок.
		 */
		$this->db
			->reset_query()
			->select('A.*, B.name AS user_name, B.avatar AS user_avatar')
			->from($this->db_courses.' AS A')
			->where('A.id', $course_id)
			->where($where)
			->join($this->db_users.' AS B', 'B.id = A.user_id');

		if ($query = $this->db->get())
		{
			$result['course'] = $query->row_array();
		}

		/**
		 *  Технологии.
		 */
		$this->db
			->reset_query()
			->select('B.*')
			->from($this->db_courses_techs.' AS A')
			->where('A.course_id', $course_id)
			->join($this->db_techs.' AS B', 'B.id = A.tech_id')
			->order_by('B.id', 'ASC');

		if ($query = $this->db->get())
		{
			foreach ($query->result_array() as $data)
			{
				$result['techs'][] = $data;
				$subquery[] = $data['id'];
			}
		}

		/**
		 *  Похожие уроки.
		 *  Список похожих уроков сортируется по количеству общих технологий.
		 */
		if (!empty($subquery))
		{
			$this->db
				->reset_query()
				->select('A.*, B.*')
				->from('(SELECT `course_id`, COUNT(`tech_id`) AS `tech_relevant` FROM `'.$this->db_courses_techs.'` WHERE `tech_id` IN ('.implode(', ', $subquery).') AND `course_id` != '.$course_id.' GROUP BY `course_id`) AS A')
				->join($this->db_courses.' AS B', 'B.id = A.course_id')
				->order_by('A.tech_relevant', 'DESC')
				->order_by('B.rating', 'DESC')
				->order_by('B.id', 'DESC')
				->limit(3);

			if ($query = $this->db->get())
			{
				foreach ($query->result_array() as $data)
				{
					$result['courses'][] = $data;
				}
			}
		}

		return $result;
	}

	/**
	 *  Производим голосование за урок.
	 *  
	 *  @param   integer  $course_id  [ID урока]
	 *  @param   integer  $rating     [Рейтинг]
	 *  @return  boolean|integer
	 */
	public function update_course_rating($course_id = 0, $rating = 0)
	{
		$course_id = (integer) $course_id;
		$rating    = (integer) $rating;

		$new_rating = 0;

		if ($rating < 1 || $rating > 5)
		{
			return FALSE;
		}

		// Вставляем голос.
		$this->db->trans_start();

		$this->db
			->reset_query()
			->set('course_id', $course_id)
			->set('value', $rating)
			->insert($this->db_votes);
			
		$this->db->trans_complete();

		if (!$this->db->trans_status())
		{
			return FALSE;
		}

		// Чтобы сформировать новое значение рейтинга, загружаем голоса.
		$this->db
			->reset_query()
			->select('COUNT(id) AS votes_count, SUM(value) AS votes_summary')
			->from($this->db_votes)
			->where('course_id', $course_id);

		if ($query = $this->db->get())
		{
			$result = $query->row_array();
			$new_rating = round($result['votes_summary'] / $result['votes_count'], 2);
		}

		if (!$new_rating)
		{
			return FALSE;
		}

		// Выставляем новый рейтинг уроку.
		$this->db->trans_start();

		$this->db
			->reset_query()
			->set('rating', $new_rating)
			->where('id', $course_id)
			->update($this->db_courses);

		$this->db->trans_complete();

		if ($this->db->trans_status())
		{
			return $new_rating;
		}

		return FALSE;
	}
}

/* End of file Courses_model.php */
/* Location: ./application/models/Courses_model.php */