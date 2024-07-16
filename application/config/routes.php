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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//guest
$route['home'] = 'hotel/index';
$route['rooms'] = 'hotel/rooms';
$route['viewroom/(:num)'] = 'hotel/viewroom/$1';
$route['guest/reserveroom/(:num)'] = 'guest/roomreserve/$1';
$route['guest/reserve']['post'] = 'guest/reserve';
$route['reservelist'] = 'guest/reservelist';
$route['list/cancel/(:num)'] = 'guest/cancelbook/$1';


//auth
$route['login'] = 'auth/login';
$route['login/validation'] = 'auth/validation';

$route['register'] = 'auth/register';
$route['registration/add']['post'] = 'auth/registration';

$route['logout'] = 'auth/logout';

//admin
$route['dashboard'] = 'admin/index';

$route['floor'] = 'admin/floor';
$route['floor/manage']['post'] = 'admin/managefloor';
$route['floors/delete/(:num)'] = 'admin/deletefloor/$1';

$route['roomtypes'] = 'admin/roomtype';
$route['roomtypes/manage']['post'] = 'admin/manageroomtype';
$route['roomtypes/delete/(:num)'] = 'admin/deleteroomtype/$1';

$route['room'] = 'admin/room';
$route['rooms/manage']['post'] = 'admin/manageroom';
$route['rooms/delete/(:num)'] = 'admin/deleteroom/$1';

$route['checkin'] = 'admin/checkin';
$route['checkin/guest']['post'] = 'admin/addcheckin';

$route['checkout'] = 'admin/checkout';
$route['checkout/guest/(:num)'] = 'admin/checkoutguest/$1';

$route['users'] = 'admin/users';
$route['users/add']['post'] = 'admin/adduser';
$route['users/delete/(:num)'] = 'admin/deleteuser/$1';

$route['reservation'] = 'admin/reservation';
$route['reservation/cancel/(:num)'] = 'admin/cancelbookAdmin/$1';
$route['reservation/booked/(:num)'] = 'admin/booked/$1';

$route['reports'] = 'admin/reports';