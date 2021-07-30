<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Cash Book
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Cash Book
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Cash Book
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
				<h2>Cash Book</h2>
			</div>
			<div class="body">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form action="" method="post">
							<?= csrf_field() ?>
							<fieldset>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										
										
										
										
										<div class="form-group">
											
											
											<label><b> Range </b></label>
											<div class="input-daterange input-group">
												<input type="date" class="input-sm form-control" name="from">
												<span class="input-group-addon range-to">to</span>
												<input type="date" class="input-sm form-control" name="to">
											</div>
										
										</div>
										
										<div class="form-group">
											
											
											<label for="account"> <b> Bank: </b></label>
											<select name="bank" id="account" class="custom-select" required>
												<option disabled selected>Select Bank</option>
												<?php foreach($banks as $bank): ?>
													<option value="<?= $bank->coop_bank_id ?>"> <?= $bank->bank_name ?? ''?> - <?= $bank->account_no ?? ''?>  </option>
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
