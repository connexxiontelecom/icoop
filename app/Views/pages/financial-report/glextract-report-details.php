<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
GL Extract Details
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
GL Extract Details
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
GL Extract Details
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
						<th>S/No.</th>
						<th>Date</th>
						<th style="width: 200px;">Narration</th>
						<th style="width: 200px;">Description</th>
						<th style="width: 200px; text-align: right">DR </th>
						<th style="width: 200px; text-align: right">CR</th>
						
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
						
						<td style="text-align: right"> <?=number_format($ob['obdr'], 2); ?> </td>
						<td style="text-align: right"> <?=number_format($ob['obcr'], 2); ?> </td>
					
					</tr>
					
				
							
						<?php
							
							foreach ($pb_details as $detail):
					?>
								<tr>
									<td><?=$i++; ?></td>
									<td><?=$detail['gl_transaction_date'] ?> </td>
									<td><?=$detail['narration'] ?> </td>
									<td><?=$detail['gl_description'] ?>  </td>
								
									<td style="text-align: right"> <?=number_format($detail['dr_amount'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($detail['cr_amount'], 2); ?> </td>
								
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
