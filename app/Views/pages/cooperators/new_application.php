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
    <link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css">
<link rel="stylesheet" type="text/css" href="/assets/third-party/jquery.steps/css/jquery.steps.css">
<style>
    .input-custom {
        margin-left: -10%;

    }
    .label-custom{
        text-align: right;
        margin-right: 10%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<form class="wizard-form" id="basic-forms" method="post" action="">
<div id="example-basic">

    <h5>Personal Details</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom" >Staff ID:</label>
                        <div class="col-sm-8 input-custom" >
                            <input type="text" name="application_staff_id" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">First Name:</label>
                        <div class="col-sm-8 input-custom" >
                            <input type="text" name="application_first_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Other Name:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_other_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Location:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_location_id"  class="form-control">
                                <option value="1">-- L --</option>


                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Date of Birth:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="date" name="application_payroll_group" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom" >Gender:</label>
                        <div class="col-sm-8 input-custom"  >
                            <select name="application_gender"  class="form-control">
                                <option value="">-- Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Last Name:</label>
                        <div class="col-sm-8 input-custom" >
                            <input type="text" name="application_last_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Department:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_department_id"  class="form-control">
                                <option value="1">-- Department --</option>


                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Payroll Group:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_payroll_group_id"  class="form-control">
                                <option value="1">-- PG --</option>


                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Email:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="email" name="application_email" class="form-control">
                        </div>
                    </div>
                </div>

            </div>


        </fieldset>
    </section>
    <h5>Contact Details</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Address:</label>
                        <div class="col-sm-8 input-custom" >
                            <textarea rows="5" cols="5" class="form-control" name="application_address" placeholder="Address"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">State:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_location_id"  class="form-control">
                                <option value="1">-- L --</option>


                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">City:</label>
                        <div class="col-sm-8 input-custom" >
                            <textarea rows="5" cols="5" class="form-control" name="application_city" placeholder="City"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Telephone:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_telephone" class="form-control">
                        </div>
                    </div>

                </div>

            </div>


        </fieldset>
    </section>
    <h5>Next of Kin</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Full name:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_kin_fullname" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Address:</label>
                        <div class="col-sm-8 input-custom" >
                            <textarea rows="5" cols="5" class="form-control" name="application_kin_address" placeholder="Address"></textarea>
                        </div>
                    </div>



                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Email:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_kin_email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Telephone:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_kin_phone" class="form-control">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Relationship:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_kin_state"  class="form-control">
                                <option value="1">-- L --</option>


                            </select>
                        </div>
                    </div>


                </div>

            </div>


        </fieldset>
    </section>

    <h5>Bank Details</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Bank:</label>
                        <div class="col-sm-8 input-custom">
                            <select name="application_bank_id"  class="form-control">
                                <option value="1">-- L --</option>


                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Bank Branch:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_bank_branch" class="form-control">
                        </div>
                    </div>



                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Account Number:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_account_number" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Sort Code:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_sort_code" class="form-control">
                        </div>
                    </div>




                </div>

            </div>


        </fieldset>
    </section>

    <h5>Min Savings</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Savings:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_savings" class="form-control">
                        </div>
                    </div>


                </div>

                <div class="col-sm-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Account Number:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_account_number" class="form-control">
                        </div>
                    </div>






                </div>

            </div>


        </fieldset>
    </section>

    <h5>Preview</h5>
    <section>
        <fieldset>
            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom">Savings:</label>
                        <div class="col-sm-8 input-custom">
                            <input type="text" name="application_savings" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label label-custom"></label>
                        <div class="col-sm-8 input-custom">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Submit Application</button>
                        </div>
                    </div>


                </div>



            </div>


        </fieldset>
    </section>

</div>


</form>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/datatable.min.js"></script>
<script src="/assets/third-party/jquery.cookie/js/jquery.cookie.js"></script>
<script src="/assets/third-party/jquery.steps/js/jquery.steps.js"></script>
<script src="/assets/third-party/jquery-validation/js/jquery.validate.js"></script>
    <script>
        $(document).ready(function(){
            $('.simpletable').DataTable();



            $("#wizard").steps({
                headerTag: "h5",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                autoFocus: true
            });



            $("#example-basic").steps({
                headerTag: "h5",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                autoFocus: true
            });





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
