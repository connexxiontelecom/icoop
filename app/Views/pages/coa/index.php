<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Chart of Accounts 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Chart of Accounts 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Chart of Accounts
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
                <h2>Banks</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable simpletable" id="bankTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bank Name</th>
                            <th>Sort Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
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
