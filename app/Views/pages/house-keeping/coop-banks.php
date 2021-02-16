<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Coop Banks
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Coop Banks 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Coop Banks 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
<link href="/assets/css/parsley.min.css" rel="stylesheet">
<link href="/assets/css/select2.min.css" rel="stylesheet">
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="row clearfix">
        <div class="col-lg-4">
            <div class="card">
                <div class="header">
                    <h2> New Coop Bank</h2>
                </div>
                <div class="body">
                    <form id="addNewCoopBankForm" action="<?= site_url('coop-bank') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                           <label for="">Bank</label>
                           <select name="bank" required id="bank" class="form-control js-example-basic-multiple">
                              <option disabled selected>Select Bank</option>
                              <?php foreach($banks as $bank) : ?>
                                <option value="<?= $bank['bank_id']?>"><?= $bank['bank_name'] ?></option>
                              <?php endforeach ?>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="">Account No.</label>
                            <input type="text" required placeholder="Account No." id="account_no" name="account_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Branch</label>
                            <input type="text" required placeholder="Branch" id="branch" name="branch" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" required class="form-control" id="description" style="resize:none;" placeholder="Description...."></textarea>
                            
                        </div>
                        <div class="form-group">
                           <label for="">GL Account</label>
                           <select name="gl_account" required id="gl_account" class="form-control js-example-basic-multiple">
                              <option disabled selected>Select GL Account</option>
                              <?php foreach($coas as $coa) : ?>
                                <option value="<?= $coa['glcode']?>"><?= $coa['account_name'] ?></option>
                              <?php endforeach ?>
                           </select>
                        </div>
                        

                        <?= csrf_field() ?>
                        <div class="form-group">
                            <div class="btn-group d-flex justify-content-center">
                                <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="header">
                    <h2>Coop Banks</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable simpletable" id="departmentTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>GL Code</th>
                                    <th>Account No.</th>
                                    <th>Bank Name</th>
                                    <th>Description</th>
                                    <th>Branch</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($coopbanks as $coop) : ?>
                                    <tr>
                                        <td><?= $i++ ?> </td>
                                        <td><?= $coop->glcode ?? '' ?> - <?= $coop->account_name ?? '' ?></td>
                                        <td><?= $coop->account_no ?? '' ?></td>
                                        <td><?= $coop->bank_name ?? '' ?></td>
                                        <td><?= $coop->description ?? '' ?></td>
                                        <td><?= $coop->branch ?? '' ?></td>
                                        <td><?= date('d M, Y', strtotime($coop->created_at)) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $coop->coop_bank_id ?>"><i class="fa fa-pencil-square-o"></i></button>
                                             <div class="modal fade" id="editModal<?= $coop->coop_bank_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Coop Bank</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editCoopBankForm" action="<?= site_url('edit-coop-bank') ?>" method="POST">
                                                                <?= csrf_field() ?>
                                                                <div class="form-group">
                                                                    <label for="">Bank</label> <br>
                                                                    <select name="bank" required id="bank" class="form-control js-example-basic-multiple">
                                                                        <option disabled selected>Select Bank</option>
                                                                        <?php foreach($banks as $bank) : ?>
                                                                            <option value="<?= $bank['bank_id']?>" <?= ($bank['bank_id'] == $coop->bank_id) ? 'selected' : '' ?>><?= $bank['bank_name'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Account No.</label>
                                                                        <input type="text" required placeholder="Account No." value="<?= $coop->account_no ?? '' ?>"  name="account_no" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Branch</label>
                                                                        <input type="text" required placeholder="Branch" name="branch" value="<?= $coop->branch ?? '' ?>" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Description</label>
                                                                        <textarea name="description" required class="form-control"   style="resize:none;" placeholder="Description...."><?= $coop->description ?? '' ?></textarea>
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">GL Account</label> <br>
                                                                        <select name="gl_account" required id="gl_account" class="form-control js-example-basic-multiple">
                                                                            <option disabled selected>Select GL Account</option>
                                                                            <?php foreach($coas as $coa) : ?>
                                                                                <option value="<?= $coa['glcode']?>" <?= ($coa['glcode'] == $coop->glcode) ? 'selected' : '' ?> ><?= $coa['account_name'] ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="btn-group d-flex justify-content-center">
                                                                        <input type="hidden" name="editCoop" value="<?= $coop->coop_bank_id ?>">
                                                                           <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                                                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Save changes</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </td>
                                    </tr>
                                <?php endforeach ?>
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


<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="/assets/js/parsley.min.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.simpletable').DataTable();
            $('.js-example-basic-multiple').select2();
            $('#addNewCoopBankForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; // Don't submit form for this demo
            });
        });
    </script>
<?= $this->endSection() ?>
