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
                        <form action="<?= site_url('/third-party/receivable/report') ?>" method="post" class="form-inline">
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
                                <table class="table table-hover table-bordered" id="scheduledPaymentTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th>GL Account</th>
                                            <th>Action</th>
                                        </tr>
                                    
                                    </thead>

                                    <tbody>
                                    
                                       <?php $i = 1; foreach($result as $app) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $app->customer_name ?? '' ?></td>
                                                <td><?= $app->contact_person ?? '' ?> </td>
                                                <td><?= $app->email ?? '' ?> </td>
                                                <td><?= $app->phone_no ?? '' ?> </td>
                                                <td><?= $app->gl_account_code ?? '' ?> - <?= $app->account_name ?? '' ?> </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $app->coa_id ?? '' ?>"><i class="fa fa-pencil-square-o"></i></button>
                                                    <div class="modal fade" id="editModal<?= $app->coa_id ?? '' ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Report Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                <form enctype="multipart/form-data" action="<?= site_url('/third-party/receivable/edit-customer-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="">
                                                                        <?= csrf_field() ?>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6 col-sm-6">
                                                                                    <div class="form-group">
                                                                                        <strong for="">Customer/Debtor Name </strong>
                                                                                        <input required disabled type="text" name="customer_name" value="<?= $app->customer_name ?? '' ?>"   placeholder="Customer Name"  class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                                    <div class="form-group">
                                                                                        <strong for="">Contact Person</strong>
                                                                                        <input type="text" disabled name="contact_person" value="<?= $app->contact_person ?? '' ?>" class="form-control" placeholder="Contact Person">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                                    <div class="form-group">
                                                                                        <strong for="">Email</strong>
                                                                                        <input type="text" disabled required class="form-control" placeholder="Email Address" value="<?= $app->email ?? '' ?> " name="email" >
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                                    <div class="form-group">
                                                                                        <strong for="">Phone No.</strong>
                                                                                        <input type="text" disabled required  name="phone_no" value="<?= $app->phone_no ?? '' ?>" placeholder="Phone Number"  class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row ">
                                                                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                                                                    <div class="form-group">
                                                                                        <strong for="">GL Account Code</strong>
                                                                                        <select name="gl_account_code" disabled  class="form-control">
                                                                                            <option selected disabled>--Select GL Account Code--</option>
                                                                                            <?php foreach($accounts as $account) : ?>
                                                                                                <option value="<?= $account['glcode'] ?? '' ?>" <?= $account['glcode'] == $app->gl_account_code ? 'selected' : '' ?> ><?= $account['account_name'] ?? '' ?> - <?= $account['glcode'] ?? '' ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                            <input type="hidden" name="customer_id" value="<?= $app->customer_setup_id ?>">
                                                                            <hr>
                                                                            <div class="row mb-4">
                                                                                <div class="col-md-12 d-flex justify-content-center">
                                                                                    <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal" ><i class="ti-check mr-2"></i>Dismiss</button>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </form>     
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    $('#scheduledPaymentTable').DataTable();
});
</script>
<?= $this->endSection() ?>
