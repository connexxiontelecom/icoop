<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payment Entry Voucher
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payment Entry Voucher 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payment Entry Voucher
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }
    </style>
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>
<link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Payment Voucher Entry</h2>
            </div>
            <div class="body">
                
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                <form   action="<?= site_url('/third-party/payment/entry') ?>" id="thirdPartyPaymentEntryForm" autocomplete="off" method="POST" data-parsley-validate="">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" required name="payable_date" id="payable_date" placeholder="dd-mm-yyy" class=" form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" required step="0.01" name="amount" id="amount" placeholder="Amount" class=" form-control">
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">GL Account No.</label>
                                <select required name="gl_account" id="gl_account" class="form-control js-example-basic-single">
                                    <option selected disabled>--Select --</option>
                                    <?php foreach($coas as $coa) : ?>
                                            <option value="<?= $coa['glcode'] ?>"><?= $coa['glcode'] ?? '' ?> - <?= $coa['account_name'] ?? '' ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Reference No.</label>
                                    <input type="text" required name="reference_no" id="reference_no" placeholder="Reference No." class=" form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Narration</label>
                                    <input class="form-control" placeholder="Narration" name="narration" id="narration">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Payee Name</label>
                                    <input type="text" required name="payee_name" id="payee_name" placeholder="Payee Name" class=" form-control">
                                </div>
                            </div>
                    </div>
                    <div class="row p-2 mb-2" style="background:#2D3541;">
                        <div class="col-md-12 col-lg-12">
                            <h6 class="text-uppercase text-white">Payee Details</h6>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Payee Bank</label>
                                    <select required name="payee_bank" id="payee_bank" class="form-control js-example-basic-single">
                                        <option selected disabled>--Select --</option>
                                        <?php foreach($coopbank as $coop) : ?>
                                                <option value="<?= $coop->coop_bank_id ?>"><?= $coop->account_no ?? '' ?> - <?= $coop->bank_name ?? '' ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank Account No.</label>
                                    <input type="text" required name="bank_account_no" id="bank_account_no" placeholder="Bank Account No." class=" form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Sort Code</label>
                                    <input class="form-control" placeholder="Sort Code" name="sort_code" id="sort_code">
                                </div>
                            </div>
                    </div>
                        <div class="row"> 
                         <div class="col-md-12 col-lg-12 col-sm-12 response">
                            <div class="form-group">
                                <strong for="">File (.PDF) - <small>Optional</small></strong>
                                <input type="file"  name="attachment" id="attachment" >
                            </div>
                        </div> 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center col-sm-12 col-lg-12">
                              <div class="btn-group">
                                 <a class="btn btn-danger btn-sm" href="">Cancel</a>
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                              </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
    <script src="/assets/js/select2.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script src="/assets/js/parsley.min.js"></script>
<script>
$(document).ready(function(){
     $('.js-example-basic-single').select2();
     $('#thirdPartyPaymentEntryForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        .on('form:submit', function() {
            return true; 
        });
});
</script>
<?= $this->endSection() ?>
