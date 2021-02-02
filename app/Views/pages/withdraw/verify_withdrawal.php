<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Verify Withdrawals
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Verify Withdrawals
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Verify Withdrawals
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
                <h2>Verify Withdrawals</h2>

                   </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff ID</th>
                            <th> Staff Name</th>
                            <th> Contribution Type</th>
                            <th> Balance </th>
                            <th> Amount Requested</th>

                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($withdrawals as $withdrawal): ?>
                            <tr>

                                <td><?=$sn; ?></td>
                                <td><?=$withdrawal['withdraw_staff_id']; ?></td>
                                <td><?=$withdrawal['cooperator_first_name']." ".$withdrawal['cooperator_last_name']; ?></td>
                                <td><?=$withdrawal['contribution_type_name']; ?></td>
                                <td><?=number_format($withdrawal['balance']); ?></td>
                                <td><?=number_format($withdrawal['withdraw_amount']); ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifyModal<?=$withdrawal['withdraw_id'] ?>"><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$withdrawal['withdraw_id'] ?>"> <i class="fa fa-times"></i></button>

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


        <?php $sn = 1; foreach ($withdrawals as $withdrawal): ?>
            <div class="modal fade" id="verifyModal<?=$withdrawal['withdraw_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h4" id="myLargeModalLabel">Verify Withdrawal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label>Staff ID:</label>
                                                <input class="form-control" value="<?=$withdrawal['withdraw_staff_id']; ?>" name="pg_name" disabled readonly>
                                            </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Staff Name:</label>
                                    <input class="form-control" value="<?=$withdrawal['cooperator_first_name']." ".$withdrawal['cooperator_last_name']; ?>" disabled readonly>
                                </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>Contribution Type:</label>
                                    <input class="form-control" value="<?=$withdrawal['contribution_type_name']; ?>" disabled readonly>
                                </div>
                                    </div>


                                        <div class="col-lg-6 col-md-12">

                                <div class="form-group">
                                    <label>Balance:</label>
                                    <input class="form-control" value="<?=number_format($withdrawal['balance']); ?>" disabled readonly>
                                </div>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input class="form-control" value="<?=number_format($withdrawal['withdraw_amount']); ?>" disabled readonly>
                                </div>
                                <?php if(!empty($withdrawal['withdraw_doc'])): ?>

                                <div class="form-group">

                                    <button type="button" class="btn btn-primary mb-2" onclick="window.open('<?php echo base_url('.uploads/withdrawals')."/".$withdrawal['withdraw_doc'];?>', '_blank')" ><i class="fa fa-paperclip"></i> <span>View Attachment</span></button>

                                </div>

                                <?php endif; ?>

                                <input type="hidden" name="withdraw_status" value="1">

                                <input type="hidden" name="withdraw_id" value="<?=$withdrawal['withdraw_id']; ?>">

                                <div class="form-group">
                                    <label for="application_address">Comment:</label>
                                    <textarea name="withdraw_verify_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
                                </div>

                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">Verify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <?php $sn = 1; foreach ($withdrawals as $withdrawal): ?>
            <div class="modal fade" id="deleteModal<?=$withdrawal['withdraw_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h4" id="myLargeModalLabel">Disqualify Withdrawal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Staff ID:</label>
                                            <input class="form-control" value="<?=$withdrawal['withdraw_staff_id']; ?>" name="pg_name" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Staff Name:</label>
                                            <input class="form-control" value="<?=$withdrawal['cooperator_first_name']." ".$withdrawal['cooperator_last_name']; ?>" disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label>Contribution Type:</label>
                                            <input class="form-control" value="<?=$withdrawal['contribution_type_name']; ?>" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="header">
                                            <p> <small><b>Balance:</b> <?=number_format($withdrawal['balance']); ?></small></p>

                                        </div>
                                    </div>



                                </div>

                                <div class="form-group">
                                    <label>Amount:</label>
                                    <input class="form-control" value="<?=number_format($withdrawal['withdraw_amount']); ?>" disabled readonly>
                                </div>

                                <?php if(!empty($withdrawal['withdraw_doc'])): ?>

                                    <div class="form-group">

                                        <button type="button" class="btn btn-primary mb-2" onclick="window.open('<?php echo base_url('.uploads/withdrawals')."/".$withdrawal['withdraw_doc'];?>', '_blank')" ><i class="fa fa-paperclip"></i> <span>View Attachment</span></button>

                                    </div>

                                <?php endif; ?>

                                <input type="hidden" name="withdraw_status" value="3">

                                <input type="hidden" name="withdraw_id" value="<?=$withdrawal['withdraw_id']; ?>">

                                <div class="form-group">
                                    <label for="application_address">Comment:</label>
                                    <textarea name="withdraw_discarded_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
                                </div>

                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">Discard</button>
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


