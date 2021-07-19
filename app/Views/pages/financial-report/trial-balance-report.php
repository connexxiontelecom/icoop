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
                <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                     <thead>
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
								<h3> ASSETS</h3>
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
