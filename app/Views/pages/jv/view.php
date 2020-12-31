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
            <a href="<?= site_url('/new-journal-voucher') ?>" class="btn btn-sm btn-primary float-right mb-3">Add New Account</a>
            <div class="body">
            <form action="#" method="post">
                    <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="sub-title">Journal Entry Details</h5>
                                <div class="form-group">
                                    <strong for="">Account</strong>
                                    <p><?= $entry['account_name'] ?? ''?> - (<?= $entry['glcode'] ?? ''?>)</p>
                                </div>
                                <div class="form-group">
                                    <strong for="">Amount</strong>
                                    <p>N<?= $entry['dr_amount'] > 0 ? number_format($entry['dr_amount'],2) : number_format($entry['cr_amount'],2)?></p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong for="">Date</strong>
                                            <p><?= !is_null($entry['jv_date']) ? date('d F, Y', strtotime($entry['jv_date'])) : '-' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong for="">Reference #</strong>
                                            <p><?= $entry->ref_no ?? '-'?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <strong for="">Name</strong>
                                    <p><?= $entry['name'] ?? '-' ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <strong for="">Narration</strong>
                                    <p><?= $entry['narration'] ?? '-' ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary total">N<?= $entry['dr_amount'] > 0 ? number_format($entry['dr_amount'],2) : number_format($entry['cr_amount'],2) ?></h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="{{route('decline-jv', $entry->slug)}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Decline Journal Voucher</a>
                                    <a href="{{route('post-jv', $entry->slug)}}" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Post Journal Voucher</i></a>
                                </div>
                            </div>
                        </div>
                    </form>
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
