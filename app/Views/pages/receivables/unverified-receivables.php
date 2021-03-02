<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    Verify Receivables 
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Verify Receivables 
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    Verify Receivables 
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
                        <h6 class="sub-title p-3  text-uppercase">Verify Receivables </h6>
                        <div class="table-responsive">
                    <table class="table table-bordered dataTable js-exportable simpletable" id="stateTable">
                        
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Bank</th>
                            <th>GL Account</th>
                            <th>Action</th>
                        </tr>

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
                                                        <h5 class="modal-title" id="exampleModalLabel">Action</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/approve-decline-receivable') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                                                            <?= csrf_field() ?>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <strong for="">Customer/Debtor Name </strong>
                                                                            <input required disabled type="text" name="customer_name" value="<?= $app->customer_name ?? '' ?>"   placeholder="Customer Name"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Amount</strong>
                                                                            <input type="text" disabled name="amount" value="<?= $app->cr_amount ?? '' ?>" class="form-control" placeholder="Amount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Transaction Date</strong>
                                                                            <input type="text" disabled required class="form-control" placeholder="Transaction Date" value="<?= date('d-M-Y', strtotime($app->cr_transaction_date)) ?? '' ?> " name="transaction_date" >
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">Phone No.</strong>
                                                                            <input type="text" disabled required  name="phone_no" value="<?= $app->phone_no ?? '' ?>" placeholder="Phone Number"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                        <div class="form-group">
                                                                            <strong for="">GL Account Code</strong>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <hr>
                                                                <div class="row p-3">
                                                                    <div class="col-md-12 d-flex justify-content-center">
                                                                        <input type="hidden" name="customer_receivable" value="<?= $app->customer_receivable_id ?>">
                                                                        <input type="hidden" name="receivable_status" value="verified">
                                                                        <div class="btn-group">
                                                                            <button class="btn-sm btn btn-warning text-white" type="submit">Verify</button>
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
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
