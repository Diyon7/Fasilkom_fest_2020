<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('ci', 'home::index');
$routes->get('/', 'Dashboard::index');

$routes->get('/cso', 'Cso::index');
$routes->get('/cso/register', 'Cso::register');
$routes->post('/cso/save', 'Cso::save');
$routes->get('/cso/login', 'Cso::login');
$routes->get('/cso/fpass', 'Cso::updatepass');
$routes->get('/cso/rpass(:segment)', 'Cso::activate');
$routes->add('/cso/loginauth', 'CsoAuth::index');

$routes->group('cso-dashboard', ['filter' => 'ceklogincso'], function ($routes) {
});

$routes->add('coba', 'Dashboard::coba');

$routes->get('/peraturan', 'Peraturan::index');

//Auth Routes
$routes->get('/login', 'Auth/Auth::index');
$routes->get('/logout', 'Auth/Auth::logout');

$routes->add('admin/login', 'Admin/AdminAuth::index', ['filter' => 'cekadmin']);
$routes->add('admin/logout', 'Admin/AdminAuth::logout');


$routes->group('admin', ['filter' => 'cekloginadmin'], function ($routes) {
	$routes->get('/', 'Admin/Dashboard::index');

	// admin soal
	$routes->get('users', 'Admin/Users::index');
	$routes->add('users/add', 'Admin/Users::add');
	$routes->add('users/edit/(:num)', 'Admin/Users::edit');
	$routes->add('users/delete', 'Admin/Users::delete');

	//hasil team
	$routes->get('team', 'Admin/Team::index');
	$routes->add('team/delete', 'Admin/Team::hapusdata');
	$routes->add('get_hasil', 'Admin/Team::get_hasil');
	$routes->add('team/lihat/(:num)', 'Admin/Team::Detail');

	$routes->add('sendemail', 'Admin/Email::index');
	$routes->add('pesanemail/kirim', 'Admin/Email::chat');
});

$routes->group('ajax', ['filter' => 'cekloginadmin'], function ($routes) {
	$routes->add('get_team', 'Admin/Team::ambildata');
	$routes->add('listdata', 'Admin/Team::listdata');
	$routes->add('pesertadata', 'Admin/Team::viewdata');
	$routes->add('bayar', 'Admin/Team::bayar');
	$routes->add('users/formadd', 'Admin/Users::formadd');
	$routes->add('formupdatedata', 'Admin/Team::formupdatedata');
	$routes->add('updatedata', 'Admin/Team::updatedata');


	$routes->add('email/manual', 'Admin/Email::manual');
	$routes->add('email/register', 'Admin/Email::register');
	$routes->add('email/bayar', 'Admin/Email::bayar');

	$routes->add('getusers', 'Admin/Users::listdata');
});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
