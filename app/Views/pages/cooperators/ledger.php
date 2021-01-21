<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Contribution Types - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Contribution Types - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Contribution Types
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
                <h2>Contribution Types - View Ledger</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Contribution Type</th>

                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($contribution_types as $contribution_type): ?>
                            <tr>

                                <td><?=$sn; ?></td>
                                <td><?=$contribution_type['contribution_type_name']; ?></td>

                                <td> <button onclick="location.href='<?php echo site_url('view_ledger')."/".$contribution_type['contribution_type_id']."/".$cooperator->cooperator_staff_id;?>'" type="button" class="btn btn-icon icon-left btn-primary"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                            <?php $sn++; endforeach; ?>
                        </tbody>
                    </table>
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
