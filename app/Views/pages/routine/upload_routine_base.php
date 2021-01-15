<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Upload Routine
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Upload Routine
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Upload Routine
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
                <h2>Upload Routine</h2>
            </div>


            <div class="body">

                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card w_card3">
                            <div class="body">
                                <div class="text-center"><i class="fa fa-youtube-square"></i>
                                    <h5 class="m-t-20 mb-0">Contribution Upload</h5>
                                    <a href="<?php echo base_url('contribution_upload'); ?>" class="btn btn-success btn-round">Go >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card w_card3">
                            <div class="body">
                                <div class="text-center"><i class="fa fa-twitter"></i>
                                    <h5 class="m-t-20 mb-0">3,756</h5>
                                    <p class="text-muted">New Followers</p>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-round">Find more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">

                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card w_card3">
                            <div class="body">
                                <div class="text-center"><i class="fa fa-youtube-square"></i>
                                    <h5 class="m-t-20 mb-0">813 Point</h5>
                                    <p class="text-muted">New Subscribe</p>
                                    <a href="javascript:void(0);" class="btn btn-success btn-round">Find more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card w_card3">
                            <div class="body">
                                <div class="text-center"><i class="fa fa-twitter"></i>
                                    <h5 class="m-t-20 mb-0">3,756</h5>
                                    <p class="text-muted">New Followers</p>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-round">Find more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">

                    </div>
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

