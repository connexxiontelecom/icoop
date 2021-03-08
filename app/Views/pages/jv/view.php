<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Journal Voucher 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Journal Voucher
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


<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>View  Journal Voucher</h2>
            </div>
            <div class="body">
	
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
			
						<thead>
						<tr>
							<th>#</th>
							<th> Account</th>
							<th>Narration</th>
							<th style="text-align: right"> DR Amount</th>
							<th style="text-align: right">CR Amount</th>
							
						</tr>
						</thead>
						<tbody>
			            <?php
				            $serial = 1;
				            $total_credit = 0;
				            $total_debit = 0;
			            ?>
			            <?php foreach($entries as $entry): ?>
							<tr>
								<td><?= $serial++ ?></td>
								<td><?= $entry['glcode'] ?? '' ?></td>
								<td><?=$entry['narration']; ?></td>
								<td style="text-align: right"><?= number_format($entry['dr_amount'],2) ?? '' ?></td>
								<td style="text-align: right"><?= number_format($entry['cr_amount'],2) ?? '' ?></td>
								<?php
								$total_debit = $total_debit + $entry['dr_amount'];
								$total_credit = $total_credit + $entry['cr_amount'];
								?>
					
								
							</tr>
			            <?php endforeach; ?>
						<tr>
							<td><b>Total: </b> </td>
							<td> </td>
							<td> </td>
							<td style="text-align: right"><?= number_format($total_debit,2) ?? '' ?></td>
							<td style="text-align: right"><?= number_format($total_credit,2) ?? '' ?></td>
				   
			
						</tr>
						</tbody>
		
					</table>
				</div>
		<div class="col-sm-12 d-flex justify-content-center">
			<div class="btn-group">
            <form action="<?=site_url('decline-journal-voucher') ?>" method="post">
                    <?= csrf_field() ?>
				<input type="hidden" name="trash" value="1">
				<input type="hidden" name="ref_no" value="<?=$entry['ref_no']; ?>">
                               
                                    <button type="submit" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Decline Journal Voucher</button>
                                   
                          
                   
                    </form>
				
				<form action="<?=site_url('post-journal-voucher') ?>" method="post">
					<?= csrf_field() ?>
					
					<input type="hidden" name="posted" value="1">
					<input type="hidden" name="ref_no" value="<?=$entry['ref_no']; ?>">
					
				<button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Post Journal Voucher</i></button>
				
				
				
				</form>
		</div>
			</div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>

<?= $this->endSection() ?>
