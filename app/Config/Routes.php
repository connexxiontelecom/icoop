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
$routes->post('/edit-coop-bank', 'Housekeepingcontroller::editCoopBank');

#Policy config routes
$routes->get('/policy-config', 'Policyconfigcontroller::index');
$routes->post('/update-profile', 'Policyconfigcontroller::updateProfile');
$routes->post('/savings-rate', 'Policyconfigcontroller::savingsRate');
$routes->post('/savings-gl-config', 'Policyconfigcontroller::savingGlConfig');
$routes->get('/policy-config/loan-setup', 'Policyconfigcontroller::showLoanSetupForm');
$routes->post('/loan-setup', 'Policyconfigcontroller::loanSetup');
$routes->post('/edit-loan-setup', 'Policyconfigcontroller::editLoanSetup');

#control panel
$routes->get('contribution_type', 'ContributionType::contribution_type');
$routes->post('contribution_type', 'ContributionType::contribution_type');
$routes->get('payroll_group', 'PayRollGroup::payroll_group');
$routes->post('payroll_group', 'PayRollGroup::payroll_group');
$routes->get('upload_routine', 'Routine::upload_routine');
$routes->get('contribution_upload', 'Routine::contribution_upload');
$routes->post('contribution_upload', 'Routine::process_contribution_upload');
$routes->post('p_contribution_upload', 'Routine::p_contribution_upload');
$routes->get('interest_routine', 'Routine::interest_routine');
$routes->post('interest_routine', 'Routine::interest_routine');
$routes->get('lr_upload', 'Routine::lr_upload');
$routes->post('lr_upload', 'Routine::process_lr_upload');
$routes->post('p_lr_upload', 'Routine::p_lr_upload');


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
$routes->get('cooperators', 'Cooperators::cooperators');
$routes->get('cooperator/(:num)', 'Cooperators::coperator/$1');
$routes->get('ledger/(:any)', 'Cooperators::ledger/$1');
$routes->post('ledger/(:any)', 'Cooperators::ledger/$1');
$routes->get('view_ledger/(:num)/(:any)', 'Cooperators::view_ledger/$1/$2');
$routes->get('loan_ledger/(:any)', 'Cooperators::loan_ledger/$1');
$routes->post('loan_ledger/(:any)', 'Cooperators::loan_ledger/$1');

#Loan routes
$routes->get('/loan/new', 'LoanController::showLoanApplicationForm');
$routes->post('/loan/new', 'LoanController::storeLoanApplication');
$routes->get('/get-cooperator/(:num)', 'LoanController::getCooperator/$1');
$routes->post('/get-savings', 'LoanController::getSavings');
$routes->get('/get-guarantor/(:num)', 'LoanController::getGuarantor/$1');
$routes->get('/loan/verify', 'LoanController::showVerifyApplications');
$routes->post('/loan/verify', 'LoanController::verifyLoanApplication');
$routes->get('/get-loan-type/(:num)', 'LoanController::getLoanType/$1');
$routes->get('/view-loan-application/(:num)', 'LoanController::viewLoanApplication/$1');
$routes->get('/loan/approve', 'LoanController::showApproveApplications');
$routes->post('/loan/approve', 'LoanController::approveLoanApplication');
#Payment routes
$routes->get('/loan/new-payment-schedule', 'PaymentController::newPaymentSchedule');
$routes->post('/loan/new-payment-schedule', 'PaymentController::postNewPaymentSchedule');
$routes->get('/loan/payment-schedules', 'PaymentController::showScheduledPayments');
$routes->get('/loan/verified-payment-schedules', 'PaymentController::showVerifiedScheduledPayments');
$routes->get('/loan/payment-schedule/(:num)', 'PaymentController::showPaymentScheduleDetail/$1');
$routes->get('/loan/return-schedule-payment/(:num)', 'PaymentController::returnSchedulePayment/$1');
//$routes->get('/withdraw/return-schedule-payment/(:num)', 'PaymentController::returnWithdrawSchedulePayment/$1');
$routes->post('/loan/return-bulk-schedule', 'PaymentController::returnBulkSchedule');
$routes->post('/loan/verify-schedule', 'PaymentController::verifySchedule');
$routes->post('/loan/approve-schedule', 'PaymentController::approveSchedule');
$routes->get('/loan/payables', 'LoanController::showLoandPayables'); 
$routes->post('/loan/payable-action', 'LoanController::loanPayableAction');
$routes->post('/loan/add-payment-to-cart', 'PaymentController::addPaymentToCart');
$routes->get('/loan/remove-from-cart/(:num)', 'PaymentController::removeFromCart/$1');
$routes->get('/loan/remove-withdraw-from-cart/(:num)', 'PaymentController::removeWithdrawFromCart/$1');
#3rd-party payments
$routes->get('/third-party/payment/entry', 'PaymentController::entry');
$routes->post('/third-party/payment/entry', 'PaymentController::postThirdpartyPaymentEntry');
$routes->get('/third-party/new-payment', 'PaymentController::newPayment');
$routes->post('/third-party/new-payment', 'PaymentController::postNewPayment');



#Messaging routes
$routes->get('/messaging/compose-email', 'MessagingController::showComposeEmailView');
$routes->post('/messaging/compose-email', 'MessagingController::sendEmail');
$routes->get('/messaging/mails', 'MessagingController::showMails');
$routes->get('/messaging/open-mail/(:num)', 'MessagingController::openMail/$1');
$routes->get('/messaging/bulk-sms', 'MessagingController::showBulkSms');
$routes->post('/messaging/bulk-sms', 'MessagingController::sendBulkSms');

##Withdraw Routes
$routes->get('new_withdraw', 'Withdraw::new_withdraw');
$routes->post('new_withdraw', 'Withdraw::new_withdraw');
$routes->get('search_cooperator', 'Withdraw::search_cooperator');
$routes->post('compute_balance', 'Withdraw::compute_balance');
$routes->post('get_ct', 'Withdraw::get_ct');
$routes->post('verify_withdrawal', 'Withdraw::verify_withdrawal');
$routes->get('verify_withdrawal', 'Withdraw::verify_withdrawal');
$routes->post('approve_withdrawal', 'Withdraw::approve_withdrawal');
$routes->get('approve_withdrawal', 'Withdraw::approve_withdrawal');



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
