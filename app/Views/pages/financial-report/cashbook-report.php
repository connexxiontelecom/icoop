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

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="body">
			<div class="table-responsive">
				<?php
					$_from = date("M j, Y", strtotime($from));
					$_to = date("M j, Y", strtotime($to));
				?>
				
				
				<table class="table table-bordered js-basic-example dataTable simpletable table-custom spacing5 ">
					
					<thead>
					<tr role="row">
						<th colspan="8" style="text-align: center;" ><h3> Cash book Between <?=$_from." - ".$_to; ?></h3> <h4><?=$account_details->glcode ?> - <?=$account_details->bank_name; ?> (<?=$account_details->account_no ?>)</h4>  </th>
					</tr>
					<tr role="row">
						<th>S/No.</th>
						<th>Date</th>
						<th style="width: 200px;">Narration</th>
						<th style="width: 200px;">Description</th>
						<th style="width: 200px; text-align: right">DR </th>
						<th style="width: 200px; text-align: right">CR</th>
						<th style="width: 200px; text-align: right">Bal</th>
					
					</tr>
					
					</thead>
					<tbody>
					<?php
						$i =1;
					?>
					
					<tr>
						<td><?=$i++; ?></td>
						<td> </td>
						<td> </td>
						<td><h5> B/F</h5>  </td>
						
						<?php $balance = $ob['obdr'] - $ob['obcr']  ?>
						
						<td style="text-align: right"> <?=number_format($ob['obdr'], 2); ?> </td>
						<td style="text-align: right"> <?=number_format($ob['obcr'], 2); ?> </td>
						<?php if($balance >= 0): ?>
						<td style="text-align: right"> <?=number_format($balance, 2); ?> </td>
						<?php endif; ?>
						
						<?php if($balance < 0): ?>
							<td style="text-align: right; color: red"> (<?=number_format(abs($balance), 2); ?> )</td>
						<?php endif; ?>
					
					</tr>
					
					
					
					<?php
						
						foreach ($pbs as $pb):
							?>
							<tr>
								<td><?=$i++; ?></td>
								<td><?=$pb['gl_transaction_date'] ?> </td>
								<td><?=$pb['narration'] ?> </td>
								<td><?=$pb['gl_description'] ?>  </td>
								
								<td style="text-align: right"> <?=number_format($pb['dr_amount'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($pb['cr_amount'], 2); ?> </td>
								<?php $balance = $balance + ($pb['dr_amount'] - $pb['cr_amount']) ?>
								<?php if($balance >= 0): ?>
									<td style="text-align: right"> <?=number_format($balance, 2); ?> </td>
								<?php endif; ?>
								
								<?php if($balance < 0): ?>
									<td style="text-align: right; color: red"> (<?=number_format(abs($balance), 2); ?> )</td>
								<?php endif; ?>
							
							</tr>
						
						<?php endforeach; ?>
					
					
					
					
							
					
					
					</tbody>
				</table>
				
	
			</div>
		</div>
	</div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
