<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->add('/hooman','BackOfficeUser::Login');

$routes->get('/','PublicsController::HomePage',['filter'=> 'noauth']);
$routes->match(['get', 'post'], 'masuk', 'UserController::Masuk', ["filter" => "noauth"]);
$routes->match(['get', 'post'], 'daftar', 'UserController::Daftar', ["filter" => "noauth"]);
$routes->get('/keluar','UserController::keluar');

$routes->group("/member",['filter'=> 'auth'], function($routes){
	$routes->get('/','FrontOffice::Member');
	$routes->get('lomba','FrontOfficeLomba::Index');
	$routes->get('lomba/(:any)','FrontOfficeLomba::DetailsLomba/$1');
	$routes->get('daftar/(:any)','FrontOfficeLomba::Submission/$1');
	$routes->add('lomba/regist','FrontOfficeLomba::RegistLomba');
	$routes->add('lomba/submit','FrontOfficeLomba::SubmitLomba');

	$routes->get('akun','FrontOffice::Account');
	$routes->add('akun/save','FrontOffice::EditAccount');
});

$routes->group("dashboard",['filter'=> 'auth'], function($routes){
	$routes->get('/','BackOfficeUser::Dashboard');

	// Oprec Routes
	$routes->add('oprec','BackOfficeUser::Oprec');
	$routes->add('edit-data-panit/(:any)','BackOfficeUser::EditDataPanit/$1');
	$routes->get('delete-data-panit/(:any)','BackOfficeUser::DeleteDataPanit/$1');

	// Lomba
	$routes->get('lomba','BackOfficeLomba::Lomba');
	$routes->get('lomba/(:any)/(:any)','BackOfficeLomba::Participant/$1/$2');
	$routes->get('lomba/(:any)','BackOfficeLomba::Details/$1');
	$routes->get('updateStatusLomba/(:any)/(:any)','BackOfficeLomba::UpdateStatus/$1/$2');
	$routes->add('lomba/(:any)/save-lomba','BackOfficeLomba::UpdateArticle/$1');
	$routes->add('lomba/(:any)/save-banner-lomba','BackOfficeLomba::UpdateBanner/$1');

	// Web Settings
	$routes->get('web-settings','BackOfficeSettings::WebSettings');
	$routes->add('web-settings/save','BackOfficeSettings::WebSettingsSave');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
