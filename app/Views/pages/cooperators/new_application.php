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
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h5>Form Basic Wizard</h5>
        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>

    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                <div id="wizard1">
                    <section>
                        <form class="wizard-form" id="basic-forms" action="#">
                            <h3> Registration </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="userName-2" class="block">User name *</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="userName-21" name="userName" type="text" class=" form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="email-2-1" class="block">Email *</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="email-2-1" name="email" type="email" class=" form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="password-2" class="block">Password *</label>
                                    </div>
                                    <div class="col-sm-8 col-lg-10">
                                        <input id="password-21" name="password" type="password" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="confirm-2" class="block">Confirm Password *</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="confirm-21" name="confirm" type="password" class="form-control ">
                                    </div>
                                </div>
                            </fieldset>
                            <h3> General information </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="name-2" class="block">First name *</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="name-21" name="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="surname-2" class="block">Last name *</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="surname-21" name="surname" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="phone-2" class="block">Phone #</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="phone-21" name="phone" type="number" class="form-control phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="date" class="block">Date Of Birth</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="date1" name="Date Of Birth" type="text" class="form-control date-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        Select Country</div>
                                    <div class="col-sm-12">
                                        <select class="form-control required">
                                            <option>Select State</option>
                                            <option>Gujarat</option>
                                            <option>Kerala</option>
                                            <option>Manipur</option>
                                            <option>Tripura</option>
                                            <option>Sikkim</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <h3> Education </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="University-2" class="block">University</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="University-21" name="University" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Country-2" class="block">Country</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="Country-21" name="Country" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Degreelevel-2" class="block">Degree level #</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="Degreelevel-21" name="Degree level" type="text" class="form-control required phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="datejoin" class="block">Date Join</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="datejoin1" name="Date Of Birth" type="text" class="form-control required">
                                    </div>
                                </div>
                            </fieldset>
                            <h3> Work experience </h3>
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Company-2" class="block">Company:</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="Company-21" name="Company:" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="CountryW-2" class="block">Country</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="CountryW-21" name="Country" type="text" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="Position-2" class="block">Position</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input id="Position-21" name="Position" type="text" class="form-control required">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/datatable.min.js"></script>
    <script>
        $(document).ready(function(){
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
