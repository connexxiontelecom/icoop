<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Payment Schedule  
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Payment Schedule  
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Payment Schedule 
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

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="header">
        <h2>Payment Schedule Detail</h2>
        <form action="">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="body">
                        <table class="table card-table mb-0 float-left">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Full Name</td>
                                    <td class="text-right"><?= $schedule->cooperator_first_name ?? '' ?> <?= $schedule->cooperator_last_name ?? '' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Bank</td>
                                    <td class="text-right"><?= $schedule->bank_name ?? '' ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Account No.</td>
                                    <td class="text-right"><?= $schedule->account_no ?? '' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Amount</td>
                                    <td class="text-right">₦<?= number_format($schedule->amount ?? 0,2) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Payable Date</td>
                                    <td class="text-right"><?= date('d M, Y', strtotime($schedule->payable_date)) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Branch</td>
                                    <td class="text-right"><?= $schedule->branch ?? '' ?></span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="font-weight-bold">Guarantor 1</td>
                                    <td class="text-right"><?= $schedule->guarantor ?? '' ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="body">
                        <table class="table card-table mb-0 float-left">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Loan Type</td>
                                    <td class="text-right"><?= $schedule->loan_description ?? '' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date Applied</td>
                                    <td class="text-right"><?= !is_null($schedule->creation_date) ? date('d-m-Y', strtotime($schedule->creation_date)) : '-' ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Verified By</td>
                                    <td class="text-right"><?= $schedule->verified_by ?? '' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date Verified</td>
                                    <td class="text-right"><?= !is_null($schedule->verify_date) ? date('d-m-Y', strtotime($schedule->verify_date)) : '-' ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Approved By</td>
                                    <td class="text-right"><?= $schedule->approved_by ?? '' ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date Approved</td>
                                    <td class="text-right"><?= !is_null($schedule->approve_date) ? date('d-m-Y', strtotime($schedule->approve_date)) : '-' ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Guarantor 2</td>
                                    <td class="text-right"><?= $schedule->guarantor_2 ?? '' ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-12 text-center">
                    <div class="btn-group">
                        <a href="" class="btn btn-warning btn-sm text-white">Cancel</a>
                        <button class="btn btn-sm btn-danger action" data-action="decline" type="button" data-target="#payableLoanModal" data-toggle="modal">Decline</button>
                        <button class="btn btn-sm btn-primary action" data-action="approve" type="button" data-target="#payableLoanModal" data-toggle="modal">Approve</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="payableLoanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title action_name text-uppercase" ></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/loan/payable-action') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <p>This action cannot be undone. Are you sure you want to <strong class="action_name"></strong> this request?</p>
                    </div>
                    <div class="form-group">
                        <p></p>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <input type="hidden" name="hidden_action" id="hidden_action">
                        <input type="hidden" name="loan" value="<?= $schedule->loan_id?>">
                        <input type="hidden" name="staff_id" value="<?= $schedule->coop_id ?>">
                        <input type="hidden" name="amount" value="<?= $schedule->amount ?>">
                        <div class="btn-group">
                            <button type="button" class="btn btn-round btn-warning text-white btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-round btn-danger btn-sm" >No</button>
                            <button type="submit" class="btn btn-round btn-primary btn-sm" >Yes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.action', function(e){
            e.preventDefault();
            var action_name = $(this).data('action');
            $('.action_name').text(action_name);
            $('#hidden_action').val(action_name);
        });
    });
</script>    
<?= $this->endSection() ?>
