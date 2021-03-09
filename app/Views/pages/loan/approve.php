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



<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">

<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="<?=site_url() ?>assets/css/toastify.min.css"/>

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
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
                        
                        <tr>
                            <th>#</th>
                            <th>Coop ID</th>
                            <th>Name</th>
                            <th>Loan Type</th>
                            <th>Amount</th>
                            <th>Duration</th>
                            <th>Application Date</th>
                            <th>Action</th>
                        </tr>
						</thead>

                        <tbody>
                        
                            <?php $i = 1; foreach($applications as $app) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $app->staff_id ?? '' ?></td>
                                    <td><?= $app->cooperator_first_name ?? '' ?> <?= $app->cooperator_last_name ?? '' ?></td>
                                    <td><?= $app->loan_description ?? '' ?> </td>
                                    <td><?= number_format($app->amount ?? 0) ?></td>
                                    <td><?= number_format($app->duration ?? 0) ?> months</td>
                                    <td><?= date('d M, Y', strtotime($app->applied_date)) ?> </td>
                                    <td>
                                        <a href="<?= site_url('/view-loan-application/'.$app->loan_app_id) ?>" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script>
    $('.simpletable').DataTable();
	
</script>
<script src="<?=site_url() ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?=site_url() ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="<?=site_url() ?>assets/js/common.js"></script>
<script src="<?=site_url() ?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?=site_url() ?>assets/js/axios.min.js"></script>
<script src="<?=site_url() ?>assets/js/toastify.min.js"></script>
<?= $this->endSection() ?>
