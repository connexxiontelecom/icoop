<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Policy Config  
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Policy Config.
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
    Policy Config.
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <h5 class="sub-title p-3 text-uppercase text-primary">Policy Config</h5>
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
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Savings Config</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Saving GL Config</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <h6 class="text-primary text-uppercase mb-4">Company Profile</h6>
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
                                <h6 class="text-primary text-uppercase mb-4">Savings Config</h6>
                                    <?= csrf_field() ?>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Minimum saving</label>
                                        <div class="col-sm-8">
                                            <input type="number" value="<?= $profile['minimum_saving'] ?? '' ?>" step="0.01" class="form-control" placeholder="Minimum saving" name="minimum_saving">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Registration Fee</label>
                                        <div class="col-sm-8">
                                            <input type="number" step="0.01" value="<?= $profile['registration_fee'] ?? '' ?>" class="form-control" placeholder="Registration Fee" name="registration_fee">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Savings Interest Rate(%)</label>
                                        <div class="col-sm-8">
                                            <input type="number" step="0.01" value="<?= $profile['savings_interest_rate'] ?? '' ?>" class="form-control" placeholder="Savings Interest Rate" name="savings_interest_rate">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Savings Withdrawal Charge(%)</label>
                                        <div class="col-sm-8">
                                            <input type="number" step="0.01" value="<?= $profile['savings_withdrawal_charge'] ?? '' ?>" class="form-control" placeholder="Savings Withdrawal Charge" name="savings_withdrawal_charge">
                                        </div>
                                    </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Max Withdrawal(%)</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" value="<?= $profile['max_withdrawal_amount'] ?? '0' ?>" class="form-control" placeholder="Max Withdrawal Amount" name="max_withdrawal_amount">
                                    </div>
                                </div>
                                    <div class="row form-group d-flex justify-content-center">
                                        <button class="btn-mini btn btn-primary"><i class="ti-check mr-2"></i> Save</button>
                                    </div>
                            </form>
                            </div>
                            <div class="tab-pane" id="messages3" role="tabpanel">
                                <h6 class="text-primary text-uppercase mb-4">Saving GL Config.</h6>
                                <form action="<?= site_url('savings-gl-config') ?>" method="POST">
                                    <?= csrf_field() ?>
                                    <table class="table table-stripped">
                                        
                                            <tr>
                                                <th></th>
                                                <th>DR</th>
                                                <th>CR</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Contribution (Payroll)
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="contribution_payroll_cr" class="form-control js-example-basic-single" style="width:100% !important;" id="contribution_payroll_cr">
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
                                                        <select name="contribution_external_cr" class="form-control js-example-basic-single" style="width:100% !important;" id="contribution_external_cr">
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
                                                        <select name="withdrawal_dr" class="form-control js-example-basic-single" style="width:100% !important;" id="withdrawal_dr">
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
                                                        <select name="registration_fee_dr" class="form-control js-example-basic-single" style="width:100% !important;" id="registration_fee_dr">
                                                            <option disabled selected>Select GL</option>
                                                            <?php foreach($accounts as $account) : ?>
                                                                <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="registration_fee_cr" class="form-control js-example-basic-single" style="width:100% !important;" id="registration_fee_cr" >
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
                                                        <select name="income_savings_withdrawal_charge_dr" class="form-control js-example-basic-single" style="width:100% !important;" id="income_savings_withdrawal_charge_dr">
                                                            <option disabled selected>Select GL</option>
                                                            <?php foreach($accounts as $account) : ?>
                                                                <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="income_savings_withdrawal_charge_cr" class="form-control js-example-basic-single" style="width:100% !important;" id="income_savings_withdrawal_charge_cr">
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
                                        <button class="btn btn-sm btn-primary"><i class="ti-check mr-2"></i>Save</button>
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
    <script src="/assets/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2();
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
