<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Report 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loan Report 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loan Report
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
				<h2>Loan Report </h2>
			</div>
			<div class="body">
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">Loan Report</h6>
                        <form action="<?= site_url('/loan/report') ?>" method="post" class="form-inline">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" class="form-control ml-2 mr-2" placeholder="dd/mm/yyyy" name="from">
                                
                            </div>
                            <div class="form-group">
                                <label for=""> To</label>
                                <input type="date" class="form-control ml-2" placeholder="dd/mm/yyyy" name="to">
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">Generate Report</button>
                            </div>
                        </form>
                    </div>
                     <div class="col-lg-12 col-md-12 col-xl-12 mt-5">
                        <p>
                            Loan application report from <label for="" class="badge badge-info"><?= date('d-m-y', strtotime($from)) ?></label> to <label for="" class="badge badge-danger"><?= date('d-m-y', strtotime($to)) ?></label>
                        </p>
                    </div>
                </div>
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
                                    <td class="text-right"><?= number_format($app->amount ?? 0) ?></td>
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
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
<?= $this->endSection() ?>
