<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    Customer Setup
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Customer Setup
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    Customer Setup
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">Customer Setup</h6>
                        <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/customer-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                                <?= csrf_field() ?>
                                    <div class="row p-2 mb-2" style="background:#2D3541;">
                                        <div class="col-md-12 col-lg-12">
                                            <h6 class="text-uppercase text-white">Details</h6>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <strong for="">Customer/Debtor Name </strong>
                                                <input required type="text" name="customer_name" id="customer_name"   placeholder="Customer Name"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 response">
                                            <div class="form-group">
                                                <strong for="">Contact Person</strong>
                                                <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact Person">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-md-6 col-lg-6 col-sm-6 response">
                                            <div class="form-group">
                                                <strong for="">Email</strong>
                                                <input type="text" required class="form-control" placeholder="Email Address" id="email" name="email" >
                                                
                                            </div>
                                        </div>
                                         <div class="col-md-6 col-lg-6 col-sm-6 response">
                                            <div class="form-group">
                                                <strong for="">Phone No.</strong>
                                                <input type="text" required  name="phone_no" id="phone_no" placeholder="Phone Number"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-md-6 col-lg-6 col-sm-6 response">
                                            <div class="form-group">
                                                <strong for="">GL Account Code</strong>
                                                <select name="gl_account_code" id="gl_account_code" class="form-control">
                                                    <option selected disabled>--Select GL Account Code--</option>
                                                    <?php foreach($accounts as $account) : ?>
                                                        <option value="<?= $account['glcode'] ?? '' ?>"><?= $account['account_name'] ?? '' ?> - <?= $account['glcode'] ?? '' ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-md-12 ">
                                            <button class="btn btn-sm btn-primary" type="submit" id="submitLoanBtn"><i class="ti-check mr-2"></i>Submit</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
