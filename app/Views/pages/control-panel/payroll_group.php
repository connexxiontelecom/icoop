<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payroll Groups
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payroll Groups
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payroll Groups
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
                <h2>Payroll Group</h2>

                <button style="float: right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal"> <i class="fa fa-plus"></i> New Payroll Group</button>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Payroll Group Name</th>
                            <th> Payroll GL Code</th>

                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($pgs as $pg): ?>
                            <tr>

                                <td><?=$sn; ?></td>
                                <td><?=$pg['pg_name']; ?></td>
                                <td><?=$pg['pg_gl_code']; ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?=$pg['pg_id'] ?>"><i class="fa fa-pencil-square-o"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$pg['pg_id'] ?>"> <i class="fa fa-trash-o"></i></button>

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
                        <h5 class="modal-title h4" id="myLargeModalLabel">New Payroll Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Payroll Group:</label>
                                <input class="form-control" name="pg_name" required>
                            </div>

                            <div class="form-group">
                                <label>GL Code:</label>
								<select class="custom-selec" required name="pg_gl_code">
									<option selected disabled> -- select gl code -- </option>
		
		                            <?php foreach ($coas as $coa): ?>
										<option value="<?=$coa['glcode'] ?>"> <?=$coa['glcode']." (".$coa['account_name'].")"; ?></option>
		                            <?php endforeach; ?>
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


        <?php $sn = 1; foreach ($pgs as $pg): ?>
            <div class="modal fade bd-example-modal-sm" id="editModal<?=$pg['pg_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h4" id="myLargeModalLabel">Update Payroll Group</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label>Payroll Group:</label>
                                    <input class="form-control" value="<?=$pg['pg_name']; ?>" name="pg_name" required>
                                </div>

                                <div class="form-group">
                                    <label>GL Code:</label>
									<select class="custom-select" required name="pg_gl_code">
		
		                                <?php foreach ($coas as $coa): ?>
											<option value="<?=$coa['glcode'] ?>" <?php if($pg['pg_gl_code'] == $coa['glcode']){ echo "selected"; } ?>> <?=$coa['glcode']." (".$coa['account_name'].")"; ?></option>
		                                <?php endforeach; ?>
									</select>
                                </div>

                                <input type="hidden" name="type" value="2">

                                <input type="hidden" name="pg_id" value="<?=$pg['pg_id']; ?>">

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


        <?php $sn = 1; foreach ($pgs as $pg): ?>
            <div class="modal fade bd-example-modal-sm" id="deleteModal<?=$pg['pg_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                    <label>Payroll Group:</label>
                                    <input class="form-control" value="<?=$pg['pg_name']; ?>" name="pg_name" readonly>
                                </div>

                                <div class="form-group">
                                    <label>GL Code:</label>
                                    <input class="form-control" value="<?=$pg['pg_gl_code']; ?>" name="pg_gl_code" required>
                                </div>

                                <input type="hidden" name="type" value="3">

                                <input type="hidden" name="pg_id" value="<?=$pg['pg_id']; ?>">

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

