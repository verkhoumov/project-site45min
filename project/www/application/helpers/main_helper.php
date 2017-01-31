<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Генерация заголовка страницы.
 *  
 *  @param   string  $title    [Заголовок]
 *  @param   string  $default  [Значение по-умолчанию]
 *  @return  string
 */
function get_title($title = '', $default = '')
{
	$title  = get_clear_string($title);
	$result = get_clear_string($default);

	if (!empty($title))
	{
		$result = $title.' — '.$result;
	}

	return $result;
}

/**
 *  Проверка, является ли строка ссылкой.
 *  
 *  @param   string   $string  [Строка]
 *  @return  boolean
 */
function _is_link($string = '')
{
	$string = (string) $string;

	if (strpos($string, 'http') !== FALSE)
	{
		return TRUE;
	}

	return FALSE;
}

/**
 *  Проверка, существует ли переданное изображение.
 *  
 *  @param   string   $string  [Ссылка на изображение]
 *  @return  boolean
 */
function _is_image($string = '')
{
	$string = (string) $string;

	if (strpos($string, '.jpg') !== FALSE || strpos($string, '.png') !== FALSE)
	{
		return TRUE;
	}

	return FALSE;
}

/**
 *  Генерация изображения для документа.
 *  
 *  @param   string  $image      [Изображение]
 *  @param   string  $directory  [Каталог, из которого следует брать изображения]
 *  @return  string
 */
function get_image($image = '', $directory = '')
{
	$image = htmlspecialchars(trim((string) $image), ENT_QUOTES);
	$directory = (string) $directory;

	$upload = 'upload/';

	// Если изображение представлено ссылкой.
	if (_is_link($image))
	{
		return $image;
	}

	// Если указан формат изображения.
	if (_is_image($image))
	{
		$path = $upload.$directory.$image;

		// Если изображение существует.
		if (is_file($path) && getimagesize($path))
		{
			return '/'.$path;
		}
	}

	return '/'.$upload.$directory.'default.png';
}

/**
 *  Обработчик даты на русском языке.
 *  
 *  @param   string  $date    [Дата в любом формате]
 *  @param   string  $format  [Формат итоговой даты]
 *  @return  string
 */
function get_date($date = '', $format = 'j {month} в H:i')
{
	$date   = (string) $date;
	$format = (string) $format;

	$time = $date != '' ? strtotime($date) : time();

	$months = [1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

 	// Кастомные шаблоны.
    $search = ['{month}'];
    $pattern = [$months[date('n', $time)]];

    // Обработка кастомных шаблонов.
    $length = count($search);

    for ($i = 0; $i < $length; $i++)
    {
    	$format = str_replace($search[$i], $pattern[$i], $format);
    }
    
    return date($format, $time);
}

/**
 *  Генерация названия ссылки.
 *  
 *  @param   string  $link     [Ссылка]
 *  @param   string  $name     [Имя ссылки]
 *  @param   string  $pattern  [Шаблон извлечения названия из ссылки]
 *  @return  string
 */
function get_link_name($link = '', $name = '', $pattern = '')
{
	$link = get_clear_string($link);
	$name = get_clear_string($name);
	
	$result = '';
	$pattern = $pattern != '' ? $pattern : '#https?\:\/\/?([^\/]{5,})\/#i';

	if (!empty($name) && $name != '')
	{
		$result = $name;
	}
	elseif (preg_match($pattern, $link, $matches))
	{
		$result = str_replace('www.', '', $matches[1]);
	}

	return $result;
}

/**
 *  Получение имени ссылки на социальные сети.
 *  
 *  @param   string  $link  [Ссылка]
 *  @param   string  $name  [Имя ссылки]
 *  @return  string
 */
function get_social_link_name($link = '', $name = '')
{
	return get_link_name($link, $name, '#https?\:\/\/(.*)/#i');
}

/**
 *  Очистка строки.
 *  
 *  @param   string  $string  [Строка]
 *  @return  string
 */
function get_clear_string($string = '')
{
	return htmlspecialchars(trim((string) $string), ENT_QUOTES);
}

/**
 *  Получение формы слова по заданному числу.
 *  
 *  @param   integer  $n   [Заданное число]
 *  @param   string   $n1  [1 яблоко]
 *  @param   string   $n2  [2 яблока]
 *  @param   string   $n5  [5 яблок]
 *  @return  string
 */
function get_noun_word($n = 0, $n1 = '', $n2 = '', $n5 = '')
{
	$n = (integer) $n;
	$n1 = (string) $n1;
	$n2 = (string) $n2;
	$n5 = (string) $n5;

	$n = floor($n);

	// Результат: 5 яблок.
	$n %= 100;
	if ($n >= 5 && $n <= 20) {
		return $n5;
	}

	// Результат: 1 яблоко.
	$n %= 10;
	if ($n == 1) {
		return $n1;
	}

	// Результат: 2 яблока.
	if ($n >= 2 && $n <= 4) {
		return $n2;
	}

	return $n5;
}

/* End of file main_helper.php */
/* Location: ./application/helpers/main_helper.php */