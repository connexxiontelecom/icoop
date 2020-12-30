<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Add New Account 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Add New Account
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Add New Account
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
    
<div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="header">
                <h2> New Account</h2>

            </div>
            <div class="body">
                <form id="addNewBankForm" autocomplete="off">
                    <div class="form-group">
                        <label for="">GL Code</label>
                        <input type="text" placeholder="Enter Unique GL Code" id="glcode" name="glcode" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Account Name</label>
                        <input type="text" placeholder="Enter Account Name" id="account_name" name="account_name" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Account Type</label>
                                <select name="account_type" id="account_type" class="form-control">
                                    <option disabled selected>Select account type</option>
                                    <option value="1">Asset</option>
                                    <option value="2">Liability</option>
                                    <option value="3">Equity</option>
                                    <option value="4">Revenue</option>
                                    <option value="5">Expenses</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option disabled selected>Select type</option>
                                    <option value="1">General</option>
                                    <option value="2">Detail</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bank</label>
                                <select name="bank" id="bank" class="form-control">
                                    <option disabled selected>--Select--</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Parent Account</label>
                            <select name="parent_account" id="parent_account" class="form-control">
                                <option disabled selected>Select parent account</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Note</label>
                        <textarea name="note" id="note" style="resize:none;" placeholder="Leave note..." class="form-control"></textarea>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group ">
                            <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Submit</button>
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

            $('.error-wrapper').hide();
            $(document).on('click', '.editLocation', function(e){
                e.preventDefault();
                var location = $(this).data('location');
                var id = $(this).data('locationid');
                $('#editLocation').val(location);
                $('#locationId').val(id);
            });
            addNewBankForm.onsubmit = async (e) => {
                e.preventDefault();

                axios.post('/add-new-bank',new FormData(addNewBankForm))
                .then(response=>{
                    Toastify({
                        text: "Success! Bank saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                    $("#bankTable").load(location.href + " #bankTable");
                    $('#bank_name').val('');
                    $('#sort_code').val('');
                })
                .catch(error=>{
                        $.each(error.response.data.errors, function(key, value){
                            Toastify({
                            text: 'Error',
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #FF0000, #FE0000)",
                            stopOnFocus: true,
                            onClick: function(){}
                        }).showToast();
                        //$('#validation-errors').append("<li><i class='ti-hand-point-right text-danger mr-2'></i><small class='text-danger'>"+value+"</small></li>");
                    });
                });
            };
            editLocationForm.onsubmit = async (e) => {
                e.preventDefault();

                axios.post('/edit-location',new FormData(editLocationForm))
                .then(response=>{
                    Toastify({
                        text: "Success! Changes saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                    }).showToast();
                    $("#locationTable").load(location.href + " #locationTable");
                    $('#location_name').val('');
                    $('#editLocationModal').modal('hide');
                })
                .catch(error=>{
                        $.each(error.response.data.errors, function(key, value){
                            Toastify({
                            text: 'Ooops! Something went wrong.',
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #FF0000, #FE0000)",
                            stopOnFocus: true,
                            onClick: function(){}
                        }).showToast();
                        //$('#validation-errors').append("<li><i class='ti-hand-point-right text-danger mr-2'></i><small class='text-danger'>"+value+"</small></li>");
                    });
                });
            };
        });
    </script>
<?= $this->endSection() ?>
