<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Contribution Type
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Contribution Type
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Contribution Type
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
                <h2>Contribution Type</h2>

                <button style="float: right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal"> <i class="fa fa-plus"></i> New Contribution Type</button>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Contribution Type</th>
							<th>Regular</th>
                            
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($contribution_types as $contribution_type): ?>
                            <tr>

                                <td><?=$sn; ?></td>
                                <td><?=$contribution_type['contribution_type_name']; ?></td>
								<td><?php if($contribution_type['contribution_type_regular'] == 1): echo "yes"; else: echo "No"; endif; ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?=$contribution_type['contribution_type_id'] ?>"><i class="fa fa-pencil-square-o"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$contribution_type['contribution_type_id'] ?>"> <i class="fa fa-trash-o"></i></button>

                                     </td>
                            </tr>
                            <?php $sn++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-3">
        <div class="modal fade bd-example-modal-sm" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">New Contribution Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Contribution type:</label>
                                <input class="form-control" name="contribution_type_name" required>
                            </div>
							
							<div class="form-group">
								
								<label>Regular?</label>
								<select class="custom-select" required name="contribution_upload_pg" >
									
									<option value="0"> No </option>
										<option value="1"> Yes </option>
									
								</select>
							</div>

                            <input type="hidden" name="type" value="1">

                            <?= csrf_field() ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php $sn = 1; foreach ($contribution_types as $contribution_type): ?>
        <div class="modal fade bd-example-modal-sm" id="editModal<?=$contribution_type['contribution_type_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h4" id="myLargeModalLabel">Update Contribution Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Contribution type:</label>
                                <input class="form-control" value="<?=$contribution_type['contribution_type_name']; ?>" name="contribution_type_name" required>
                            </div>

                            <input type="hidden" name="type" value="2">

                            <input type="hidden" name="contribution_type_id" value="<?=$contribution_type['contribution_type_id']; ?>">
	
							<div class="form-group">
		
								<label>Regular?</label>
								<select class="custom-select" required name="contribution_upload_pg" >
			
									<option value="0" <?php if($contribution_type['contribution_type_regular'] !== 1): echo "selected"; endif; ?>> No </option>
									<option value="1"  <?php if($contribution_type['contribution_type_regular'] == 1): echo "selected"; endif; ?>> Yes </option>
		
								</select>
							</div>
	
							<?= csrf_field() ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>


        <?php $sn = 1; foreach ($contribution_types as $contribution_type): ?>
            <div class="modal fade bd-example-modal-sm" id="deleteModal<?=$contribution_type['contribution_type_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h4" id="myLargeModalLabel">This Action Cannot be reversed</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Contribution type:</label>
                                    <input class="form-control" value="<?=$contribution_type['contribution_type_name']; ?>" name="contribution_type_name" readonly>
                                </div>

                                <input type="hidden" name="type" value="3">

                                <input type="hidden" name="contribution_type_id" value="<?=$contribution_type['contribution_type_id']; ?>">

                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>





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

