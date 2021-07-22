<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Balance Sheet
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Balance Sheet
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Balance Sheet
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
				<h2>Balance Sheet</h2>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<form action="<?= site_url('/balance-sheet') ?>" method="post">
						<?= csrf_field() ?>
						<div class="row">
							<div class="col-sm-12 col-md-8 col-lg-8">
								<div class="input-group mb-3 ml-5">
									<div class="input-group-prepend">
										<span class="input-group-text">From</span>
									</div>
									<input type="date" name="from" class="form-control" aria-label="From">
									
									<button class="btn  btn-primary" type="submit">Submit</button>
								</div>
							</div>
						</div>
					
					</form>
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
					$from = date("M j, Y", strtotime($from));
				
				?>
				
				
				<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
					
					<thead>
					<tr role="row">
						<th colspan="9" style="text-align: center;" ><h3> Balance Sheet As At <?=$from; ?></h3></th>
					</tr>
					<tr role="row">
						<th rowspan="2" style="width: 50px;"  >S/No.</th>
						<th rowspan="2" style="width: 150px;" >ACCOUNT CODE</th>
						<th rowspan="2" style="width: 150px;" >ACCOUNT NAME</th>
						<th rowspan="1" colspan="1" style="text-align: right ; width: 200px;" >DR</th>
						<th rowspan="1" colspan="1" style="text-align: right; width: 200px;" >CR</th>
						
					</tr>
					
					</thead>
					<tbody>
					<tr>
						<td colspan="9">
							<h3> ASSETS</h3>
						</td>
					</tr>
					
					
					<?php
						$total_opcr = 0;
						$total_opdr = 0;
						
						
						$i=1; foreach ($assets as $asset):
						$opcr = 0;
						$opdr = 0;
						$_opcr = 0;
						$_opdr = 0;
						
						
						
						$check = $asset['opening']['obdr'] - $asset['opening']['obcr'];
						
						
						if($check > 0):
							$opdr =$check;
							//$_opdr = $opdr + $asset['period']['pbdr'];
						endif;
						
						if($check < 0):
							
							$opcr =abs($check);
							//$_opcr = $opcr + $asset['period']['pbcr'];
						endif;
						
						
						
						?>
						
						<tr>
							<td><?=$i++; ?></td>
							<td> <?=$asset['opening']['acc_code']; ?></td>
							<td> <?=$asset['opening']['account_name']; ?></td>
							<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
						
						</tr>
						
						<?php  $total_opdr = $total_opdr + $opdr;
						$total_opcr = $total_opcr + $opcr;
						
					endforeach;
					
					?>
					
					<tr>
						<td colspan="9">
							<h3> LIABILITY</h3>
						</td>
					</tr>
					
					<?php
						foreach ($liabilities as $liability):
							$opcr = 0;
							$opdr = 0;
							$_opcr = 0;
							$_opdr = 0;
							
							
							
							$check = $liability['opening']['obdr'] - $liability['opening']['obcr'];
							
							
							if($check > 0):
								$opdr =$check;
//$_opdr = $opdr + $liability['period']['pbdr'];
							endif;
							
							if($check < 0):
								
								$opcr =abs($check);
//$_opcr = $opcr + $liability['period']['pbcr'];
							endif;
							
						
							?>
							
							<tr>
								<td><?=$i++; ?></td>
								<td> <?=$liability['opening']['acc_code']; ?></td>
								<td> <?=$liability['opening']['account_name']; ?></td>
								<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
								<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
								
							</tr>
							
							<?php  $total_opdr = $total_opdr + $opdr;
							$total_opcr = $total_opcr + $opcr;
							
						endforeach;
					
					?>
					
					<tr>
						<td colspan="9">
							<h3> EQUITY</h3>
						</td>
					</tr>
					<?php
						$opdr = 0;
						$opcr = 0;
						$profit = 0;
						$Rcb = $total_revenue_cr - $total_revenue_dr;
						$Ecb = $total_expense_dr - $total_expense_cr;
						
						$profit = $Rcb - $Ecb;
						if($profit > 0 ):
							$opcr = $profit;
							$_opcr = $profit;
						endif;
						
						if($profit < 0):
							$opdr = $profit;
							$_opdr = $profit;
						endif;
					
					
					?>
					
					<tr>
						<td><?=$i++; ?></td>
						<td> Profit/loss - (<?=$from.")"; ?></td>
						<td> </td>
						<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
						<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
					
					</tr>
					<?php
						$total_opdr = $total_opdr + $opdr;
						$total_opcr = $total_opcr + $opcr;
						
					?>
					<?php
						foreach ($equities as $equity):
							$opcr = 0;
							$opdr = 0;
				
							$check = $equity['opening']['obdr'] - $equity['opening']['obcr'];
							
							
							if($check > 0):
								$opdr =$check;
//$_opdr = $opdr + $equity['period']['pbdr'];
							endif;
							
							if($check < 0):
								
								$opcr =abs($check);
//$_opcr = $opcr + $equity['period']['pbcr'];
							endif;
						
							
							?>
							
							<tr>
								<td><?=$i++; ?></td>
								<td> <?=$equity['opening']['acc_code']; ?></td>
								<td> <?=$equity['opening']['account_name']; ?></td>
								<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
								<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
						
							</tr>
							
							<?php  $total_opdr = $total_opdr + $opdr;
							$total_opcr = $total_opcr + $opcr;
					
						endforeach;
					
					?>
					
				
					
					
					<tr>
						
						<td colspan="3"> <?='TOTAL'; ?></td>
						
						<td style="text-align: right"> <?=number_format($total_opdr, 2); ?> </td>
						<td style="text-align: right"> <?=number_format($total_opcr, 2); ?> </td>
	
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
