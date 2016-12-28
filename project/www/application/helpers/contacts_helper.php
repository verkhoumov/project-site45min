<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Обработка списка контактной информации.
 *  
 *  @param   array   $data  [Контакты]
 *  @return  array
 */
function get_contacts_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (!empty($data))
	{
		foreach ($data as $key => $value)
		{
			if (isset($value['id']))
			{
				$result[$key] = get_contact_data($value);
			}
			else
			{
				$result[$key] = get_contacts_data($value);
			}
		}
	}

	return $result;
}

/**
 *  Обработка контактной информации.
 *  
 *  @param   array   $data  [Контакт]
 *  @return  array
 */
function get_contact_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (isset($data['id']))
	{
		$result['id'] = (integer) $data['id'];
	}

	if (isset($data['user_id']))
	{
		$result['user_id'] = (integer) $data['user_id'];
	}

	if (isset($data['link']))
	{
		$result['link'] = get_clear_string($data['link']);

		if (isset($data['name']))
		{
			$result['name'] = get_social_link_name($data['link'], $data['name']);
		}
		else
		{
			$result['name'] = get_social_link_name($data['link']);
		}
	}

	if (isset($data['type']))
	{
		$result['type'] = get_clear_string($data['type']);
	}

	return $result;
}

/* End of file contacts_helper.php */
/* Location: ./application/helpers/contacts_helper.php */