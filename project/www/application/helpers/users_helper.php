<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Обработка информации по списку пользователей.
 *  
 *  @param   array   $data  [Список пользователей]
 *  @return  array
 */
function get_users_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (!empty($data))
	{
		foreach ($data as $key => $value)
		{
			$result[$key] = get_user_data($value);
		}
	}

	return $result;
}

/**
 *  Обработка информации о пользователе.
 *  
 *  @param   array   $data  [Пользователь]
 *  @return  array
 */
function get_user_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (isset($data['id']))
	{
		$result['id'] = (integer) $data['id'];
	}

	if (isset($data['name']))
	{
		$result['name'] = get_clear_string($data['name']);
	}

	if (isset($data['city']))
	{
		$result['city'] = get_clear_string($data['city']);
	}

	if (isset($data['about']))
	{
		$result['about'] = nl2br(get_clear_string($data['about']));
	}

	if (!isset($data['avatar']))
	{
		$data['avatar'] = '';
	}

	$result['avatar'] = get_user_image($data['avatar']);

	if (isset($data['date']))
	{
		$result['date'] = get_date($data['date']);
	}

	if (isset($data['email']))
	{
		$result['email'] = get_clear_string($data['email']);
	}

	return $result;
}

/**
 *  Генерация изображения аватара пользователя.
 *  
 *  @param   string  $image  [Адрес изображения]
 *  @return  string
 */
function get_user_image($image = '')
{
	return get_image($image, 'users/');
}

/**
 *  Получение количества всех пользователей в текстовом формате.
 *  
 *  @param   integer  $count  [Кол-во пользователей]
 *  @return  string
 */
function get_users_count($count = 0)
{
	$count = (integer) $count;

	$result = get_noun_word($count, 'принял участие более ', 'приняли участие более ', 'приняли участие более ');
	$result .= $count;
	$result .= get_noun_word($count, ' человека', ' человек', ' человек');

	return $result;
}

/* End of file users_helper.php */
/* Location: ./application/helpers/users_helper.php */