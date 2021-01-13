<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Application Details 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loan Application Details 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loan Application Details 
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

<div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom mb-5">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Staff Name</strong>
                                                    </td>                                                    
                                                    <td><?= $application['name'] ?></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Duration</strong>
                                                    </td>                                                    
                                                    <td><?= $application['duration'] ?> <i>month(s)</i></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Amount</strong>
                                                    </td>                                                    
                                                    <td><?= number_format($application['amount'],2) ?></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Loan Type</strong>
                                                    </td>                                                    
                                                    <td><?= $application['loan_type'] ?></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Guarantor 1</strong>
                                                    </td>                                                    
                                                    <td><?= $application['guarantor'] ?></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Guarantor 2</strong>
                                                    </td>                                                    
                                                    <td><?= $application['guarantor_2'] ?></td>
                                                </tr>                                               
                                                <tr>
                                                    <td>
                                                        <strong>Loan Terms</strong>
                                                    </td>                                                    
                                                    <td><?= $application['loan_terms'] ?></td>
                                                </tr>                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <p><strong>Verify Comment: </strong><?= $application['verify_comment'] ?></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn-sm">Cancel</button>
                                        <?php if($application['verify'] == 0) : ?>
                                            <button class="btn btn-primary btn-sm" data-target="#verifyApplicationModal" data-toggle="modal">Verify</button>
                                        <?php endif; ?>
                                        <?php if($application['verify'] == 1) : ?>
                                            <button class="btn btn-primary btn-sm" data-target="#verifyApplicationModal" data-toggle="modal">Approve</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>                                       
                </div>
            </div>


<div class="modal fade" id="verifyApplicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if($application['verify'] == 1): ?>
                    <h5 class="modal-title" >Approve Loan Application</h5>
                <?php endif; ?>
                <?php if($application['verify'] == 0): ?>
                    <h5 class="modal-title" >Verify Loan Application</h5>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('/loan/verify') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="hidden" name="application_id" value="<?= $application['loan_app_id'] ?>">
                        <label for="">Comment <small>(Optional)</small></label>
                        <textarea name="comment" id="comment" style="resize:none;" placeholder="Type here..." class="form-control"></textarea>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-round btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                            <?php if($application['verify'] == 0) : ?>
                                <button type="submit" class="btn btn-round btn-primary btn-sm">Verify Application</button>
                            <?php endif; ?>
                            <?php if($application['verify'] == 1) : ?>
                                <button type="submit" class="btn btn-round btn-primary btn-sm">Approve Application</button>
                            <?php endif; ?>
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
    
<?= $this->endSection() ?>
