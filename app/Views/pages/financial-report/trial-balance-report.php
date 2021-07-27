<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Trial Balance 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Trial Balance 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Trial Balance
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
                <h2>Trial Balance</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form action="<?= site_url('trial-balance') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="input-group mb-3 ml-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">From</span>
                                    </div>
                                    <input type="date" name="from" class="form-control" aria-label="From">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input type="date" name="to" class="form-control" aria-label="To">
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
					$to = date("M j, Y", strtotime($to));
				?>
				
				
                <table class="table table-bordered table-hover js-basic-example dataTable simpletable table-custom spacing5">
					
                     <thead>
					 <tr role="row">
						<th colspan="9" style="text-align: center;" ><h3> Trial Balance for <?=$from." - ".$to; ?></h3></th>
					 </tr>
                        <tr role="row">
                            <th rowspan="2" style="width: 50px;"  >S/No.</th>
                            <th rowspan="2" style="width: 150px;" >ACCOUNT CODE</th>
                            <th rowspan="2" style="width: 150px;" >ACCOUNT NAME</th>
                            <th colspan="2" rowspan="1"  style="text-align: center;" >OPENING </th>
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
						<tr>
							<td colspan="9">
								<h3> ASSETS</h3>
							</td>
						</tr>
						
						
						<?php
							$total_opcr = 0;
							$total_opdr = 0;
							$_total_opcr = 0;
							$_total_opdr = 0;
							$total_cbcr = 0;
							$total_cbdr = 0;
							$total_pbdr = 0;
							$total_pbcr = 0;
							
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
							
							$OPCR = $opcr + $asset['period']['pbcr'];
							$OPDR = $opdr + $asset['period']['pbdr'];
							
							
							
							
							$cb = $OPDR - $OPCR;
							
							
							
							if($cb == 0):
								$_opcr =  0;
								$_opdr =  0;
							endif;
							
							
							
							if($cb > 0):
								$_opdr = $cb;
								$_opcr = 0;
							endif;
							
							if($cb < 0):
								$_opcr = abs($cb);
								$_opdr = 0;
								endif;
							
							?>
							
							<tr>
								<td><?=$i++; ?></td>
								<td> <?=$asset['opening']['acc_code']; ?></td>
								<td> <?=$asset['opening']['account_name']; ?></td>
								<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
								<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
								<td style="text-align: right"> <?=number_format($asset['period']['pbdr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($asset['period']['pbcr'], 2); ?> </td>
								<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
								<td style="text-align: right"> <?=number_format($_opcr, 2); ?> </td>
							</tr>
							
						<?php  $total_opdr = $total_opdr + $opdr;
								$total_opcr = $total_opcr + $opcr;
								$total_pbdr = $total_pbdr + $asset['period']['pbdr'];
								$total_pbcr = $total_pbcr + $asset['period']['pbcr'];
								$_total_opdr = $_total_opdr + $_opdr;
								$_total_opcr = $_total_opcr + $_opcr;
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
								
								$OPCR = $opcr + $liability['period']['pbcr'];
								$OPDR = $opdr + $liability['period']['pbdr'];
								
								
								
								
								$cb = $OPDR - $OPCR;
								
								
								
								if($cb == 0):
									$_opcr =  0;
									$_opdr =  0;
								endif;
								
								
								
								if($cb > 0):
									$_opdr = $cb;
									$_opcr = 0;
								endif;
								
								if($cb < 0):
									$_opcr = abs($cb);
									$_opdr = 0;
								endif;
								
								?>
								
								<tr>
									<td><?=$i++; ?></td>
									<td> <?=$liability['opening']['acc_code']; ?></td>
									<td> <?=$liability['opening']['account_name']; ?></td>
									<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($liability['period']['pbdr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($liability['period']['pbcr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opcr, 2); ?> </td>
								</tr>
								
								<?php  $total_opdr = $total_opdr + $opdr;
								$total_opcr = $total_opcr + $opcr;
								$total_pbdr = $total_pbdr + $liability['period']['pbdr'];
								$total_pbcr = $total_pbcr + $liability['period']['pbcr'];
								$_total_opdr = $_total_opdr + $_opdr;
								$_total_opcr = $_total_opcr + $_opcr;
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
							$_opdr =0;
							$_opcr =0;
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
							<td> Profit/loss - (<?=$from." - ".$to.")"; ?></td>
							<td> </td>
							<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
							<td style="text-align: right">0.00  </td>
							<td style="text-align: right">0.00 </td>
							<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
							<td style="text-align: right"><?=number_format($_opcr, 2); ?> </td>
						</tr>
						<?php
							$total_opdr = $total_opdr + $opdr;
							$total_opcr = $total_opcr + $opcr;
							$_total_opdr = $_total_opdr + $_opdr;
							$_total_opcr = $_total_opcr + $_opcr;
						?>
						<?php
							foreach ($equities as $equity):
								$opcr = 0;
								$opdr = 0;
								$_opcr = 0;
								$_opdr = 0;
								
								
								
								$check = $equity['opening']['obdr'] - $equity['opening']['obcr'];
								
								
								if($check > 0):
									$opdr =$check;
//$_opdr = $opdr + $equity['period']['pbdr'];
								endif;
								
								if($check < 0):
									
									$opcr =abs($check);
//$_opcr = $opcr + $equity['period']['pbcr'];
								endif;
								
								$OPCR = $opcr + $equity['period']['pbcr'];
								$OPDR = $opdr + $equity['period']['pbdr'];
								
								
								
								
								$cb = $OPDR - $OPCR;
								
								
								
								if($cb == 0):
									$_opcr =  0;
									$_opdr =  0;
								endif;
								
								
								
								if($cb > 0):
									$_opdr = $cb;
									$_opcr = 0;
								endif;
								
								if($cb < 0):
									$_opcr = abs($cb);
									$_opdr = 0;
								endif;
								
								?>
								
								<tr>
									<td><?=$i++; ?></td>
									<td> <?=$equity['opening']['acc_code']; ?></td>
									<td> <?=$equity['opening']['account_name']; ?></td>
									<td style="text-align: right"> <?=number_format($opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($opcr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($equity['period']['pbdr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($equity['period']['pbcr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opcr, 2); ?> </td>
								</tr>
								
								<?php  $total_opdr = $total_opdr + $opdr;
								$total_opcr = $total_opcr + $opcr;
								$total_pbdr = $total_pbdr + $equity['period']['pbdr'];
								$total_pbcr = $total_pbcr + $equity['period']['pbcr'];
								$_total_opdr = $_total_opdr + $_opdr;
								$_total_opcr = $_total_opcr + $_opcr;
							endforeach;
						
						?>
						
						<tr>
						
						
						<tr>
							<td colspan="9">
								<h3> REVENUE</h3>
							</td>
						</tr>
						
						<?php
							foreach ($revenues as $revenue):
								$opcr = 0;
								$opdr = 0;
								$_opcr = 0;
								$_opdr = 0;
								
								$cb = $revenue['period']['pbdr'] - $revenue['period']['pbcr'];
								if($cb > 0):
									$_opdr = $cb;
								endif;
								
								if($cb < 0 ):
									$_opcr = abs($cb);
								endif;
								
								
								
								?>
								
								<tr>
									<td><?=$i++; ?></td>
									<td> <?=$revenue['period']['acc_code']; ?></td>
									<td> <?=$revenue['period']['account_name']; ?></td>
									<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
									<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($revenue['period']['pbdr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($revenue['period']['pbcr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opcr, 2); ?> </td>
								</tr>
								
								<?php  $total_opdr = $total_opdr + $opdr;
								$total_opcr = $total_opcr + $opcr;
								$total_pbdr = $total_pbdr + $revenue['period']['pbdr'];
								$total_pbcr = $total_pbcr + $revenue['period']['pbcr'];
								$_total_opdr = $_total_opdr + $_opdr;
								$_total_opcr = $_total_opcr + $_opcr;
							endforeach;
						
						?>
						
						<tr>
							<td colspan="9">
								<h3> EXPENSES</h3>
							</td>
						</tr>
						
						<?php
							foreach ($expenses as $expense):
								$opcr = 0;
								$opdr = 0;
								$_opcr = 0;
								$_opdr = 0;
								
								$cb = $expense['period']['pbdr'] - $expense['period']['pbcr'];
								if($cb > 0):
									$_opdr = $cb;
								endif;
								
								if($cb < 0 ):
									$_opcr = abs($cb);
								endif;
								
								
								
								?>
								
								<tr>
									<td><?=$i++; ?></td>
									<td> <?=$expense['period']['acc_code']; ?></td>
									<td> <?=$expense['period']['account_name']; ?></td>
									<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
									<td style="text-align: right"> <?=number_format(0, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($expense['period']['pbdr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($expense['period']['pbcr'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opdr, 2); ?> </td>
									<td style="text-align: right"> <?=number_format($_opcr, 2); ?> </td>
								</tr>
								
								<?php  $total_opdr = $total_opdr + $opdr;
								$total_opcr = $total_opcr + $opcr;
								$total_pbdr = $total_pbdr + $expense['period']['pbdr'];
								$total_pbcr = $total_pbcr + $expense['period']['pbcr'];
								$_total_opdr = $_total_opdr + $_opdr;
								$_total_opcr = $_total_opcr + $_opcr;
							endforeach;
						
						?>
						
						
						<tr>
						
							<td colspan="3"> <?='TOTAL'; ?></td>
							
							<td style="text-align: right"> <?=number_format($total_opdr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($total_opcr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($total_pbdr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($total_pbcr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($_total_opdr, 2); ?> </td>
							<td style="text-align: right"> <?=number_format($_total_opcr, 2); ?> </td>
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
