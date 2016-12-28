<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Обработка информации по списку технологий.
 *  
 *  @param   array   $data  [Список технологий]
 *  @return  array
 */
function get_techs_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (!empty($data))
	{
		foreach ($data as $key => $value)
		{
			$result[$key] = get_tech_data($value);
		}
	}

	return $result;
}

/**
 *  Обработка информации о технологии.
 *  
 *  @param   array   $data  [Технология]
 *  @return  array
 */
function get_tech_data($data = [])
{
	$data = (array) $data;
	$result = [];

	// ID технологии.
	if (isset($data['id']))
	{
		$result['id'] = (integer) $data['id'];
	}

	// Код.
	if (isset($data['code']))
	{
		$result['code'] = get_clear_string($data['code']);
	}

	// Название.
	if (isset($data['name']))
	{
		$result['name'] = get_clear_string($data['name']);
	}

	// Ссылка на разработчика.
	if (isset($data['link']))
	{
		$result['link'] = get_clear_string($data['link']);
		$result['link_name'] = get_link_name($data['link']);
	}

	// Описание.
	if (isset($data['description']))
	{
		$result['description'] = nl2br(get_clear_string($data['description']));
	}

	// Изображение.
	if (!isset($data['image']))
	{
		$data['image'] = '';
	}

	$result['image'] = get_tech_image($data['image']);

	// Запоминаем, указано изображение для технологии или нет.
	$result['image_status'] = FALSE;

	if (strpos($result['image'], 'default.png') === FALSE)
	{
		$result['image_status'] = TRUE;
	}

	// Дата добавления.
	if (isset($data['date']))
	{
		$result['date'] = get_date($data['date']);
	}

	return $result;
}

/**
 *  Формирование списка технологий, имеющих изображение.
 *  
 *  @param   array   $data  [Список технологий]
 *  @return  array
 */
function get_techs_with_image($data = [])
{
	$data = (array) $data;
	$result = [];

	if (!empty($data))
	{
		foreach ($data as $key => $value)
		{
			if (isset($value['image_status']) && $value['image_status'] === TRUE)
			{
				$result[$value['image']] = $value;
			}
		}
	}

	return $result;
}

/**
 *  Получение изображения технологии.
 *  
 *  @param   string  $image  [Ссылка на изображение]
 *  @return  string
 */
function get_tech_image($image = '')
{
	return get_image($image, 'techs/');
}

/**
 *  Количество технологий.
 *  
 *  @param   integer  $count  [Кол-во]
 *  @return  string
 */
function get_techs_count($count = 0)
{
	$count = (integer) $count;

	$result = $count;
	$result .= get_noun_word($count, ' различную технологию', ' различных технологии', ' различных технологий');

	return $result;
}

/* End of file techs_helper.php */
/* Location: ./application/helpers/techs_helper.php */