<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Post Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Post Journal Voucher
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Post Journal Voucher
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
                <h2>Journal Voucher</h2>
            </div>
            <div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
		
					<thead>
                    <tr>
                        <th>#</th>
						<th> Ref. No.</th>
                        <th> DR Amount</th>
                        <th> CR Amount</th>
                        <th> JV Date</th>
                        <th>Entry By</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $serial = 1;
                    ?>
                    <?php foreach($entries as $entry): ?>
                        <tr>
                            <td><?= $serial++ ?></td>
							<td><?= $entry['ref_no'] ?? '' ?></td>
                            <td><?= number_format($entry['total_debit'],2) ?? '' ?></td>
                            <td><?= number_format($entry['total_credit'],2) ?? '' ?></td>
                           
                            <td><?= !is_null($entry['jv_date'] ) ? date('d F, Y', strtotime($entry['jv_date'] )) : '-'?></td>
                            <td><?= $entry['first_name'] ?? '' ?> <?= $entry->surname ?? ''?></td>
                            <td><?= !is_null($entry['entry_date'] ) ? date('d F, Y', strtotime($entry['entry_date'] )) : '-'?></td>
                            <td>
                                <a href="<?= site_url('view-journal-voucher/'.$entry['ref_no']) ?>" class="btn btn-mini btn-info">Learn more</a>
                            </td>
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
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>

<?= $this->endSection() ?>
