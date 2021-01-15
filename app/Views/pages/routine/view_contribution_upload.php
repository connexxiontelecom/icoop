<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Contribution Uploads
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Contribution Uploads
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Contribution Uploads
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
                <h2>View Contribution Uploads</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff ID</th>
                            <th> Amount</th>
                            <th> Narration </th>
                            <th> Ref Code</th>
                            <th> Date </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($temp_pds as $temp_pd): ?>
                            <?php
                            $color = 'white';
                            if($temp_pd['temp_pd_status'] == 1){ $color = 'red'; }
                            if($temp_pd['temp_pd_status'] == 2){ $color = 'amber'; }
                            ?>
                            <tr style="background-color: <?php echo $color; ?>">

                                <td><?=$sn; ?></td>
                                <td><?=$temp_pd['temp_pd_staff_id']; ?></td>
                                <td><?=$temp_pd['temp_pd_amount']; ?></td>
                                <td><?=$temp_pd['temp_pd_narration']; ?></td>
                                <td><?=$temp_pd['temp_pd_ref_code']; ?></td>
                                <td><?=$temp_pd['temp_pd_transaction_date']; ?></td>


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
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
<?= $this->endSection() ?>

