<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Loan Application 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Loan Application 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Loan Application 
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


<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Approve Loan Application</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable js-exportable simpletable" id="stateTable">
                        
                        <tr>
                            <th>#</th>
                            <th>Coop ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Duration</th>
                            <th>Loan Type</th>
                            <th>Action</th>
                        </tr>

                        <tbody>
                            <?php $i = 1; foreach($applications as $app) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $app['staff_id'] ?></td>
                                    <td><?= $app['name'] ?></td>
                                    <td class="text-right"><?= number_format($app['amount']) ?></td>
                                    <td><?= number_format($app['duration']) ?> months</td>
                                    <td><?= $app['loan_type'] ?> </td>
                                    <td>
                                        <a href="<?= site_url('/view-loan-application/'.$app['loan_app_id']) ?>" class="btn btn-primary btn-sm">View</a>
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
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<?= $this->endSection() ?>
