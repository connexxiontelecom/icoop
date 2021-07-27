<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
GL Extract
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
GL Extract
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
GL Extract
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
	
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>GL Extract</h2>
			</div>
			<div class="body">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form action="<?= site_url('/glextract') ?>" method="post">
							<?= csrf_field() ?>
							<fieldset>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										
										
										
										
										<div class="form-group">
											
											
											<label>Range</label>
											<div class="input-daterange input-group">
												<input type="date" class="input-sm form-control" name="from">
												<span class="input-group-addon range-to">to</span>
												<input type="date" class="input-sm form-control" name="to">
											</div>
										
										</div>
										
										<div class="form-group">
											
											
											<label  for="application_payroll_group_id"> <b> Account: </b></label>
											<select name="debit_account[]" id="debit_account1" class="custom-select" required>
												<option disabled selected>Select account</option>
												<?php foreach($accounts as $account) :
													$account_type = '';
													if($account['account_type'] == 1):
														$account_type = 'Assets';
													endif;
													
													if($account['account_type'] == 2):
														$account_type = 'Liability';
													endif;
													
													if($account['account_type'] == 3):
														$account_type = 'Equity';
													endif;
													
													if($account['account_type'] == 4):
														$account_type = 'Revenues';
													endif;
													
													if($account['account_type'] == 5):
														$account_type = 'Expenses';
													endif;
													?>
													<option value="<?= $account['glcode'] ?>"> <?= $account['glcode'] ?? ''?> - <?= $account['account_name'] ?? ''?> (<?=$account_type ?>) </option>
												<?php endforeach; ?>
											</select>
										
										</div>
										
										<?= csrf_field() ?>
										<div class="form-group">
											<button type="submit" class="btn btn-info">Retrieve</button>
										</div>
									</div>
									
									
								
								
								</div>
							</fieldset>
							
							
							
						
						</form>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
