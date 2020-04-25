<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['Ajax_Datatables'] = 'UAC/Ajax_Datatables';

// Login and Logout
$route['Login'] = 'Page_Front/Login';
$route['Logout'] = 'Page_Front/Logout';
$route['Ajax_Search'] = 'UAC/Ajax_Search';

// Permission
$route['UAC_Permission'] = 'UAC/UAC_Permission';
$route['UAC_Permission/Read'] = 'UAC/UAC_Permission/read';
$route['UAC_Permission/Create'] = 'UAC/UAC_Permission/create';
$route['UAC_Permission/Update'] = 'UAC/UAC_Permission/update';
$route['UAC_Permission/Delete'] = 'UAC/UAC_Permission/delete';


// UAC_Group
$route['UAC_Group'] = 'UAC/UAC_Group';
$route['UAC_Group/Read'] = 'UAC/UAC_Group/read';
$route['UAC_Group/Create'] = 'UAC/UAC_Group/create';
$route['UAC_Group/Update'] = 'UAC/UAC_Group/update';
$route['UAC_Group/Delete'] = 'UAC/UAC_Group/delete';

// User System
$route['UAC_User'] = 'UAC/UAC_User';
$route['UAC_User/Read'] = 'UAC/UAC_User/read';
$route['UAC_User/Create'] = 'UAC/UAC_User/create';
$route['UAC_User/Update'] = 'UAC/UAC_User/update';
$route['UAC_User/Delete'] = 'UAC/UAC_User/delete';

// Mapping
$route['UAC_Menu_Mapping'] = 'UAC/UAC_Menu_Mapping';
$route['UAC_Menu_Mapping/Read'] = 'UAC/UAC_Menu_Mapping/read';
$route['UAC_Menu_Mapping/Create'] = 'UAC/UAC_Menu_Mapping/create';
$route['UAC_Menu_Mapping/Update'] = 'UAC/UAC_Menu_Mapping/update';
$route['UAC_Menu_Mapping/Delete'] = 'UAC/UAC_Menu_Mapping/delete';
