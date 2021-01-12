<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Edit Loan Setup  
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-6 col-xl-6">
                        <h5 class="sub-title p-3 text-primary">Loan Setup</h5>
                        <form action="<?= site_url('loan-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
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
                                        <input required type="number" class="form-control" placeholder="Qualification Age" name="qualification_age"  >
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
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox" name="commitment" id="commitment"><span>Commitment?</span></label>
                                    </div>
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
                                        <select name="status" id="status" class="form-control">
                                            <option selected disabled>Select status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Block</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="">Payable</label>
                                        <select name="payable" id="payable" class="form-control">
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

                    <div class="col-lg-6 col-xl-6 bg-light">
                        <h5 class="text-primary p-3 sub-title">Loan Types</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Loan Description</th>
                                    <th scope="col">Qualification Age</th>
                                    <th scope="col">Min. Credit Limit.</th>
                                    <th scope="col">Max. Credit Limit.</th>
                                    <th scope="col">Max. Repayment Periods</th>
                                    <th scope="col">Interest Rate</th>
                                    <th scope="col">Interest Method</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payable</th>
                                    <th scope="col">Loan GL Account No.</th>
                                    <th scope="col">Loan Unearned Int. GL Account No.</th>
                                    <th scope="col">Loan Int. Income GL Account No.</th>
                                    <th scope="col">Loan Terms</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                <tbody>
                                <?php $serial = 1; ?>
                                <?php foreach($loansetups as $setup) : ?>
                                    <tr>
                                        <td scope="col"><?= $serial++ ?></td>
                                        <td scope="col"><?= $setup['loan_description'] ?></td>
                                        <td scope="col"><?= $setup['age_qualification'] ?> month(s)</td>
                                        <td scope="col">₦<?= number_format($setup['min_credit_limit'],2) ?></td>
                                        <td scope="col">₦<?= number_format($setup['max_credit_limit'],2) ?></td>
                                        <td scope="col"><?= $setup['max_repayment_periods'] ?></td>
                                        <td scope="col"><?= $setup['interest_rate'] ?>%</td>
                                        <td scope="col"><?php if($setup['interest_method'] == 1){ echo "Flat"; }else if($setup['interest_method'] == 2){ echo "Monthly"; }else{ echo "Yearly"; }?></td>
                                        <td scope="col"><?= $setup['status'] == 1 ? 'Active' : 'Blocked' ?></td>
                                        <td scope="col"><?= $setup['payable'] == 1 ? 'Cash' : 'Vendor' ?></td>
                                        <td scope="col"><?= $setup['loan_gl_account_no'] ?></td>
                                        <td scope="col"><?= $setup['loan_unearned_int_gl_account_no'] ?></td>
                                        <td scope="col"><?= $setup['loan_int_income_gl_account_no'] ?></td>
                                        <td scope="col"><?= $setup['loan_terms'] ?></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-warning text-white">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
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
