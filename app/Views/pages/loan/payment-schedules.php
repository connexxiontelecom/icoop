<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payment Schedules  
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payment Schedules  
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payment Schedules 
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
    <div class="card-block">
        <div class="table-responsive" style="overflow-y: scroll; height:300px;">
            <table class="table table-hover src-table">
                    <tr>
                        <th scope="col">#
                        </th>
                        <th scope="col">Payable Date</th>
                        <th scope="col">Bank</th>
                        <th scope="col">Action</th>
                    </tr>
                    <tbody>
                        <?php $i = 1; foreach($schedules as $schedule) :  ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= date('d M, Y', strtotime($schedule->payable_date)) ?></td>
                                <td><?= $schedule->account_no ?? '' ?></td>
                                <td>
                                    <a href="<?= site_url('/loan/payment-schedule/'.$schedule->schedule_master_id) ?>" class="btn btn-primary btn-sm">Learn more</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
