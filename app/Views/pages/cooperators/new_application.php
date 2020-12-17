<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Application
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
   New Application
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
   New Application
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>

<link rel="stylesheet" href="assets/vendor/jquery-steps/jquery.steps.css">
<link rel="stylesheet" href="assets/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/third-party/previewForm/previewForm.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-lg-12 col-md-12 col-sm-12" style="background-color: white">
    <div class="card" >
        <div class="header">
            <h2>Cooperators - New Application</h2>

        </div>
        <div class="body" style="background-color: white">
            <form action="" method="post">
                     <div id="wizard_horizontal">
                <h2>Personal Details</h2>
                <section style="background-color: white">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Staff ID:</span>
                                    </div>
                                    <input type="text"  name="application_staff_id" id="application_staff_id" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">First Name:</span>
                                    </div>
                                    <input type="text"  name="application_first_name" id="application_first_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Last Name:</span>
                                    </div>
                                    <input type="text" name="application_last_name" id="application_last_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Other Name:</span>
                                    </div>
                                    <input type="text"  name="application_other_name" id="application_other_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">E-Mail:</span>
                                    </div>
                                    <input type="email" name="application_email" id="application_email" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>



                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth:</span>
                                    </div>
                                    <input type="date" name="application_dob" id="application_dob" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Gender:</label>
                                    </div>
                                    <select class="custom-select" name="application_gender" id="application_gender">
                                        <option value="">-- Gender --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Location:</label>
                                    </div>
                                    <select class="custom-select" name="application_location_id" id="application_location_id">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Department:</label>
                                    </div>
                                    <select class="custom-select" name="application_department_id" id="application_departmenta">
                                        <option value="1">-- Department --</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Payroll Group:</label>
                                    </div>
                                    <select class="custom-select" name="application_payroll_group_id" id="application_payroll_group_ida">
                                        <option value="1">-- PG --</option>
                                    </select>
                                </div>





                            </div>

                        </div>





                </section>
                <h2>Contact Details</h2>
                <section style="background-color: white">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address:</span>
                                    </div>
                                    <textarea rows="6" cols="5"  name="application_address" class="form-control" id="application_address" aria-label="Address"></textarea>
                                </div>






                            </div>

                            <div class="col-sm-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">State:</label>
                                    </div>
                                    <select class="custom-select" name="application_state_id" id="application_state_id">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                    </div>
                                    <input type="text" name="application_city" class="form-control" id="application_city" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                    </div>
                                    <input type="text" name="application_telephone" class="form-control" id="application_telephone" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>



                            </div>

                        </div>


                    </fieldset>
                </section>
                <h2>Next of Kin</h2>
                <section style="background-color: white">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Full Name:</span>
                                    </div>
                                    <input type="text" name="application_kin_fullname" id="application_kin_fullname" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                    </div>
                                    <input type="email" name="application_kin_email" id="application_kin_email" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                    </div>
                                    <input type="text" name="application_kin_phone" id="application_kin_phone" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Relationship:</label>
                                    </div>
                                    <select class="custom-select" name="application_kin_relationship"  id="application_kin_relationship">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>








                            </div>

                            <div class="col-sm-6">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address:</span>
                                    </div>
                                    <textarea rows="7" cols="5" id="application_kin_address" name="application_kin_address" class="form-control" aria-label="Address"></textarea>
                                </div>






                            </div>

                        </div>


                    </fieldset>

                </section>

                <h2>Bank Details</h2>
                <section style="background-color: white">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Bank:</label>
                                    </div>
                                    <select class="custom-select" name="application_bank_id"  id="application_bank_id">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                    </div>
                                    <input type="text" name="application_bank_branch" id="application_bank_branch" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                    </div>
                                    <input type="text" name="application_account_number" id="application_account_number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                    </div>
                                    <input type="text" name="application_sort_code" id="application_sort_code" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>









                            </div>

                        </div>


                    </fieldset>
                </section>

                <h2>Minimum Savings</h2>
                <section style="background-color: white">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label label-custom">Savings:</label>
                                    <div class="col-sm-8 input-custom">
                                        <input type="text" name="application_savings" id="application_savings" class="form-control">
                                    </div>
                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label label-custom">Account Number:</label>
                                    <div class="col-sm-8 input-custom">
                                        <input type="text" name="application_account_number" id="application_account_number" class="form-control">
                                    </div>
                                </div>






                            </div>
                            <div class="card">
                                <div class="body">
                                    <input type="file" class="dropify">
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </section>

                <h2>Preview</h2>
                <section style="background-color: white">

                    <div  style="margin-top: 10%">
                        <div class="body">
                           <div class="row">
                               <div class="col-sm-3">

                               </div>

                                <div class="col-sm-3">
                                    <button class="btn btn-primary btn-block" id="preview" type="button">Preview</button></td>
                                </div>
                               <div class="col-sm-3">
                                   <button class="btn btn-primary btn-block" type="submit">Submit</button></td>
                               </div>


                               <div class="col-sm-3">

                               </div>

                           </div>
                        </div>
                    </div>

                </section>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"><b> Preview Before Submitting </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <b><p>Personal Details:</p> </b> <br>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Staff ID:</span>
                            </div>
                            <input type="text"  name="application_staff_id" id="application_staff_id" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">First Name:</span>
                            </div>
                            <input type="text"  name="application_first_name" id="application_first_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Last Name:</span>
                            </div>
                            <input type="text" name="application_last_name" id="application_last_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Other Name:</span>
                            </div>
                            <input type="text"  name="application_other_name" id="application_other_name" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">E-Mail:</span>
                            </div>
                            <input type="email" name="application_email" id="application_email" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>



                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth:</span>
                            </div>
                            <input type="date" name="application_dob" id="application_dob" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>


                    </div>

                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Gender:</label>
                            </div>
                            <select class="custom-select" name="application_gender" id="application_gender">
                                <option value="">-- Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Location:</label>
                            </div>
                            <select class="custom-select" name="application_location_id" id="application_location_id">
                                <option value="1">-- L --</option>
                            </select>
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Department:</label>
                            </div>
                            <select class="custom-select" name="application_department_id" id="application_department">
                                <option value="1">-- Department --</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Payroll Group:</label>
                            </div>
                            <select class="custom-select" name="application_payroll_group_id" id="application_payroll_group_id">
                                <option value="1">-- PG --</option>
                            </select>
                        </div>





                    </div>

                </div>
                <br>  <b> <p>Contact Details:</p> </b>
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Address:</span>
                                </div>
                                <textarea rows="6" cols="5"  name="application_address" class="form-control" id="application_address" aria-label="Address"></textarea>
                            </div>






                        </div>

                        <div class="col-sm-6">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">State:</label>
                                </div>
                                <select class="custom-select" name="application_state_id" id="application_state_id">
                                    <option value="1">-- L --</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                </div>
                                <input type="text" name="application_city" class="form-control" id="application_city" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                </div>
                                <input type="text" name="application_telephone" class="form-control" id="application_telephone" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>



                        </div>

                    </div>


                </fieldset>
                <br> <b> <p>Next of Kin:</p> </b> <br>
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Full Name:</span>
                                </div>
                                <input type="text" name="application_kin_fullname" id="application_kin_fullname" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                </div>
                                <input type="email" name="application_kin_email" id="application_kin_email" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                </div>
                                <input type="text" name="application_kin_phone" id="application_kin_phone" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>


                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Relationship:</label>
                                </div>
                                <select class="custom-select" name="application_kin_relationship"  id="application_kin_relationship">
                                    <option value="1">-- L --</option>
                                </select>
                            </div>








                        </div>

                        <div class="col-sm-6">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Address:</span>
                                </div>
                                <textarea rows="7" cols="5" id="application_kin_address" name="application_kin_address" class="form-control" aria-label="Address"></textarea>
                            </div>






                        </div>

                    </div>


                </fieldset>
                <br>  <b> <p>Bank Details:</p> </b> <br>
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Bank:</label>
                                </div>
                                <select class="custom-select" name="application_bank_id"  id="application_bank_id">
                                    <option value="1">-- L --</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                </div>
                                <input type="text" name="application_bank_branch" id="application_bank_branch" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-sm-6">

                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                </div>
                                <input type="text" name="application_account_number" id="application_account_number" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="input-group input-group-sm mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                </div>
                                <input type="text" name="application_sort_code" id="application_sort_code" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>









                        </div>

                    </div>


                </fieldset>
                <br> <b> <p>Minimum Savings:</p> </b> <br>
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label label-custom">Savings:</label>
                                <div class="col-sm-8 input-custom">
                                    <input type="text" name="application_savings" id="application_savings" class="form-control">
                                </div>
                            </div>


                        </div>

                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label label-custom">Account Number:</label>
                                <div class="col-sm-8 input-custom">
                                    <input type="text" name="application_account_number" id="application_account_number" class="form-control">
                                </div>
                            </div>






                        </div>

                    </div>


                </fieldset>
            </div>
        </div>
    </div>
</div>






<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>
<script src="assets/third-party/previewForm/previewForm.js"></script>
    <script>
        $(document).ready(function(){
            $("#preview").click(function(){

                // show Modal
                $('#preview-modal').modal('show');
            });
            $('.simpletable').DataTable();

            $('.error-wrapper').hide();
            addNewDepartmentForm.onsubmit = async (e) => {
                e.preventDefault();

                axios.post('/add-new-department',new FormData(addNewDepartmentForm))
                    .then(response=>{
                        Toastify({
                            text: "Success! New department saved.",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            stopOnFocus: true,
                            onClick: function(){}
                        }).showToast();
                        $("#departmentTable").load(location.href + " #departmentTable");
                        $('#department_name').val('');
                    })
                    .catch(error=>{
                        //$('#validation-errors').html('');
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
        });
    </script>
<?= $this->endSection() ?>
