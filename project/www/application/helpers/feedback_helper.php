<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Обработка данных из формы обратной связи.
 *  
 *  @param   array   $data  [Данные]
 *  @return  array
 */
function get_feedback_data($data = [])
{
	$data = (array) $data;
	$result = [];

	if (isset($data['name']))
	{
		$result['name'] = get_clear_string($data['name']);
	}

	if (isset($data['email']))
	{
		$result['email'] = get_clear_string($data['email']);
	}

	if (isset($data['to']))
	{
		$result['to'] = (integer) $data['to'];
	}

	if (isset($data['theme']))
	{
		$result['theme'] = get_clear_string($data['theme']);
	}

	if (isset($data['message']))
	{
		$result['message'] = get_clear_string($data['message']);
	}

	return $result;
}

/* End of file feedback_helper.php */
/* Location: ./application/helpers/feedback_helper.php */