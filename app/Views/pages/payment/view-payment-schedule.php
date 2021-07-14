<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payment Schedule
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payment Schedule
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payment Schedule 
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
                <h2>Payment Schedule</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap" width="150">Bank</td>
                                        <td><strong><?= $master->bank_name ?? '' ?> </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Account No.</td>
                                        <td><strong>  <?= $master->account_no ?? '' ?></strong></td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Payment Date</td>
                                        <td><strong><?= date('d-m-Y', strtotime($master->payable_date)) ?? '' ?></strong></td>
                                    </tr>                                    
                                    <tr>
                                        <td class="text-nowrap">Amount</td>
                                        <td><strong><?= number_format($master->amount,2) ?? '' ?></strong></td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="header">
                            <h2>Schedule Detail</h2>
                        </div>
<!--                        <form action="--><?//= site_url('/loan/return-bulk-schedule') ?><!--" method="post" autocomplete="off">-->
	                        <?= csrf_field() ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>S/No</td>
                                            <td>Name</td>
                                            <td>Payment Type</td>
                                            <td>Bank Name</td>
                                            <td>Account No.</td>
                                            <td>Amount</td>
                                            <td>Action</td>
                                        </tr>
										
										
										
										
                                        <?php $serial = 1; $sum = 0; if(!empty($withdraw_details)): foreach($withdraw_details as $withdraw) : ?>
                                            <tr>
                                                <td><?= $serial++ ?></td>
                                                <td><?= $withdraw['cooperator_first_name'] ?? '' ?> <?= $withdraw['cooperator_last_name'] ?? '' ?></td>
                                            
                                                <td>
                                                    <?='Savings withdrawal from '.$withdraw['contribution_type_name'].' '.$withdraw['withdraw_narration'] ?>
                                                </td>
                                                <td><?= $withdraw['bank_name'] ?? '' ?> </td>
                                                <td><?= $withdraw['cooperator_account_number'] ?? '' ?> </td>
                                                <td class="text-right"><?= number_format($withdraw['withdraw_amount'],2) ?? '' ?> </td>
                                               
                                                <td>
													<form method="post" action="<?=site_url('/loan/return-schedule-payment') ?>">
														<?= csrf_field() ?>
														<input type="hidden" name="detail_id" value="<?=$withdraw['detail_id']; ?>">
														<input type="hidden" name="master_id" value="<?=$withdraw['master_id']; ?>">
														<button class="btn btn-danger btn-sm" type="submit" >Return Schedule</button>
													</form>
													
												
												</td>
                                            </tr>
                                        <?php $sum = $sum + $withdraw['withdraw_amount'];  endforeach; endif;?>


                                        <?php  if(!empty($loan_details)): foreach($loan_details as $loan) : ?>
											<tr>
												<td><?= $serial++ ?></td>
												<td><?= $loan['cooperator_first_name'] ?? '' ?> <?= $loan['cooperator_last_name'] ?? '' ?></td>
												<td>
			                                        <?=$loan['loan_description'].' disbursement' ?>
												</td>
												<td><?= $loan['bank_name'] ?? '' ?> </td>
												<td><?= $loan['cooperator_account_number'] ?? '' ?> </td>
												<td class="text-right"><?= number_format($loan['amount'],2) ?? '' ?> </td>
												
												<td>
													<form method="post" action="<?=site_url('/loan/return-schedule-payment') ?>">
														<?= csrf_field() ?>
														<input type="hidden" name="detail_id" value="<?=$loan['detail_id']; ?>">
														<input type="hidden" name="master_id" value="<?=$loan['master_id']; ?>">
														<button class="btn btn-danger btn-sm" type="submit" >Return Schedule</button>
													</form>
												
												
												</td>
											</tr>
	                                        <?php $sum = $sum + $loan['amount'];  endforeach; endif;?>
                                      
                                      
                                      
                                        <tr>
                                            <td colspan="6" class="text-right">
                                                <strong>Total:</strong>
                                            </td>
                                            <td><?= '₦'.number_format($sum,2) ?></td>
                                        </tr>
                                     
                                        
											
											<tr>
                                            <td colspan="7">
                                                <?php if($master->verified == 0) : ?>
                                                    <div class="btn-group">
														<button class="btn btn-danger btn-sm" data-target="#returnScheduleModal" data-toggle="modal" type="button">Return  Schedule</button>
                                                        <button class="btn btn-primary btn-sm text-right" data-target="#verifyScheduleModal" data-toggle="modal" type="button">Verify Schedule</button>
                                                    </div>

                                                <?php else : ?>
                                                    <div class="btn-group">
													
	
														<button class="btn btn-danger btn-sm" data-target="#returnScheduleModal" data-toggle="modal" type="button">Return  Schedule</button>
                                                        <button class="btn btn-primary btn-sm text-right" data-target="#approveScheduleModal" data-toggle="modal" type="button">Approve Schedule</button>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                   
                                    </tbody>
                                </table>

                            </div>
<!--                        </form>-->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="verifyScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Verify Payment Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to verify this payment schedule?</p>
               <form action="<?= site_url('/loan/verify-schedule') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="">Comment <i>(Optional)</i></label>
                        <textarea name="comment" id="comment" style="resize:none;" placeholder="Leave comment here..." class="form-control"></textarea>
                    </div>
                    <div class="form-group text-right">
                      <div class="btn-group">
                      <input type="hidden" name="schedule" value="<?= $master->schedule_master_id ?>">
                        <button class="btn-sm btn btn-danger" data-dismiss="modal">No, cancel.</button>
                       <button class="btn-sm btn btn-primary" type="submit">Yes, verify.</button>
                      </div>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="approveScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Approve Payment Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <p>Are you sure you want to approve this payment schedule?</p>
               <form action="<?= site_url('/loan/approve-schedule') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="">Comment <i>(Optional)</i></label>
                        <textarea name="comment" id="comment" style="resize:none;" placeholder="Leave comment here..." class="form-control"></textarea>
                    </div>
                    <div class="form-group text-right">
                      <div class="btn-group">
                      <input type="hidden" name="schedule" value="<?= $master->schedule_master_id ?>">
                        <button class="btn-sm btn btn-danger" data-dismiss="modal">No, cancel.</button>
                       <button class="btn-sm btn btn-primary" type="submit">Yes, approve.</button>
                      </div>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="returnScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h4" id="myLargeModalLabel">Return Schedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to return entire schedule</p>
				<form method="post" action="<?=site_url('/loan/return-bulk-schedule') ?>">
					<?= csrf_field() ?>
					
					<div class="form-group text-right">
						<div class="btn-group">
							<input type="hidden" name="master_id" value="<?=$master->schedule_master_id; ?>">
							<button class="btn-sm btn btn-danger" data-dismiss="modal">No, cancel.</button>
							<button class="btn-sm btn btn-primary" type="submit">Yes, Return.</button>
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
