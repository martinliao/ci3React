<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// React
$route['admin'] = 'Admin/index';
$route['dashboard'] = 'Admin/dashboard';

// SmartyaACL route
$route['importdatabase'] = 'welcome/importdatabase';
$route['admin/login'] = 'AuthAdmin/index';
$route['admin/logout'] = 'AuthAdmin/logout';
