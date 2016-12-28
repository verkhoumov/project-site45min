<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['translate_uri_dashes'] = FALSE;

/**
 *  Страницы с ошибкой 404.
 */
$route['404_override']   = 'Errors_controller/page404';
$route['page-not-found'] = 'Errors_controller/page404';

/**
 *  Страницы.
 */
$route['default_controller'] = 'Main_controller';
$route['courses/(:num)-(:any)'] = 'Pages/Courses_controller/index/$1/$2';

/**
 *  Файлы.
 */
$route['(.*)\.html$'] = 'Files_controller/$1';

/**
 *  AJAX.
 */
$route['Ajax/getTech$']             = 'Ajax/Techs_controller/get_tech';
$route['Ajax/getUser$']             = 'Ajax/Users_controller/get_user';
$route['Ajax/getUsersList$']        = 'Ajax/Users_controller/get_users_list';
$route['Ajax/getUsersFeedback$']    = 'Ajax/Users_controller/get_users_feedback';
$route['Ajax/getCourse$']           = 'Ajax/Courses_controller/get_course';
$route['Ajax/getCoursesList$']      = 'Ajax/Courses_controller/get_courses_list';
$route['Ajax/setCourseRating$']     = 'Ajax/Rating_controller/set_rating';
$route['Ajax/sendFeedbackMessage$'] = 'Ajax/Feedback_controller/send_message';

/**
 *  CRON.
 */
$route['Cron/getSitemap/(:any)$'] = 'Cron/Sitemap_controller/get_sitemap/$1';