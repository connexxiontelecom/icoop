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
$routes->post('check_user', 'Usercontroller::check_user');

$routes->get('new_user', 'Usercontroller::new_user');
$routes->post('new_user', 'Usercontroller::new_user');
$routes->get('users', 'Usercontroller::users');

$routes->post('manage_user/(:num)', 'Usercontroller::manage_user/$1');
$routes->get('manage_user/(:num)', 'Usercontroller::manage_user/$1');

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
$routes->get('/policy-config/new-loan-setup', 'Policyconfigcontroller::new_loan_setup');
$routes->post('/loan-setup', 'Policyconfigcontroller::loanSetup');
$routes->post('/edit-loan-setup', 'Policyconfigcontroller::editLoanSetup');

#control panel
$routes->get('contribution_type', 'ContributionType::contribution_type');
$routes->post('contribution_type', 'ContributionType::contribution_type');
$routes->get('payroll_group', 'PayRollGroup::payroll_group');
$routes->post('payroll_group', 'PayRollGroup::payroll_group');
$routes->get('upload_routine', 'Routine::upload_routine');
$routes->get('cancel_ct', 'Routine::cancel_ct_upload');
$routes->get('contribution_upload', 'Routine::contribution_upload');
$routes->post('contribution_upload', 'Routine::process_contribution_upload');
$routes->post('p_contribution_upload', 'Routine::p_contribution_upload');
$routes->get('interest_routine', 'Routine::interest_routine');
$routes->post('interest_routine', 'Routine::interest_routine');
$routes->get('lr_upload', 'Routine::lr_upload');
$routes->post('lr_upload', 'Routine::process_lr_upload');
$routes->post('p_lr_upload', 'Routine::p_lr_upload');
$routes->get('cancel_lr', 'Routine::cancel_lr_upload');
$routes->get('savings_exception', 'Routine::savings_exception');
$routes->post('savings_exception', 'Routine::savings_exception');
$routes->get('lr_exception', 'Routine::lr_exception');
$routes->post('lr_exception', 'Routine::lr_exception');


#chart of accounts
$routes->get('/chart-of-accounts', 'ChartOfAccountController::index');
$routes->get('/add-new-chart-of-account', 'ChartOfAccountController::create');
$routes->post('/add-new-chart-of-account', 'ChartOfAccountController::saveAccount');
$routes->get('/get-parent-account', 'ChartOfAccountController::getParentAccount');
#Report routes
$routes->get('/profit-loss', 'AccountingReportController::showProfitLoss');
$routes->get('/trial-balance', 'AccountingReportController::showTrialBalanceForm');
$routes->post('/trial-balance', 'AccountingReportController::trialBalance');
#Journal voucher
$routes->get('/journal-voucher', 'JournalVoucher::index');
$routes->get('/new-journal-voucher', 'JournalVoucher::create');
$routes->post('/new-journal-voucher', 'JournalVoucher::store');
$routes->get('/view-journal-voucher/(:any)', 'JournalVoucher::view/$1');
//$routes->get('/post-journal-voucher/(:num)', 'JournalVoucher::post/$1');

$routes->post('post-journal-voucher', 'JournalVoucher::post');
//$routes->get('/decline-journal-voucher/(:num)', 'JournalVoucher::decline/$1');
$routes->post('decline-journal-voucher', 'JournalVoucher::decline');


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
$routes->get('finished_loan_ledger/(:any)', 'Cooperators::finished_loan_ledger/$1');
$routes->post('finished_loan_ledger/(:any)', 'Cooperators::finished_loan_ledger/$1');
$routes->get('freeze', 'Cooperators::freeze');
$routes->post('freeze', 'Cooperators::freeze');
$routes->get('new_closure', 'Cooperators::new_closure');
$routes->post('new_closure', 'Cooperators::new_closure');
$routes->get('verify_closure', 'Cooperators::verify_closure');
$routes->post('verify_closure', 'Cooperators::verify_closure');
$routes->get('approve_closure', 'Cooperators::approve_closure');
$routes->post('approve_closure', 'Cooperators::approve_closure');
$routes->get('cooperator_reports', 'Cooperators::reports');
$routes->get('savings_report', 'Cooperators::savings_report');
$routes->Post('savings_report', 'Cooperators::savings_report');
$routes->get('analysis_report', 'Cooperators::analysis_report');
$routes->Post('analysis_report', 'Cooperators::analysis_report');
$routes->get('withdrawal_report', 'Cooperators::withdrawal_report');
$routes->Post('withdrawal_report', 'Cooperators::withdrawal_report');
$routes->get('payroll_contribution_report', 'Cooperators::payroll_contribution_report');
$routes->Post('payroll_contribution_report', 'Cooperators::payroll_contribution_report');
$routes->get('external_savings_report', 'Cooperators::external_savings_report');
$routes->Post('external_savings_report', 'Cooperators::external_savings_report');
$routes->get('journal_transfer_report', 'Cooperators::journal_transfer_report');
$routes->Post('journal_transfer_report', 'Cooperators::journal_transfer_report');


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
$routes->get('/loan/search-cooperator', 'LoanController::searchCooperator');
$routes->get('/loan/report', 'LoanController::showApprovedLoanReports');
$routes->get('/loan/index/report', 'LoanController::showApprovedLoanReportSection');
$routes->post('/loan/report', 'LoanController::generateLoanApplicationReport');
$routes->get('/loan/index/disapproved-report', 'LoanController::showDisapprovedLoanReportSection');
$routes->post('/loan/disapproved-loan-report', 'LoanController::generateDisapprovedLoanApplicationReport');
$routes->get('/loan/index/disbursed-report', 'LoanController::showDisbursedLoanReportSection');

$routes->post('/cooperator/account-status', 'LoanController::getCooperatorAccountStatus');

$routes->post('get_al', 'LoanController::get_active_loan');

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
$routes->get('/third-party/verify-payment-entry', 'PaymentController::verifyPaymentEntry');
$routes->get('/third-party/view-verify-payment-entry/(:num)', 'PaymentController::viewVerifyPaymentEntry/$1');
$routes->post('/third-party/view-verify-payment-entry', 'PaymentController::postVerifyPaymentEntry');
$routes->get('/third-party/approve-payment-entry', 'PaymentController::approvePaymentEntry');
$routes->post('/third-party/approved-payment-entry', 'PaymentController::postApprovedPaymentEntry');
$routes->get('/third-party/return-payment/(:num)', 'PaymentController::returnPayment/$1');
$routes->get('/third-party/payment-list', 'PaymentController::paymentList');
$routes->get('/third-party/payment-entry/(:num)', 'PaymentController::getThirdpartyEntry/$1');
$routes->get('/third-party/return-all/unverified/(:num)', 'PaymentController::returnAllUnverifiedPaymentEntry/$1');
$routes->get('/third-party/return-entry/unverified/(:num)', 'PaymentController::returnOneUnverifiedPaymentEntry/$1');

#Third-party receivable routes
$routes->get('/third-party/receivable/customer-setup', 'ThirdpartyReceivableController::showCustomerSetupForm');
$routes->post('/third-party/receivable/customer-setup', 'ThirdpartyReceivableController::storeCustomerSetup');
$routes->get('/third-party/receivable/customer-setup-list', 'ThirdpartyReceivableController::customerSetupList');
$routes->post('/third-party/receivable/edit-customer-setup', 'ThirdpartyReceivableController::editCustomerSetup');
#New receivable
$routes->get('/third-party/receivable/new', 'ThirdpartyReceivableController::showNewReceivableForm');
$routes->post('/third-party/receivable/new', 'ThirdpartyReceivableController::storeNewCustomerReceivable');
$routes->get('/third-party/receivable/unverified', 'ThirdpartyReceivableController::showUnverifiedReceivable');
$routes->get('/third-party/receivable/verified', 'ThirdpartyReceivableController::showVerifiedReceivable');
$routes->post('/third-party/receivable/approve-decline-receivable', 'ThirdpartyReceivableController::approveDeclineReceivable');
$routes->get('/third-party/receivable/report', 'ThirdpartyReceivableController::report');
$routes->post('/third-party/receivable/report', 'ThirdpartyReceivableController::generateReport');
$routes->get('/third-party/receivable/member-report', 'ThirdpartyReceivableController::memberReport');
$routes->post('/third-party/receivable/member-report', 'ThirdpartyReceivableController::generateMemberReport');
$routes->get('/third-party/view-receipt/(:num)', 'ThirdpartyReceivableController::viewThirdpartyReceipt/$1');
$routes->get('/third-party/email-receipt/(:num)', 'ThirdpartyReceivableController::emailThirdpartyReceipt/$1');
$routes->get('/third-party/view-member-receipt/(:num)', 'ThirdpartyReceivableController::viewMemberyReceipt/$1');

#Saving variations routes
$routes->get('/saving-variations/new', 'SavingVariationController::showSavingVariationForm');
$routes->post('/saving-variations/new', 'SavingVariationController::postSavingVariationForm');
$routes->get('/saving-variations/unverified', 'SavingVariationController::showUnverifiedSavingVariations');
$routes->get('/get-payment-details/(:num)', 'SavingVariationController::getPaymentDetails/$1');
$routes->post('/get-staff-ct', 'SavingVariationController::getStaffContributionType');
$routes->post('/verify-saving-variation', 'SavingVariationController::verifySavingVariation');
$routes->get('/saving-variations/verified', 'SavingVariationController::showVerifiedSavingVariations');
$routes->post('/approve-saving-variation', 'SavingVariationController::approveSavingVariation');
$routes->get('/saving-variations/index/report', 'SavingVariationController::showReportIndex');
$routes->get('/saving-variations/report', 'SavingVariationController::showReport');
$routes->post('/saving-variations/report', 'SavingVariationController::generateSavingVariationsReport');

#Help desk routes
$routes->get('/help-desk/loan-application', 'HelpDeskController::getLoanApplication');
$routes->get('/help-desk/withdraw-application', 'HelpDeskController::getWithdrawApplication');
$routes->get('/help-desk/account-closure-application', 'HelpDeskController::getAccountClosureApplication');
$routes->get('/help-desk/journal-transfer', 'HelpDeskController::getJournalTransferApplication');



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


### Receipt Routes
$routes->post('new_receipt', 'Receipt::new_receipt');
$routes->get('new_receipt', 'Receipt::new_receipt');
$routes->post('verify_receipt', 'Receipt::verify_receipt');
$routes->get('verify_receipt', 'Receipt::verify_receipt');
$routes->post('approve_receipt', 'Receipt::approve_receipt');
$routes->get('approve_receipt', 'Receipt::approve_receipt');


$routes->post('new_transfer', 'Receipt::new_transfer');
$routes->get('new_transfer', 'Receipt::new_transfer');
$routes->post('verify_transfer', 'Receipt::verify_transfer');
$routes->get('verify_transfer', 'Receipt::verify_transfer');
$routes->post('approve_transfer', 'Receipt::approve_transfer');
$routes->get('approve_transfer', 'Receipt::approve_transfer');

### Reconciliation Routes
$routes->get('new_savings_reconciliation', 'Reconciliation::new_savings_reconciliation');
$routes->post('new_savings_reconciliation', 'Reconciliation::new_savings_reconciliation');
$routes->get('verify_savings_reconciliation', 'Reconciliation::verify_savings_reconciliation');
$routes->post('verify_savings_reconciliation', 'Reconciliation::verify_savings_reconciliation');
$routes->get('approve_savings_reconciliation', 'Reconciliation::approve_savings_reconciliation');
$routes->post('approve_savings_reconciliation', 'Reconciliation::approve_savings_reconciliation');

$routes->get('new_loans_reconciliation', 'Reconciliation::new_loans_reconciliation');
$routes->post('new_loans_reconciliation', 'Reconciliation::new_loans_reconciliation');
$routes->get('verify_loans_reconciliation', 'Reconciliation::verify_loans_reconciliation');
$routes->post('verify_loans_reconciliation', 'Reconciliation::verify_loans_reconciliation');
$routes->get('approve_loans_reconciliation', 'Reconciliation::approve_loans_reconciliation');
$routes->post('approve_loans_reconciliation', 'Reconciliation::approve_loans_reconciliation');


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
