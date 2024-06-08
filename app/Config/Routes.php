<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
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
// Th/e Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->post('login', 'Auth::auth');
$routes->get('logout', 'Auth::logout');
$routes->get('lineapi', 'Lineoa::api');
$routes->group('',['filter' => 'auth'], static function ($routes) {
    $routes->group('jsondata',static function ($routes)
    {
        $routes->get('getAllUsers', 'Master::getAllUsers');
        $routes->get('getAllBranch', 'Master::getAllBranch');
        $routes->get('getAllRoom', 'Master::getAllRoom');
        // $routes->get('getAllCustomer', 'Master::getAllCustomer');
        $routes->post('getAllCustomer', 'Master::getAllCustomer');
        $routes->post('getAllPackage', 'Master::getAllPackage');
    });
    $routes->get('home', 'Pages::view');
    $routes->get('master', 'Master::index');
    $routes->get('company', 'Master::setupCompany');
    $routes->get('branch', 'Master::setupBranch');
    $routes->get('room', 'Master::setupRoom');
    $routes->get('time', 'Master::setupTime');
    $routes->get('weektime', 'Master::setupWeekTime');
    $routes->get('delaytime', 'Master::delaytime');
    $routes->get('advancepay', 'Master::advancepay');
    $routes->get('load_time', 'Master::load_time');
    $routes->get('data', 'Data::index');
    $routes->get('getsetmonthtime', 'Data::getsetmonthtime');
    $routes->get('getappoint', 'Data::getappoint');
    $routes->get('appointment', 'Appointment::index');
    $routes->post('appointmentInsert', 'Appointment::insert');
    $routes->post('setupCalendar', 'Data::setupCalendar');
    $routes->post('editsettime', 'Data::editsettime');
    $routes->post('updatelimit', 'Data::updatelimit');
    $routes->post('appointmentEdit', 'Appointment::update');
    $routes->get('appoint', 'Home::load_appoint');
    $routes->get('team', 'Team::setTeam');
    $routes->get('customer', 'Customer::setupCustomer');
    $routes->get('user', 'SetupMaster::my_user');
    $routes->get('config_user', 'SetupMaster::config_user');
    $routes->get('add_user', 'SetupMaster::add_user');
    $routes->get('editUser/(:num)', 'SetupMaster::editUser/$1');
    $routes->get('passworduser', 'SetupMaster::password_user');
    $routes->post('saveprofile', 'Data::saveprofile');
    $routes->post('changePassword', 'Data::changePassword');
    $routes->post('deactivate', 'Data::deactivate');
    $routes->get('editCustomer/(:num)', 'Customer::editCustomer/$1');
    $routes->post('saveCustomer', 'Customer::saveCustomer');
    $routes->post('saveUser', 'Data::saveUser');
    $routes->post('saveAddUser', 'Data::saveAddUser');
    $routes->post('saveTimedelay', 'Data::saveTimedelay');
    $routes->post('saveAvance', 'Data::saveAvance');
    $routes->post('deletedateCalendar', 'Data::deletedateCalendar');
    $routes->post('deleteAppointDate', 'Data::deleteAppointDate');
    $routes->post('deleteuser', 'Data::deleteuser');
    $routes->get('customerfilter', 'Customer::customerfilter');
    $routes->post('deleteCustomer', 'Data::deleteCustomer');
    
    $routes->get('package', 'Master::setupPackage');
    $routes->get('editPackage/(:num)', 'Master::editPackage/$1');
    $routes->post('savePackage', 'Data::savePackage');
    $routes->post('updatePackage', 'Data::updatePackage');
    $routes->post('delPackage', 'Data::delPackage');
    
    $routes->post('saveCompany','Data::saveCompany');
    
    $routes->get('loadPackageSetTime/(:any)', 'Master::loadPackageSetTime/$1');
    
    $routes->post('uploadFilePackage', 'UploadFile::uploadFilePackage');
    $routes->get('loadFilePackage/(:any)', 'UploadFile::loadFilePackage/$1');
    
    $routes->get('deleteFile/(:any)/(:num)', 'UploadFile::deleteFile/$1/$2');
    
    
});
$routes->group('days',static function ($routes)
{
    $routes->post('update', 'DaysCurd::update');
    $routes->get('create', 'DaysCurd::addDays');
    $routes->post('editrow', 'DaysCurd::editrow');
    $routes->post('delrow', 'DaysCurd::delrow');
    $routes->post('addrow', 'DaysCurd::addrow');
    $routes->post('editchkrow', 'DaysCurd::editchkrow');
});
$routes->group('lineoa',static function ($routes)
{
    $routes->get('api', 'Lineoa::api');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
