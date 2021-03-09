<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Payment
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Payment 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Payment
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
                <h2>New Payment</h2>
            </div>
            <div class="body">
                
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                <form enctype="multipart/form-data"  action="<?= site_url('/third-party/new-payment') ?>" id="thirdPartyPaymentEntryForm" autocomplete="off" method="POST" data-parsley-validate="">
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
                                    <label for="">Coop Bank</label>
                                    <select required name="coop_bank" id="coop_bank" class="form-control ">
                                        <option selected disabled>--Select bank--</option>
                                        <?php foreach($coopbank as $bank) : ?>
                                            <option value="<?= $bank->coop_bank_id ?>"><?= $bank->bank_name ?? '' ?> - (<?= $bank->account_no ?? '' ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Reference No.</label>
                                <input type="text" required name="cheque_no" id="cheque_no" placeholder="Reference No." class=" form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Attachment (PDF)</label>
                                <input type="file" required name="attachment" class=" form-control-file">
                            </div>
                        </div>
                    </div>
	
					<div class="row p-2 mb-2" style="background:#2D3541; margin-left: 0.3%; margin-right: 0.3%; margin-top: 1%">
						<div class="col-md-12 col-lg-12">
							<h6 class="text-uppercase text-white">Payment to Disburse</h6>
						</div>
					</div>
                    <div class="row">
                      <div class="col-md-12">
                         <div class="form-group">
                          
                            <div style="min-height:100px; auto-height:300px; overlay">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr class="bg-info">
                                            <td class="text-nowrap">S/No</td>
                                            <td>Payee Name</td>
                                            <td>Payee Bank</td>
                                            <td>Bank</td>
                                            <td>Bank Account No.</td>
                                            <td>Reference No.</td>
                                            <td>Amount</td>
                                            <td>GL Account No.</td>
                                            <td>Action</td>
                                        </tr>
                                        <?php $i = 1; foreach($entries as $entry) : ?>
                                            <tr>
                                                <td>
                                                  <div class="form-group form-check">
                                                        <input type="checkbox"  checked required name="entries[]" class="form-check-input ml-2">
                                                    </div>
                                                </td>
                                                <td><?= $entry->entry_payee_name ?? '' ?>
                                                    <input type="hidden" name="payee_name[]" value="<?= $entry->entry_payee_name ?? '' ?>" >
                                                </td>
                                                <td><?= $entry->entry_payee_bank ?? '' ?>
                                                    <input type="hidden" name="payee_bank[]" value="<?= $entry->entry_payee_bank ?? '' ?>" >
                                                </td>
                                                <td><?= $entry->bank_name ?? '' ?>
                                                    <input type="hidden" name="bank_name[]" value="<?= $entry->bank_name ?? '' ?>" >
                                                </td>
                                                <td><?= $entry->account_no ?? '' ?>
                                                    <input type="hidden" name="account_no[]" value="<?= $entry->account_no ?? '' ?>" >
                                                </td>
                                                <td><?= $entry->entry_reference_no ?? '' ?>
                                                    <input type="hidden" name="reference_no[]" value="<?= $entry->entry_reference_no ?? '' ?>" >
                                                </td>
                                                <td class="text-right"><?= number_format($entry->entry_amount,2) ?? '' ?>
                                                    <input type="hidden" name="entry_amount[]" value="<?= $entry->entry_amount ?? '' ?>" >
                                                </td>
                                                <td><?= $entry->entry_gl_account_no ?? '' ?>
                                                    <input type="hidden" name="gl_account_no[]" value="<?= $entry->entry_gl_account_no ?? '' ?>" >
                                                    <input type="hidden" name="entry_id[]" value="<?= $entry->third_party_payment_entry_id ?? '' ?>">
                                                </td>
                                                <td> <a href="">Return </a> </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                         </div>
                      </div>
                    </div>
                    <hr>
                    <?php if(count($entries) > 0): ?>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end col-sm-12 col-lg-12">
                              <div class="btn-group">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm">Add To Cart</button>
                              </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
