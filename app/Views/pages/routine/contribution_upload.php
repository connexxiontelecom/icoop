<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Contribution Upload
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Contribution Upload
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Contribution Upload
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
                <h2>Contribution Upload</h2>
            </div>

            <div class="body">
                <form method="POST" enctype="multipart/form-data">

                    <fieldset>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Payroll Group: </b></label>

                                    <select class="custom-select" required name="contribution_upload_pg" >
										<option value='' disabled selected> --Select -- </option>
                                        <?php foreach ($pgs as $pg): ?>
                                            <option value="<?=$pg['pg_id'] ?>"> <?=$pg['pg_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>

                                    <select class="custom-select" required name="contribution_upload_ct">
										<option value='' disabled selected> --Select -- </option>
                                        <?php foreach ($cts as $ct): ?>
                                            <option value="<?=$ct['contribution_type_id'] ?>"> <?=$ct['contribution_type_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="application_first_name"><b>Date:</b></label>
                                    <input type="date"  class="form-control" placeholder="Date" name="contribution_upload_date" required>
                                </div>


                                <div class="form-group">
                                    <label for="application_address"><b>Narration:</b></label>
                                    <textarea name="contribution_upload_narration" id="application_address"  cols="30" rows="3" placeholder="Narration *" class="form-control no-resize" required></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="application_first_name"><b>File:</b></label>
                                    <input type="file"  class="form-control"  name="select_excel" required>
                                </div>

                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>
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


