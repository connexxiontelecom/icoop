<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Account Closure
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Account Closure
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Account Closure
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>

<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>New Account Closure</h2>
			</div>
			
			<div class="body">
				<form method="POST" enctype="multipart/form-data">
					
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								<div class="form-group">
									
									<label> <b> Staff ID or Name: </b></label>
									<input type="text" class="form-control"  id="search_account"  required  name="ac_staff_id" placeholder="Enter staff ID or  name">
								
								
								
								</div>
								
								<div class="form-group">
									
									<label> <b> Effective Date: </b></label>
									<input type="date" class="number form-control"  required  name="ac_effective_date"  placeholder="Enter Date">
				
								</div>
								
								<div class="form-group">
									
									<label> <b> E-Mail: </b></label>
									
									<input type="email" class="form-control mobile-phone-number" name="ac_email">
								
								</div>
								
								<div class="form-group">
									
									<label> <b> Phone: </b></label>
		
									<input type="text" class="form-control mobile-phone-number" name="ac_phone" required>
									
								</div>
								
								
						
								
								<div class="form-group">
									
									<label> <b> Permanent Mailing Address: </b></label>
									<textarea name="ac_mailing"  cols="30" rows="3" placeholder="Address *" style="resize: none" class="form-control no-resize" required></textarea>
								
								</div>
								
								
								
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" id="withdraw_submit" class="btn btn-info btn-block">Submit</button>
									
								
								</div>
							
							</div>
						
						
						</div>
					</fieldset>
				
				
				</form>
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
<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script><!-- Bootstrap Colorpicker Js -->
<!-- Input Mask Plugin Js -->

<!--<script src="assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script>-->
<!--<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.min.js"></script>-->

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>

<script>

    $(document).ready(function() {
         $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });
  
        });
    });



</script>
<?= $this->endSection() ?>


