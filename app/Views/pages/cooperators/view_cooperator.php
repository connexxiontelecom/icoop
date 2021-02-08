<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Cooperator
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Cooperator
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Cooperator
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>View Cooperator</h2>

            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="profile-header d-flex justify-content-between justify-content-center">
                        <div class="d-flex">
                            <div class="mr-3">
                                <img src="../assets/images/user.png" class="rounded" alt="">
                            </div>
                            <div class="details">
                                <h4 class="mb-0"><?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?></h4> <br>
                                <span class="text-light"></span>
                                <p class="mb-0"><span>Department: <strong><?=$cooperator->department_name; ?></strong></span></p> <br>
                                <p class="mb-0"><span>Email: <strong><?=$cooperator->cooperator_email; ?></strong></span></p> <br>
                                <p class="mb-0"><span>Telephone: <strong><?=$cooperator->cooperator_telephone; ?></strong></span></p> <br>



                            </div>
                        </div>

                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card w_card3">
                                <div class="body">
                                    <div class="text-center"><i class="fa fa-book"></i>
                                        <h5 class="m-t-20 mb-0">Contribution Ledger</h5>
                                        <p class="text-muted"></p>
                                        <a href="<?=base_url('ledger')."/".$cooperator->cooperator_staff_id; ?>" class="btn btn-info btn-round">View Ledger</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card w_card3">
                                <div class="body">
                                    <div class="text-center"><i class="fa fa-book"></i>
                                        <h5 class="m-t-20 mb-0">Outstanding Loans</h5>
                                        <p class="text-muted"></p>
                                        <a href="<?=base_url('loan_ledger')."/".$cooperator->cooperator_staff_id; ?>" class="btn btn-info btn-round">View Ledger</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card w_card3">
                                <div class="body">
                                    <div class="text-center"><i class="fa fa-book"></i>
                                        <h5 class="m-t-20 mb-0">Finished Loans</h5>
                                        <p class="text-muted"></p>
                                        <a href="<?=base_url('ledger')."/".$cooperator->cooperator_staff_id; ?>" class="btn btn-info btn-round">View Ledger</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<?= $this->endSection() ?>
