<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Receipt
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
    New Receipt
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
     New Receipt
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/new') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                            <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <strong for="">Transaction Date</strong>
                                            <input name="transaction_date" required id="transaction_date" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <strong for="">Coop Bank</strong>
                                            <select name="coop_bank" id="coop_bank" class="form-control">
                                                <option selected disabled>--Select bank--</option>
                                                <?php foreach($coopbanks as $bank): ?>
                                                    <option value="<?= $bank->coop_bank_id ?? '' ?>"><?= $bank->account_no ?? '' ?> - <?= $bank->bank_name ?? '' ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="row ">
                                    
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <strong for="">Amount</strong>
                                            <input type="text"  required  name="amount" id="amount" placeholder="Amount"  class="number form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <strong for="">Purpose</strong>
                                            <textarea name="purpose" id="purpose" placeholder="Purpose" style="resize:none;" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <strong for="">GL CR.</strong>
                                            <select name="gl_cr" id="gl_cr" class="form-control">
                                                <option selected disabled>--Select GL CR.--</option>
                                                <?php foreach($coas as $account) : ?>
                                                    <option value="<?= $account['glcode'] ?>"><?= $account['glcode'] ?? '' ?> - <?= $account['account_name'] ?? '' ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row ">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <strong for="">Payer/Customer</strong>
                                            <select name="customer"  id="customer" class="form-control">
                                                <option disabled selected>--Select payer/customer--</option>
                                                <?php foreach($customers as $customer) : ?>
                                                    <option value="<?= $customer['customer_setup_id']  ?? '' ?>"><?= $customer['customer_name'] ?? '' ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <hr>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-sm btn-primary" id="submitLoanBtn"><i class="ti-check mr-2"></i>Submit</button>
                                </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/simple.money.format.js"></script>
<?= $this->endSection() ?>
