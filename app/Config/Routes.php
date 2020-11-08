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
$routes->get('/', 'Home::index');
$routes->get('/sobre', 'Home::sobre');
$routes->get('/pevs', 'Home::pevs');
$routes->get('/planos', 'Home::planos');

$routes->get('/logout', 'UserController::logout');
$routes->match(['get', 'post'], '/login', 'UserController::index');
$routes->match(['get', 'post'], '/sign-up', 'UserController::signUp');
$routes->match(['get', 'post'], '/sign-up/dados', 'UserController::dados');

$routes->group('empresas', ['filter' => 'empresa'], function ($routes) {
	$routes->get('/', 'EmpresaController::empresas');
	$routes->match(['get', 'post'], 'abrirtopico', 'EmpresaController::abrirTopico');
	$routes->match(['get', 'post'], 'editartopico/(:num)', 'EmpresaController::editarTopico/$1');
	$routes->get('deletartopico/(:num)', 'EmpresaController::deletarTopico/$1');
	$routes->match(['get', 'post'], 'topicos/(:num)', 'EmpresaController::viewTopico/$1');
	$routes->get('aprovar/(:num)/(:num)', 'EmpresaController::aprovarCooperativa/$1/$2');
	$routes->get('negar/(:num)/(:num)', 'EmpresaController::negarCooperativa/$1/$2');
	$routes->get('pesquisar', 'EmpresaController::pesquisaCooperativas');
	$routes->get('perfil', 'PerfilController::viewPerfil');
	$routes->match(['get', 'post'], 'perfil/editar', 'PerfilController::editarPerfil');
	$routes->get('premium', 'PremiumController::premium');
	$routes->get('coop/(:num)', 'EmpresaController::viewCoop/$1');
});

$routes->group('cooperativas', ['filter' => 'coop'], function ($routes) {
	$routes->get('/', 'CoopController::cooperativas');
	$routes->get('pesquisar', 'CoopController::pesquisartopicos');
	$routes->get('mostrarinteresse', 'CoopController::interesseTopico');
	$routes->POST('pesquisafiltro', 'CoopController::pesquisafiltro');
	// $routes->get('pesquisarempresa', 'CoopController::pesquisarempresas');
	$routes->get('perfil', 'PerfilController::viewPerfil');
	$routes->match(['get', 'post'], 'perfil/editar', 'PerfilController::editarPerfil');
	$routes->get('premium', 'PremiumController::premium');
	$routes->get('empresa/(:num)', 'CoopController::viewEmpresa/$1');
});



/**
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

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
