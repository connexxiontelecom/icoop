<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Policy Config  
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <h5 class="sub-title p-3">Policy Config</h5>
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-xl-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Profile</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Savings Rate</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Saving GL Config</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Loan Setup</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <form action="<?= site_url('update-profile') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Coop Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $profile['company_name'] ?? '' ?>" name="company_name" class="form-control" placeholder="Coop Name">
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Logo</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="logo" class="form-control-file" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Authorized Signatory 1:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $profile['signature_1'] ?? '' ?>" class="form-control" placeholder="Authorized Signatory 1" name="signature_1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Authorized Signatory 2:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $profile['signature_2'] ?? '' ?>" class="form-control" placeholder="Authorized Signatory 2" name="signature_2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Authorized Signatory 3:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $profile['signature_3'] ?? '' ?>" class="form-control" placeholder="Authorized Signatory 3" name="signature_3">
                                    </div>
                                </div>
                                <div class="row form-group d-flex justify-content-center">
                                    <button class="btn-mini btn btn-primary"><i class="ti-check mr-2"></i> Save</button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="profile3" role="tabpanel">
                            <form action="<?= site_url('savings-rate') ?>" method="POST">
                            <?= csrf_field() ?>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Minimum saving</label>
                                    <div class="col-sm-10">
                                        <input type="number" value="<?= $profile['minimum_saving'] ?? '' ?>" step="0.01" class="form-control" placeholder="Minimum saving" name="minimum_saving">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Registration Fee</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" value="<?= $profile['registration_fee'] ?? '' ?>" class="form-control" placeholder="Registration Fee" name="registration_fee">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Savings Interest Rate</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" value="<?= $profile['savings_interest_rate'] ?? '' ?>" class="form-control" placeholder="Savings Interest Rate" name="savings_interest_rate">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Savings Withdrawal Charge</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="0.01" value="<?= $profile['savings_withdrawal_charge'] ?? '' ?>" class="form-control" placeholder="Savings Withdrawal Charge" name="savings_withdrawal_charge">
                                    </div>
                                </div>
                            
                                <div class="row form-group d-flex justify-content-center">
                                    <button class="btn-mini btn btn-primary"><i class="ti-check mr-2"></i> Save</button>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="messages3" role="tabpanel">
                            <form action="<?= site_url('savings-gl-config') ?>" method="POST">
                            <?= csrf_field() ?>
                                <table class="table table-stripped">
                                    
                                        <thead>
                                            <th></th>
                                            <th>DR</th>
                                            <th>CR</th>
                                        </thead>
                                        <tr>
                                            <td>
                                                Contribution (Payroll)
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="contribution_payroll_cr" class="form-control" id="contribution_payroll_cr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Contribution (External)
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="contribution_external_cr" class="form-control" id="contribution_external_cr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Withdrawal
                                            </td>
                                            
                                            <td>
                                                <div class="form-group">
                                                    <select name="withdrawal_dr" class="form-control" id="withdrawal_dr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Registration Fee
                                            </td>
                                            
                                            <td>
                                                <div class="form-group">
                                                    <select name="registration_fee_dr" class="form-control" id="registration_fee_dr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="registration_fee_cr" class="form-control" id="registration_fee_cr" >
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Income on Savings Withdrawal Charge
                                            </td>
                                            
                                            <td>
                                                <div class="form-group">
                                                    <select name="income_savings_withdrawal_charge_dr" class="form-control" id="income_savings_withdrawal_charge_dr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="income_savings_withdrawal_charge_cr" class="form-control" id="income_savings_withdrawal_charge_cr">
                                                        <option disabled selected>Select GL</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                </table>   
                                <hr>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save</button>
                                </div>
                            </form>
                            </div>
                            <div class="tab-pane" id="settings3" role="tabpanel">
                            <h5>Loan Types</h5>
                            <form action="<?= site_url('loan-setup') ?>" method="POST" data-parsley-validate="" id="loanSetupForm">
                            <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Loan Description</label>
                                            <input required type="text" name="loan_description" placeholder="Loan Description"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Qualification Age</label>
                                        <div class="input-group mb-3">
                                            <input required type="number" class="form-control" placeholder="Qualification Age" name="qualification_age" >
                                            <div class="input-group-append">
                                                <span class="input-group-text">months</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="psr" id="psr"><span>PSR?</span></label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">PSR Value</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.01" disabled class="form-control" placeholder="PSR Value" id="psr_value" name="psr_value" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">(%)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Min. Credit Limit</label>
                                            <input type="number" required step="0.01" name="min_credit_limit" placeholder="Min. Credit Limit"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Max. Credit Limit</label>
                                            <input type="number" required step="0.01" name="max_credit_limit" placeholder="Max. Credit Limit"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Max. Repayment Periods</label>
                                            <input type="number" required  name="max_repayment_periods" placeholder="Max. Repayment Periods"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Interest Rate</label>
                                            <div class="input-group mb-3">
                                                <input type="number" required step="0.01" class="form-control" placeholder="Interest Rate" name="interest_rate" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text">(%)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Interest Method</label>
                                            <select name="interest_method" required id="interest_method" class="form-control">
                                                <option disabled selected>Select interest method</option>
                                                <option value="1">Flat</option>
                                                <option value="2">Monthly</option>
                                                <option value="3">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <div class="fancy-checkbox">
                                            <label><input type="checkbox" name="commitment" id="commitment"><span>Commitment?</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                        <div class="form-group">
                                            <label for="">Commitment Value</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  step="0.01" disabled class="form-control" placeholder="Commitment Value" name="commitment_value" id="commitment_value">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">(%)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control col-md-4">
                                                <option selected disabled>Select status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Payable</label>
                                            <select name="status" id="status" class="form-control col-md-4">
                                                <option selected disabled>Select payable</option>
                                                <option value="1">Cash</option>
                                                <option value="2">Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Loan GL Account No.</label>
                                            <select required name="loan_gl_account_number" id="loan_gl_account_number" class="form-control">
                                                <option disabled selected>Select Loan GL Account No.</option>
                                                <?php foreach($accounts as $account) : ?>
                                                    <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Loan Unearned Int. GL Account No.</label>
                                            <select required name="loan_unearned_int_gl_account_no" id="loan_unearned_int_gl_account_no" class="form-control">
                                                <option disabled selected>Select Loan Unearned Int. GL Account No</option>
                                                <?php foreach($accounts as $account) : ?>
                                                    <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Loan Int. Income GL Account No.</label>
                                            <select required name="loan_int_income_gl_account_no" id="loan_int_income_gl_account_no" class="form-control">
                                                <option disabled selected>Select Loan Int. Income GL Account No.</option>
                                                <?php foreach($accounts as $account) : ?>
                                                    <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="">Loan Terms</label>
                                            <textarea name="loan_terms" id="loan_terms" class="form-control" style="resize:none;" placeholder="Loan Terms"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#psr").on('change', function() {
                if ($("#psr").is(':checked'))
                    $('#psr_value').prop("disabled", false);
                else {
                    $('#psr_value').prop("disabled", true);
                }
            });
            $("#commitment").on('change', function() {
                if ($("#commitment").is(':checked'))
                    $('#commitment_value').prop("disabled", false);
                else {
                    $('#commitment_value').prop("disabled", true);
                }
            });
            $('#loanSetupForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; // Don't submit form for this demo
            });
        });
    </script>
<?= $this->endSection() ?>
