<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Saving Variations 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Saving Variations 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Saving Variations 
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
				<h2>Approve Saving Variations </h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th> Staff Name</th>
							<th> Amount </th>							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
                        
						<?php $i=1; foreach($verified_savings as $us) :?>
							<tr>
								
								<td><?=$i++; ?></td>
								<td><?= $us->cooperator_first_name ?? '' ?> <?= $us->cooperator_last_name ?? '' ?></td>
								<td><?= number_format($us->sv_amount,2) ?></td>								
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifyModal<?=$us->saving_variation_id ?? '' ?>"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$us->saving_variation_id ?? '' ?>"> <i class="fa fa-times"></i></button>
								<div class="modal fade" id="verifyModal<?=$us->saving_variation_id ?? '' ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title h4" id="verifyModal<?=$us->saving_variation_id ?>">Approve Saving Variation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="<?= site_url('/approve-saving-variation') ?>">
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
                                                                <p><small><b>Date Verified:</b> <?=$us->sv_verified ?? '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    
                                                    </div>
                                                    <input type="hidden" name="saving_variation" value="<?=$us->saving_variation_id ?? '' ?>">
                                                    <input type="hidden" name="staff" value="<?= $us->sv_staff_id ?? '' ?>">
                                                    <input type="hidden" name="sv_amount" value="<?= $us->sv_amount ?? 0 ?>">
                                                    
                                                   
                                                    
                                                    <?= csrf_field() ?>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-block">Approve</button>
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
