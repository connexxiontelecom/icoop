<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Freeze and Unfreeze Accounts
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Freeze and Unfreeze Accounts
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Freeze and Unfreeze Accounts
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link href="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Freeze and Unfreeze Account</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="simpletable table table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th style="font-weight: bolder">#</th>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Date Approved</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($cooperators as $cooperator): ?>
                            <tr>

                                <td><?=$sn; ?></td>
                                <td><?=$cooperator->cooperator_staff_id; ?></td>
                                    <td><?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?></td>
                                <td><?=$cooperator->department_name; ?></td>
                                <td><?=$cooperator->location_name; ?></td>
                                <td><?=$cooperator->cooperator_approved_date; ?></td>
                                <td>
									<?php if($cooperator->cooperator_status == 2): ?>
										<form method="post" id="form<?=$cooperator->cooperator_id; ?>" >
											<input type="hidden" name="cooperator_id" value="<?=$cooperator->cooperator_id; ?>">
											<input type="hidden" name="cooperator_status" value="0">
											<?= csrf_field() ?>
											<button type="button"  onclick="fre(this)" id="<?=$cooperator->cooperator_id; ?>" class="btn btn-icon icon-left btn-danger"><i class="fa fa-lock"></i> Freeze </button>
											
										</form>
										<?php endif; ?>
	
	                                <?php if($cooperator->cooperator_status == 0): ?>
		
										<form method="post" id="form<?=$cooperator->cooperator_id; ?>" >
											<input type="hidden" name="cooperator_id" value="<?=$cooperator->cooperator_id; ?>">
											<input type="hidden" name="cooperator_status" value="2">
			                                <?= csrf_field() ?>
											<button onclick="unfre(this)" id="<?=$cooperator->cooperator_id; ?>"   class="btn btn-icon icon-left btn-success"><i class="fa fa-unlock"></i> Unfreeze </button>
		
										</form>
								   <?php endif; ?>
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
<script src="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/third-party/sweet-alert2/sweet-alert.init.js"></script>

<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
      
    });

    function fre(e) {
   		 e.preventDefault;
		let form_id = e.id;
		form_id = 'form'+form_id;
        swal({
            title: "Are you sure?",
            text: "You are about to freeze an account",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, freeze!",
            cancelButtonText: "No, cancel!",

        }).then((willDelete) => {
            if (willDelete) {
                $("#"+form_id).submit();
            } else {
                swal('Action Canceled!', { icon: 'error' });
            }
        });
    }

    function unfre(e) {
        e.preventDefault;
        let form_id = e.id;
        form_id = 'form'+form_id;
        swal({
            title: "Are you sure?",
            text: "You are about to unfreeze an account",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Yes, unfreeze!",
            cancelButtonText: "No, cancel!",

        }).then((willDelete) => {
            if (willDelete) {
                $("#"+form_id).submit();
            } else {
                swal('Action Canceled!', { icon: 'error' });
            }
        });
    }
   
    
</script>
<?= $this->endSection() ?>
