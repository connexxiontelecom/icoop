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
    <link href="/assets/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-md-12 col-xl-12 mb-4">
                        <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/customer-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                                <?= csrf_field() ?>
                                    <div class="row ">
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
                                    <div class="row ">
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
                                        <div class="row ">
                                            <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                <div class="form-group">
                                                    <strong for="">GL Account Code</strong>
                                                    <select name="gl_account_code" id="gl_account_code" class="form-control js-example-basic-single">
                                                        <option selected disabled>--Select GL Account Code--</option>
                                                        <?php foreach($accounts as $account) : ?>
                                                            <option value="<?= $account['glcode'] ?? '' ?>"><?= $account['account_name'] ?? '' ?> - <?= $account['glcode'] ?? '' ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
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
     <script src="/assets/js/select2.min.js"></script>
     <script>
$(document).ready(function(){
     $('.js-example-basic-single').select2();
});
</script>
<?= $this->endSection() ?>
