<?php namespace Config;

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
$routes->setDefaultController('Usercontroller');
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
$routes->get('/', 'Usercontroller::index');

#Error
$routes->get('error_404', 'Usercontroller::error_404');


#Auth routes
$routes->get('/login', 'Usercontroller::showLoginForm');
$routes->post('/login', 'Usercontroller::login');
$routes->get('/register', 'Usercontroller::showRegistrationForm');
$routes->post('/register', 'Usercontroller::register');
$routes->get('/logout', 'Usercontroller::logout');
$routes->get('(:any)/login', 'Usercontroller::showLoginForm');

#user routes
$routes->get('/dashboard', 'Usercontroller::dashboard');


#House keeping routes
$routes->get('/states', 'Housekeepingcontroller::states');
$routes->post('/add-new-state', 'Housekeepingcontroller::addNewState');
$routes->get('/locations', 'Housekeepingcontroller::locations');
$routes->post('/add-new-location', 'Housekeepingcontroller::addNewLocation');
$routes->post('/edit-location', 'Housekeepingcontroller::editLocation');
$routes->get('/banks', 'Housekeepingcontroller::banks');
$routes->post('/add-new-bank', 'Housekeepingcontroller::addNewBank');
$routes->get('/departments', 'Housekeepingcontroller::departments');
$routes->post('/add-new-department', 'Housekeepingcontroller::addNewDepartment');
$routes->get('/coop-banks', 'Housekeepingcontroller::coopBanks');
$routes->post('/coop-bank', 'Housekeepingcontroller::addNewCoopBank');

#Policy config routes
$routes->get('/policy-config', 'Policyconfigcontroller::index');
$routes->post('/update-profile', 'Policyconfigcontroller::updateProfile');
$routes->post('/savings-rate', 'Policyconfigcontroller::savingsRate');
$routes->post('/savings-gl-config', 'Policyconfigcontroller::savingGlConfig');
$routes->get('/policy-config/loan-setup', 'Policyconfigcontroller::showLoanSetupForm');
$routes->post('/loan-setup', 'Policyconfigcontroller::loanSetup');

#control panel
$routes->get('contribution_type', 'ContributionType::contribution_type');
$routes->post('contribution_type', 'ContributionType::contribution_type');

#chart of accounts
$routes->get('/chart-of-accounts', 'ChartOfAccountController::index');
$routes->get('/add-new-chart-of-account', 'ChartOfAccountController::create');
$routes->post('/add-new-chart-of-account', 'ChartOfAccountController::saveAccount');
$routes->get('/get-parent-account', 'ChartOfAccountController::getParentAccount');
#Journal voucher
$routes->get('/journal-voucher', 'JournalVoucher::index');
$routes->get('/new-journal-voucher', 'JournalVoucher::create');
$routes->post('/new-journal-voucher', 'JournalVoucher::store');
$routes->get('/view-journal-voucher/(:num)', 'JournalVoucher::view/$1');
$routes->get('/post-journal-voucher/(:num)', 'JournalVoucher::post/$1');
$routes->get('/decline-journal-voucher/(:num)', 'JournalVoucher::decline/$1');


#cooperators routes
$routes->get('new_application', 'Cooperators::new_application');
$routes->post('new_application', 'Cooperators::new_application');
$routes->get('verify_application', 'Cooperators::verify_application');
$routes->get('verify_application/(:num)', 'Cooperators::verify_application_/$1');
$routes->post('verify_application/(:num)', 'Cooperators::verify_application_/$1');
$routes->get('approve_application', 'Cooperators::approve_application');
$routes->get('approve_application/(:num)', 'Cooperators::approve_application_/$1');
$routes->post('approve_application/(:num)', 'Cooperators::approve_application_/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
