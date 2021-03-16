<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    Approve Receipt 
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Approve Receipt 
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    Approve Receipt 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/sweetalert/sweetalert.css"/>
    <link rel="stylesheet" href="/assets/css/toastify.min.css"/>
    <link rel="stylesheet" href="/assets/css/datatable.min.css"/>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-body">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">Approve Receipt </h6>
                        <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="scheduledPaymentTable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Customer Name</td>
                                <td>Amount</td>
                                <td>Date</td>
                                <td>Bank</td>
                                <td>GL Account</td>
                                <td>Action</td>
                            </tr>
                        
                        </thead>

                        <tbody>
                        
                            <?php $i = 1; foreach($receivables as $app) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $app->customer_name ?? '' ?></td>
                                    <td class="text-right"><?= number_format($app->cr_amount,2) ?? '' ?> </td>
                                    <td><?= date('d-M-Y', strtotime($app->cr_transaction_date)) ?? '' ?> </td>
                                    <td><?= $app->cr_coop_bank_id ?? '' ?> - <?= $app->description ?? '' ?> </td>
                                    <td><?= $app->cr_gl_cr ?? '' ?> - <?= $app->account_name ?? '' ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $app->coa_id ?? '' ?>"><i class="fa fa-pencil-square-o"></i></button>
                                        <div class="modal fade" id="editModal<?= $app->coa_id ?? '' ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Receipt Detail</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/approve-decline-receivable') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                                                            <?= csrf_field() ?>
                                                                <div class="row bg-light">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <strong for="">Customer/Debtor Name </strong>
                                                                            <input disabled required type="text" name="customer_name" value="<?= $app->customer_name ?? '' ?>"   placeholder="Customer Name"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Amount</strong>
                                                                            <input disabled type="text" name="amount" value="<?= $app->cr_amount ?? '' ?>" class="form-control" placeholder="Amount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row bg-light">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Transaction Date</strong>
                                                                            <input disabled type="text" required class="form-control" placeholder="Transaction Date" value="<?= date('d-M-Y', strtotime($app->cr_transaction_date)) ?? '' ?> " name="transaction_date" >
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Phone No.</strong>
                                                                            <input disabled type="text" required  name="phone_no" value="<?= $app->phone_no ?? '' ?>" placeholder="Phone Number"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row bg-light">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">GL Account Code</strong>
                                                                             <input type="text" disabled value="<?= $app->cr_gl_cr ?? '' ?> - <?= $app->account_name ?? '' ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                <input type="hidden" name="customer_receivable" value="<?= $app->customer_receivable_id ?>">
                                                                <input type="hidden" name="customer_setup" value="<?= $app->cr_customer_setup_id ?>">
                                                                <input type="hidden" name="receivable_status" value="approved">
                                                                        <div class="btn-group">
                                                                            <button class="btn-sm btn btn-primary text-white" type="submit">Approve</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </div>
                                                    </form>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </tfoot>
                    </table>
                </div>
                </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    <script src="/assets/js/datatables.min.js"></script>
<script>
$(document).ready(function(){
    $('#scheduledPaymentTable').DataTable();
});
</script>
<?= $this->endSection() ?>
