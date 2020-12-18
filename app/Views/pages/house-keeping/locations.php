<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Locations 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Locations 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Locations
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
    <div class="col-lg-3">
        <div class="card">
            <div class="header">
                <h2> New Location</h2>

            </div>
            <div class="body">
                <form id="addNewLocationForm">
                    <div class="form-group">
                        <label for="">Location Name</label>
                        <input type="text" placeholder="Enter Location Name" id="location_name" name="location_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="btn-group">
                            <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="header">
                <h2>Locations</h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable simpletable" id="locationTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Location Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php $i = 1; foreach($locations as $location) : ?>
                            <tr>
                                <td><?= $i++ ?> </td>
                                <td><?= $location['location_name'] ?></td>
                                <td> 
                                    <a href="javascript:void(0);" class="editLocation" data-target="#editLocationModal" data-location="<?= $location['location_name']  ?>" data-locationid="<?= $location['location_id']  ?>" data-toggle="modal"> Edit</a>
                                    
                                 </td>
                            </tr>
                        <?php endforeach ?>
                        <tbody>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editLocationForm">
                    <div class="form-group">
                        <label for="">Location Name</label>
                        <input type="text"  class="form-control" name="location_name" id="editLocation" placeholder="Edit Location">
                        <input type="hidden" name="locationId" id="locationId">
                    </div>
                    <div class="form-group d-flex justify-content-center btn-group">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-round btn-primary">Save changes</button>            
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
            addNewLocationForm.onsubmit = async (e) => {
                e.preventDefault();

                axios.post('/add-new-location',new FormData(addNewLocationForm))
                .then(response=>{
                    Toastify({
                        text: "Success! New location saved.",
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
