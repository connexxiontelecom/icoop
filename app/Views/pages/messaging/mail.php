<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Open Mail  
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Open Mail   
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Open Mail 
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
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="header">
        <h2>Open Mail</h2>
        <div class="row mt-3">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <h6>Subject</h6>
                        <p><?= $mail->subject ?? '' ?></p>
                        <h6>Message</h6>
                        <p><?= $mail->body ?? '' ?></p>
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
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
