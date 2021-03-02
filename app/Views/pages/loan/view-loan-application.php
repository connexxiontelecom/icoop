<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Application Details 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loan Application Details 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loan Application Details 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }
    </style>
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Loan Verification Process</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4">Coop Member Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap" width="150">Member ID</td>
                                        <td><strong><?= $application->cooperator_staff_id ?? '' ?></strong></td>
                                        <td class="text-nowrap">Full Name</td>
                                        <td><strong><?= $application->cooperator_first_name ?? '' ?> <?= $application->cooperator_last_name ?? '' ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Location</td>
                                        <td><strong><?= $application->location_name ?? '' ?></strong></td>
                                        <td class="text-nowrap">Payroll Group</td>
                                        <td><strong><?= $application->pg_name ?? '' ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Total Savings</td>
                                        <td><strong><?= $application->cooperator_email ?? '' ?></strong></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4">Loan Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap" width="150">Loan Type</td>
                                        <td><strong><?= $application->loan_description ?? '' ?></strong></td>
                                        <td class="text-nowrap">Loan Amount</td>
                                        <td><strong>₦<?= number_format( $application->amount ?? 0,2) ?> </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Loan Interest Rate</td>
                                        <td><strong><?= $application->ls_interest_rate.'%' ?? '' ?></strong></td>
                                        <td class="text-nowrap">Interest Amount</td>
                                        <td>
                                        <?php if($application->loan_type == 1)  : ?> <!-- Flat -->
                                                <p for=""><strong>₦<?= number_format(($application->amount*$setup['ls_interest_rate']/100),2 ) ?></strong></p>
                                            <?php elseif($application->loan_type == 2) : ?>
                                                <p for=""><strong>₦<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration/12 ) ?></strong></p>
                                            <?php else : ?>
                                                <p for=""><strong>₦<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration ) ?></strong></p>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Application Date</td>
                                        <td><strong><?= !is_null($application->applied_date) ? date('d-M-Y', strtotime($application->applied_date)) : '-'  ?></strong></td>
                                        <td class="text-nowrap">Payment Duration</td>
                                        <td><strong><?= $application->duration.' months' ??  '-'  ?></strong></td>
                                    </tr>
                                    <?php if(!empty($application->attachment)): ?>
                                        <tr>
                                            <td class="text-nowrap">Attachment</td>
                                            <td>
                                                <a href="<?= base_url().'/upload/withdraw/'.$application->attachment ?? '' ?>"></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($application->verify == 1) : ?>
                                    <tr>
                                        <td class="text-nowrap">Verified By</td>
                                        <td><strong><?= $application->verified_by ?? '' ?></strong></td>
                                        <td class="text-nowrap">Date Verified</td>
                                        <td><strong><?= !is_null($application->verify_date) ? date('d-M-Y', strtotime($application->verify_date)) : '' ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Verify Comment</td>
                                        <td colspan="3"><?= $application->verify_comment ?? '' ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($application->approve == 1) : ?>
                                    <tr>
                                        <td class="text-nowrap">Approved By</td>
                                        <td><strong><?= $application->approved_by ?? '' ?></strong></td>
                                        <td class="text-nowrap">Date Verified</td>
                                        <td><strong><?= !is_null($application->approve_date) ? date('d-M-Y', strtotime($application->approve_date)) : '' ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Approve Comment</td>
                                        <td colspan="3"><?= $application->approve_comment ?? '' ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4">Loan Guarantor Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      <td colspan="4"><strong>1<sup>st</sup> Guarantor</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap" width="150">Guarantor ID</td>
                                        <td><strong><?= $guarantor->cooperator_staff_id ?? '' ?></strong></td>
                                        <td class="text-nowrap">Guarantor Name</td>
                                        <td><strong><?= $guarantor->cooperator_first_name ?? '' ?> <?= $guarantor->cooperator_last_name ?? '' ?> </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Guarantor Email</td>
                                        <td><strong><?= $guarantor->cooperator_email ?? '' ?></strong></td>
                                        <td class="text-nowrap">Guarantor Phone</td>
                                        <td><strong><?= $guarantor->cooperator_telephone ?? '' ?></strong></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                      <td colspan="4"><strong>2<sup>nd</sup> Guarantor</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Guarantor ID</td>
                                        <td><strong><?= $guarantor2->cooperator_staff_id ?? '' ?></strong></td>
                                        <td class="text-nowrap">Guarantor Name</td>
                                        <td><strong><?= $guarantor2->cooperator_first_name ?? '' ?> <?= $guarantor2->cooperator_last_name ?? '' ?> </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Guarantor Email</td>
                                        <td><strong><?= $guarantor2->cooperator_email ?? '' ?></strong></td>
                                        <td class="text-nowrap">Guarantor Phone</td>
                                        <td><strong><?= $guarantor2->cooperator_telephone ?? '' ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" width="150"></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <form action="<?= $application->verify == 0 ? site_url('/loan/verify') : site_url('/loan/approve') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <tr>
                                        <td class="text-nowrap">Start Date</td>
                                        <td>
                                            <input type="date" placeholder="d-m-yyy" name="start_date" class="form-control col-md-6">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Payment Duration</td>
                                        <td>
                                            <input type="number" value="<?php $application->verify == 1 ? $application->duration : '' ?>" placeholder="Payment Duration (Ex. 3) in months" class="form-control col-md-6">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Comment</td>
                                        <td>
                                            <textarea name="comment" id="comment" placeholder="Comment" class="form-control col-md-6"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <div class="d-flex justify-content-center">
                                        <input type="hidden" name="application_id" value="<?= $application->loan_app_id ?>">
                                        <input type="hidden" name="loan_type" value="<?= $application->loan_type ?>">
                                        <input type="hidden"  name="principal_amount" value="<?=$application->amount ?>">
                                        <input type="hidden" name="interest_rate" value="<?= $setup['ls_interest_rate'] ?>">
                                        <?php if($application->loan_type == 1)  : ?> <!-- Flat -->
                                            <input type="hidden" value="<?= $application->amount*$setup['ls_interest_rate']/100?>" name="interest">
                                        <?php elseif($application->loan_type == 2) : ?>
                                            <input type="hidden" value="<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration/12 ) ?>" name="interest">
                                        <?php else : ?>
                                            <input type="hidden" name="interest" value="<?= number_format($application->amount * ($setup['ls_interest_rate']/100) * $application->duration ) ?>">
                                        <?php endif; ?>
                                            <div class="btn-group ">
                                                <button type="button" class="btn btn-round btn-danger btn-sm" data-dismiss="modal">Disqualify Application</button>
                                                <?php if($application->verify == 0) : ?>
                                                    <button type="submit" class="btn btn-round btn-primary btn-sm">Verify Application</button>
                                                <?php endif; ?>
                                                <?php if($application->verify == 1) : ?>
                                                    <button type="submit" class="btn btn-round btn-primary btn-sm">Approve Application</button>
                                                <?php endif; ?>
                                            </div>
                                        
                                        </div>
                                        </td>
                                    </tr>
                                </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verifyApplicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php if($application->verify == 1): ?>
                    <h5 class="modal-title" >Approve Loan Application</h5>
                <?php endif; ?>
                <?php if($application->verify == 0): ?>
                    <h5 class="modal-title" >Verify Loan Application</h5>
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $application->verify == 0 ? site_url('/loan/verify') : site_url('/loan/approve') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="hidden" name="application_id" value="<?= $application->loan_app_id ?>">
                        <input type="hidden" name="loan_type" value="<?= $application->loan_type ?>">
                        <label for="">Comment <small>(Optional)</small></label>
                        <textarea name="comment" id="comment" style="resize:none;" placeholder="Type here..." class="form-control"></textarea>
                        
                        <input type="hidden"  name="principal_amount" value="<?=$application->amount ?>">
                        <input type="hidden" name="interest_rate" value="<?= $setup['ls_interest_rate'] ?>">
                        <?php if($application->loan_type == 1)  : ?> <!-- Flat -->
                            <input type="hidden" value="<?= $application->amount*$setup['ls_interest_rate']/100?>" name="interest">
                        <?php elseif($application->loan_type == 2) : ?>
                            <input type="hidden" value="<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration/12 ) ?>" name="interest">
                        <?php else : ?>
                            <input type="hidden" name="interest" value="<?= number_format($application->amount * ($setup['ls_interest_rate']/100) * $application->duration ) ?>">
                        <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <p><strong>Principal Amount: </strong>₦<?=number_format( $application->amount) ?></p>
                        <p><strong>Interest Rate: </strong><?= $setup['ls_interest_rate'] ?>%</p>
                        <?php if($application->loan_type == 1)  : ?> <!-- Flat -->
                            <p for=""><strong>Interest Amount: </strong>₦<?= number_format(($application->amount*$setup['ls_interest_rate']/100),2 ) ?></p>
                        <?php elseif($application->loan_type == 2) : ?>
                            <p for=""><strong>Interest Amount: </strong>₦<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration/12 ) ?></p>
                        <?php else : ?>
                            <p for=""><strong>Interest Amount: </strong>₦<?= number_format($application->amount*($setup['ls_interest_rate']/100) * $application->duration ) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-round btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                            <?php if($application->verify == 0) : ?>
                                <button type="submit" class="btn btn-round btn-primary btn-sm">Verify Application</button>
                            <?php endif; ?>
                            <?php if($application->verify == 1) : ?>
                                <button type="submit" class="btn btn-round btn-primary btn-sm">Approve Application</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
