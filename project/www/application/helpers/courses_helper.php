<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Получение информации по списку уроков.
 *  
 *  @param   array   $data  [Список уроков]
 *  @return  array
 */
function get_courses_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (!empty($data))
	{
		foreach ($data as $key => $value)
		{
			$result[$key] = get_course_data($value);
		}
	}

	return $result;
}

/**
 *  Получение информации об уроке.
 *  
 *  @param   array   $data  [Список уроков]
 *  @return  array
 */
function get_course_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (isset($data['id']))
	{
		$result['id'] = (integer) $data['id'];
	}

	if (isset($data['title']))
	{
		$result['title'] = get_clear_string($data['title']);
	}
	else
	{
		$result['title'] = 'Как сделать сайт за 45 минут?';
	}

	if (isset($data['description']))
	{
		$result['description'] = nl2br(get_clear_string($data['description']));
	}
	else
	{
		$result['description'] = 'Описание урока отсутствует.';
	}

	if (isset($data['link']) || is_null($data['link']))
	{
		$result['link'] = get_course_link($result['id'], $data['link']);
	}

	if (!isset($data['video']))
	{
		$data['video'] = '';
	}

	$result['video'] = get_clear_string($data['video']);

	if (!isset($data['image']))
	{
		$data['image'] = '';
	}

	$result['image'] = get_course_image($data['image'], $result['video'], 'mqdefault.jpg');
	$result['image_hd'] = get_course_image($data['image'], $result['video'], 'maxresdefault.jpg');

	if (isset($data['duration']))
	{
		$result['duration'] = get_course_duration($data['duration']);
	}

	if (isset($data['rating']))
	{
		$result['rating'] = (float) $data['rating'];
	}

	if (isset($data['example']))
	{
		$result['example'] = get_clear_string($data['example']);
	}

	if (isset($data['sources']))
	{
		$result['sources'] = get_clear_string($data['sources']);
	}

	if (isset($data['date']))
	{
		$result['date'] = get_date($data['date']);
		$result['date_original'] = $data['date'];
	}

	if (isset($data['user_id']))
	{
		$result['user_id'] = (integer) $data['user_id'];
	}

	if (isset($data['user_name']))
	{
		$result['user_name'] = get_clear_string($data['user_name']);
	}

	if (!isset($data['user_avatar']))
	{
		$data['user_avatar'] = '';
	}

	$result['user_avatar'] = get_user_image($data['user_avatar']);

	return $result;
}

/**
 *  Генерация ссылки на урок.
 *  
 *  @param   integer  $id    [ID урока]
 *  @param   string   $link  [Ссылка на урок]
 *  @return  string
 */
function get_course_link($id = 0, $link = '')
{
	$id   = (integer) $id;
	$link = get_clear_string($link);
	$url  = site_url();

	$result = '#';

	if (!empty($link))
	{
		$result = "{$url}courses/{$id}-{$link}";
	}

	return $result;
}

/**
 *  Генерация изображения для урока.
 *  
 *  @param   string  $image       [Ссылка на изображение]
 *  @param   string  $video       [Ссылка на видео]
 *  @param   string  $resolution  [Разрешение]
 *  @return  string
 */
function get_course_image($image = '', $video = '', $resolution = '')
{
	$image = get_image($image, 'courses/');

	if (strpos($image, 'default.png') !== FALSE && !empty($video) && !empty($resolution) && preg_match('#\/embed\/([^\?]+)\??#i', $video, $matches))
	{
		$code = $matches[1];
		$image = "http://img.youtube.com/vi/{$code}/{$resolution}";
	}

	return $image;
}

/**
 *  Конвертация длительности урока из кол-ва секунд в формат чч:мм:сс или мм:сс.
 *  @param   integer  $duration  [Длительность урока]
 *  @return  string
 */
function get_course_duration($duration = 0)
{
	$duration = (integer) $duration;
	
	$result = '';

	$time = new DateTime("@{$duration}");

	if ($duration >= 3600)
	{
		$result = $time->format('H:i:s');
	}
	else
	{
		$result = $time->format('i:s');
	}
	
	return $result;
}

/* End of file courses_helper.php */
/* Location: ./application/helpers/courses_helper.php */