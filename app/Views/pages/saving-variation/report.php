<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Report 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Report 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Report
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
				<h2>Report </h2>
			</div>
			<div class="body">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">Saving Variation Report</h6>
                        <form action="<?= site_url('/saving-variations/report') ?>" method="post" class="form-inline">
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
                </div>
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th> Staff Name</th>
							<th> Amount </th>							
							<th> Contribution Type </th>							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
                        <?php $i=1; foreach($reports as $us) :?>
							<tr>
								
								<td><?=$i++; ?></td>
								<td><?= $us->cooperator_first_name ?? '' ?> <?= $us->cooperator_last_name ?? '' ?></td>
								<td><?= number_format($us->sv_amount,2) ?></td>				
                                <td><?= $us->contribution_type_name ?? '' ?></td>					
								<td>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifyModal<?=$us->saving_variation_id ?? '' ?>"><i class="fa fa-eye"></i></button>
								<div class="modal fade" id="verifyModal<?=$us->saving_variation_id ?? '' ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title h4" id="verifyModal<?=$us->saving_variation_id ?>">Saving Variation Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="#">
                                                <?= csrf_field() ?>
                                                    <div class="row clearfix">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Staff ID:</label>
                                                                <input class="form-control" value="<?= $us->sv_staff_id ?? '' ?>" name="pg_name" disabled readonly>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Staff Name:</label>
                                                                <input class="form-control" value="<?=$us->cooperator_first_name." ".$us->cooperator_last_name ?>" disabled readonly>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="row clearfix">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount:</label>
                                                                <input class="form-control" value="<?=number_format($us->sv_amount ?? 0); ?>" disabled readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Contribution Type:</label>
                                                                <input class="form-control" value="<?=$us->contribution_type_name ?? '' ?>" disabled readonly>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>                                                
                                                    <div class="row clearfix">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="header">
                                                                <p> <small><b>Verified By:</b> <?= $us->sv_verified_by ?? '' ?></small></p>
                                                                <p><small><b>Date Verified:</b> <?= !is_null($us->sv_date_verified) ? date('d-M, Y', strtotime($us->sv_date_verified)) : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="header">
                                                                <p> <small><b>Approved By:</b> <?= $us->sv_approved_by ?? '' ?></small></p>
                                                                <p><small><b>Date Approved:</b> <?= !is_null($us->sv_date_approved) ? date('d-M, Y', strtotime($us->sv_date_approved)) : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    
                                                    </div>                                               
                                                   
                                                    
                                                    <?= csrf_field() ?>
                                                    <div class="form-group">
                                                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								</td>
							</tr>
							<?php  endforeach; ?>
						
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
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
<?= $this->endSection() ?>
