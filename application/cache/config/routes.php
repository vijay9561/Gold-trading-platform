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
$route['default_controller'] = 'users_controller';
$route['loginadmin'] = 'supper_admin_controller/supper_admin_login';
$route['deshboard'] = 'supper_admin_controller/deshboard';
$route['admin-principle'] = 'supper_admin_controller/admin_principle';
$route['principle-registration'] = 'users_controller/principle_registration'; 
$route['principle-login'] = 'users_controller/principle_login'; 
$route['teacher-create'] = 'users_controller/teacher_creation'; 
$route['teacher-list'] = 'users_controller/teacher_list'; 
$route['principle-profile'] = 'users_controller/principle_profile'; 
$route['change-password'] = 'users_controller/change_password'; 
$route['admin-change-password'] = 'supper_admin_controller/admin_change_password';
$route['logoutprinciple']='users_controller/logoutprinciple';
$route['teacher-login']='users_controller/teacher_login';
$route['teacher-profile']='users_controller/teacher_profile';
$route['student-list']='users_controller/student_list';
$route['new-student-registration']='users_controller/new_student_registration';
$route['create-event']='users_controller/eventcreation';
$route['holiday-list']='users_controller/holiday_list';
$route['student-attendance']='users_controller/student_attendance';
$route['attendance-student-list']='users_controller/attendance_student_list';
$route['parent-login']='users_controller/parent_login';
$route['parent-profile']='users_controller/parent_profile';
$route['create-clerek']='users_controller/create_clerek';
$route['student-list-clerk']='users_controller/student_list_clerk';
$route['comming_soons']='users_controller/comming_soons';
$route['individual_notification']='users_controller/individual_notification';
$route['parent_notifications']='users_controller/parent_notifications';
$route['common_notification']='users_controller/common_notification';
$route['clerk-list']='users_controller/clerk_list';
$route['main_sliders']='Supper_admin_controller/main_sliders';
$route['schools_slider']='users_controller/schools_slider';
$route['attendance_calendar']='users_controller/attendance_calendar';
$route['notification']='users_controller/notification';
$route['student-attendance-list-admin']='users_controller/student_attendance_list_admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
