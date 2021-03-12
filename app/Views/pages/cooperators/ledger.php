<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Contribution Types - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Contribution Types - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Contribution Types - <small> <?=$cooperator->cooperator_staff_id; ?> </small>
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
                <h2>Contribution Types - View Ledger</h2>

            </div>


            <div class="body">
<?php if(!empty($contribution_types)): ?>

                <form method="POST" enctype="multipart/form-data">

                    <fieldset>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">


                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>

                                    <select class="custom-select" required name="ct_id">

                                        <?php foreach ($contribution_types as $ct): ?>
                                            <option value="<?=$ct['contribution_type_id'] ?>"> <?=$ct['contribution_type_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b>Year: </b></label>

                                    <select class="custom-select" required name="ct_year">
                                        <option value="a"> All </option>
                                        <?php foreach ($years as $year): ?>
                                            <option value="<?=$year['year'] ?>"> <?=$year['year']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">Retrieve</button>
                                </div>
                            </div>


                        </div>
                    </fieldset>


                </form>
<?php else: ?>
				
				<p> No Savings for Cooperator</p>
				
				<?php endif; ?>

			</div>

        

            
        </div>
	
	    <?php if(!empty($check)): ?>
			<div class="col-lg-12">
			<div class="card">
				
				
					<div class="header">
						<h2>Account Statement for (<?=$ct_dt['contribution_type_name']; ?>) - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?></h2>
						<ul class="header-dropdown dropdown">
						
							<li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
					
						</ul>
						
						<ul class="list-unstyled">
							<li class="m-b-15">
								<div><kbd>Period:</kbd> <small><?=$y; ?></small></div>
							
							</li>
						
						
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
						    <?php  if(!empty($ledgers)): ?>
								<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
									<thead>
									<tr>
										<th><strong># </strong></th>
										<th><strong>Date</strong></th>
										<th style="text-align: left"><strong>Narration</strong></th>
										<th style="text-align: right"><strong>Dr</strong></th>
										<th style="text-align: right"><strong>Cr</strong></th>
										<th style="text-align: right"><strong>Balance</strong></th>
								
								
								
									</tr>
									</thead>
								
									<tbody>
								    <?php if($bf > 0): ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td style="text-align: right"> <strong>BF:</strong> <?=number_format($bf); ?></td>
										</tr>
								
								    <?php endif; ?>
								    <?php $sn = 1;
									    $total_cr = 0;
									    $total_dr = 0;
									    foreach ($ledgers as $ledger): ?>
											<tr>
											
												<td><?=$sn; ?></td>
												<td><?=$ledger['pd_transaction_date']; ?></td>
												<td><?=$ledger['pd_narration']; ?></td>
											
												<td style="text-align: right"><?php
													    if($ledger['pd_drcrtype'] == 2):
														    $dr = $ledger['pd_amount'];
														    $cr = 0;
														    $total_dr = $dr + $total_dr;
														
														    echo number_format($ledger['pd_amount'] , 2);
													
													    else:
														    echo number_format(0, 2);
													
													    endif;
												
												    ?></td>
												<td style="text-align: right">
												    <?php
													    if($ledger['pd_drcrtype'] == 1):
														
														    $cr = $ledger['pd_amount'];
														    $dr = 0;
														    $total_cr = $cr + $total_cr;
														
														    echo number_format($ledger['pd_amount']);
													
													    else:
														    echo number_format(0, 2);
													
													    endif;
												
												    ?>
												</td>
											
												<td style="text-align: right">
												    <?php $bf = ($bf + $cr) - $dr;
													    echo number_format($bf, 2);
												    ?>
											
												</td>
										
										
											</tr>
										    <?php $sn++; endforeach; ?>
								
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td style="text-align: right"><strong>Total:</strong> <?=number_format( $total_dr, 2); ?></td>
										<td style="text-align: right"><strong>Total:</strong> <?=number_format($total_cr, 2 ); ?></td>
										<td style="text-align: right"> <strong>Balance:</strong> <?=number_format($total_cr - $total_dr, 2); ?></td>
									</tr>
									</tbody>
								</table>
						    <?php  else:
							
							    echo "No data Available";
						    endif; ?>
						</div>
					</div>
			
				</div>
			</div>
	    <?php endif; ?>
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

<?= $this->endSection() ?>
