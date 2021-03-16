<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    Member Report
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
    Member Report
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    Member Report 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/sweetalert/sweetalert.css"/>
    <link rel="stylesheet" href="/assets/css/toastify.min.css"/>
    <link rel="stylesheet" href="/assets/css/datatable.min.css"/>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-body">
                <div class="row ">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">Member Report</h6>
                        <form action="<?= site_url('/third-party/receivable/member-report') ?>" method="post" class="form-inline">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" class="form-control ml-2 mr-2" placeholder="dd/mm/yyyy" name="from">
                                
                            </div>
                            <div class="form-group">
                                <label for=""> To</label>
                                <input type="date" class="form-control ml-2" placeholder="dd/mm/yyyy" name="to">
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">Generate Report</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xl-12 mt-5">
                        <p>
                            Third-party Report from <label for="" class="badge badge-info"><?= date('d-m-y', strtotime($from)) ?></label> to <label for="" class="badge badge-danger"><?= date('d-m-y', strtotime($to)) ?></label>
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 col-sm-12">
                         <div class="table-responsive">
							 <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Amount</th>
                                            <th>GL Account</th>
                                            <th>Action</th>
                                        </tr>
                                    
                                    </thead>

                                    <tbody>
                                    
                                       <?php $i = 1; foreach($result as $app) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $app->cooperator_first_name ?? '' ?> <?= $app->cooperator_last_name ?? '' ?></td>
                                                <td class="text-right"><?= number_format($app->rm_amount,2) ?? '' ?> </td>
                                                <td><?= $app->glcode ?? '' ?> - <?= $app->account_name ?? '' ?> </td>
                                                <td>
                                                    <a href="<?= site_url('/third-party/view-member-receipt/'.$app->rm_id) ?>" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
  <script src="/assets/js/datatables.min.js"></script>
<script>
$(document).ready(function(){
    $('.simpletable').DataTable();
});
</script>
<?= $this->endSection() ?>
