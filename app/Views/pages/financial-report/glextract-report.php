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
						<form action="<?= site_url('/gl-extract') ?>" method="post">
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
											
											
											<label for="account"> <b> Account: </b></label>
											<select name="account" id="account" class="custom-select" required>
												<option disabled selected>Select account</option>
												<?php foreach($accounts as $account):
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

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="body">
			<div class="table-responsive">
				<?php
					$_from = date("M j, Y", strtotime($from));
					$_to = date("M j, Y", strtotime($to));
				?>
				
				
				<table class="table js-basic-example dataTable simpletable table-custom spacing5">
					
					<thead>
					<tr role="row">
						<th colspan="9" style="text-align: center;" ><h3> Extract Between <?=$_from." - ".$_to; ?></h3> </th>
					</tr>
					<tr role="row">
						<th rowspan="2" style="width: 50px;"  >S/No.</th>
						<th rowspan="2" style="width: 150px;" >ACCOUNT CODE</th>
						<th rowspan="2" style="width: 150px;" >ACCOUNT NAME</th>
						<th colspan="2" rowspan="1"  style="text-align: center;" >PREVIOUS </th>
						<th colspan="2" rowspan="1" style="text-align: center;">PERIOD </th>
						<th colspan="2" rowspan="1" style="text-align: center;">CLOSING</th>
					</tr>
					<tr role="row">
						<th rowspan="1" colspan="1" style="text-align: right ; width: 200px;" >DR</th>
						<th rowspan="1" colspan="1" style="text-align: right; width: 200px;" >CR</th>
						<th rowspan="2" colspan="1" style="text-align: right; width: 200px;" >DR</th>
						<th rowspan="2" colspan="1" style="text-align: right; width: 200px;" >CR</th>
						<th rowspan="1" colspan="1" style="text-align: right; width: 200px;" >DR</th>
						<th rowspan="1" colspan="1" style="text-align: right; width: 200px;" >CR.</th>
					</tr>
					</thead>
					<tbody>
					
					
					
					<?php
						
						$i =1;
					
					
					
					?>
					
					<tr>
								<td><?=$i++; ?></td>
								<td> <?=$account_details['glcode']; ?></td>
								<td> <?=$account_details['account_name']; ?></td>
								<td style="text-align: right"> <?=number_format($ob['obdr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($ob['obcr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($pb['pbdr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($pb['pbcr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
								<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
							</tr>
					
					<tr>
						<td colspan="9" style="text-align: right">
						<form action="<?=site_url('/gl-extract-details') ?>" method="post">
							<?= csrf_field() ?>
							<input type="hidden" name="account" value="<?=$account_details['glcode'] ?>">
							<input type="hidden" name="from" value="<?=$from; ?>">
							<input type="hidden" name="to" value="<?=$to; ?>">
							<div class="form-group">
								<button type="submit" class="btn btn-info">Retrieve Details</button>
							</div>
						</form>
						</td>
					</tr>
							
					
					
					</tbody>
				</table>
				
	
			</div>
		</div>
	</div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
