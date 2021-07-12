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



<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="header">
                <h2>Cooperators - New Application</h2>

            </div>
	        <?php if(session()->has('errors')):
		        $errors = session()->get('errors');
		        foreach ($errors as $error):
			        ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<i class="mdi mdi-check-all mr-2"></i><strong><?php print_r($error); ?> !</strong>
					</div>
		        <?php endforeach; endif; ?>
            <div class="body wizard_validation">
                <form id="wizard_with_validation" method="POST" data-persist="garlic">
                    <h3>Personal Information</h3>
                    <fieldset>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="application_staff_id"><b>Staff Id*: </b></label>
                                    <input type="text"  class="form-control" placeholder="Staff Id *" name="application_staff_id" id="application_staff_id" onautocomplete="preview_form('application_staff_id')" onkeyup="preview_form('application_staff_id')" required>
                                </div>

                                <div class="form-group">
                                    <label for="application_first_name"><b>First Name*:</b></label>
                                    <input type="text"  class="form-control" placeholder="First Name *" name="application_first_name" id="application_first_name" onautocomplete="preview_form('application_first_name')" onkeyup="preview_form('application_first_name')" required>
                                </div>

                                <div class="form-group">
                                    <label for="application_last_name"><b>Last Name*:</b></label>
                                    <input type="text"  class="form-control" placeholder="Last Name *" name="application_last_name" id="application_last_name" onautocomplete="preview_form('application_last_name')" onkeyup="preview_form('application_last_name')" required>
                                </div>

                                <div class="form-group">
                                    <label for="application_other_name"><b>Other Name:</b></label>
                                    <input type="text"  class="form-control" placeholder="Other Name " name="application_other_name" id="application_other_name" onautocomplete="preview_form('application_other_name')" onkeyup="preview_form('application_other_name')">
                                </div>

                                <div class="form-group">
                                    <label for="application_email"><b>Email*:</b></label>
                                    <input type="email"  class="form-control" placeholder="E-Mail" name="application_email" id="application_email" onautocomplete="preview_form('application_email')" onkeyup="preview_form('application_email')">
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-12">

                                <div class="form-group">

                                    <label  for="application_gender"><b>Gender: </b></label>

                                    <select class="custom-select" required name="application_gender" onfocus="preview_form('application_gender')" onchange="preview_form('application_gender')" id="application_gender">
                                        <option>-- Gender --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>


                                <div class="form-group">

                                    <label for="application_location_id"><b>Location: </b></label>

                                    <select class="custom-select" required name="application_location_id" onfocus="preview_form('application_location_id')" onchange="preview_form('application_location_id')" id="application_location_id">
                                        <option value="1">FCT</option>
                                    </select>
                                </div>


                                <div class="form-group">

                                    <label for="application_department"><b>Department:</b></label>

                                    <select class="custom-select" required name="application_department_id" id="application_department"  onfocus="preview_form('application_department')" onchange="preview_form('application_department')">
                                        <?php foreach($departments as $department): ?>
                                            <option value="<?=$department['department_id']; ?>"><?=$department['department_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Payroll Group: </b></label>

                                    <select class="custom-select" required name="application_payroll_group_id" id="application_payroll_group_id" onfocus="preview_form('application_payroll_group_id')" onchange="preview_form('application_payroll_group_id')">

                                        <?php foreach ($pgs as $pg): ?>
                                            <option value="<?=$pg['pg_id'] ?>"> <?=$pg['pg_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="application_dob"><b>Date of Birth</b></label>
                                    <input type="date" class="form-control" placeholder="Date of birth*" name="application_dob" id="application_dob" onautocomplete="preview_form('application_dob')" onkeyup="preview_form('application_dob')" required>
                                </div>

                            </div>

                        </div>
                    </fieldset>
                    <h3>Contact Information</h3>
                    <fieldset>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">

                                    <label  for="application_state_id"> <b> State: </b></label>

                                    <select class="custom-select" required name="application_state_id" id="application_state_id" onfocus="preview_form('application_state_id')" onchange="preview_form('application_state_id')">
                                        <option> --Select State -- </option>
                                        <?php foreach ($states as $state): ?>
                                            <option value="<?=$state['state_id'] ?>"> <?=$state['state_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="application_city"><b>City*:</b></label>
                                    <input type="text" name="application_city" id="application_city" placeholder="City * " onautocomplete="preview_form('application_city')" onkeyup="preview_form('application_city')" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <label for="application_telephone"><b>Telephone Number*:</b></label>
                                    <input type="text" name="application_telephone" id="application_telephone" placeholder="Telephone *" onautocomplete="preview_form('application_telephone')" onkeyup="preview_form('application_telephone')" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="application_address"><b>Address*:</b></label>
                                    <textarea name="application_address" id="application_address"  cols="30" rows="3" placeholder="Address *" onautocomplete="preview_form('application_address')" onkeyup="preview_form('application_address')" class="form-control no-resize" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3>Next Of Kin</h3>
                    <fieldset>
                        <div class="row clearfix">

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="application_kin_fullname"><b>Full Name:</b></label>
                                    <input type="text" name="application_kin_fullname" id="application_kin_fullname" placeholder="Full Name" onautocomplete="preview_form('application_kin_fullname')" onkeyup="preview_form('application_kin_fullname')" class="form-control">
                                </div>

                                <div class="form-group">

                                    <label  for="application_kin_relationship"> <b> Relationship: </b></label>

                                    <select class="custom-select" required name="application_kin_relationship" id="application_kin_relationship" onfocus="preview_form('application_kin_relationship')" onchange="preview_form('application_kin_relationship')">


                                            <option value="sibling"> Sibling </option>
                                            <option value="spouse">Spouse</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="application_kin_fullname"><b>Email:</b></label>
                                    <input type="email" name="application_kin_fullname" id="application_kin_email" placeholder="email *" onautocomplete="preview_form('application_kin_fullname')" onkeyup="preview_form('application_kin_fullname')" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="application_kin_fullname"><b>Telephone:</b></label>
                                    <input type="text" name="application_kin_phone" id="application_kin_phone" placeholder="Phone Number" onautocomplete="preview_form('application_kin_phone')" onkeyup="preview_form('application_kin_phone')" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="application_address"><b>Address*:</b></label>
                                    <textarea name="application_kin_address" id="application_kin_address"  cols="30" rows="3" placeholder="Address *" onautocomplete="preview_form('application_kin_address')" onkeyup="preview_form('application_kin_address')" class="form-control no-resize"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h3>Bank Details</h3>
                    <fieldset>



                        <div class="row clearfix">


                            <div class="col-lg-6 col-md-12">


                                <div class="form-group">

                                    <label for="application_bank_id"> <b>Bank*: </b></label>

                                    <select class="custom-select" name="application_bank_id" onfocus="preview_form('application_bank_id')" onchange="preview_form('application_bank_id')" id="application_bank_id">


                                        <?php foreach ($banks as $bank): ?>
                                            <option value="<?=$bank['bank_id'] ?>"> <?=$bank['bank_name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label  for="application_bank_branch"><b>Bank Branch*:</b></label>

                                    <input type="text" required name="application_bank_branch" id="application_bank_branch" onautocomplete="preview_form('application_bank_branch')" onkeyup="preview_form('application_bank_branch')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="form-group">
                                    <label  for="application_bank_branch"><b>Savings*:</b></label>

                                    <input type="text" required name="application_savings"  id="application_savings" onautocomplete="preview_form('application_savings')" onkeyup="preview_form('application_savings')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>



                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="application_account_number"><b> Account Number*: </b></label>
                                    <input type="text" name="application_account_number" required id="application_account_number" onautocomplete="preview_form('application_account_number')" onkeyup="preview_form('application_account_number')" class="form-control">
                                </div>

                                <div class="form-group">

                                    <label for="application_sort_code"><b>Sort Code:</b></label>

                                    <input type="text" name="application_sort_code" id="application_sort_code" onautocomplete="preview_form('application_sort_code')" onkeyup="preview_form('application_sort_code')" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label  for="application_bank_branch"><b>Minimum Savings*:</b></label>

                                    <input type="text" disabled readonly  class="form-control" value="<?=number_format($profile['minimum_saving'], 2) ?>">
                                </div>
                            </div>


                        </div>
                    </fieldset>

                    <h3> Preview </h3>
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-12">

                                <b><p>Personal Details:</p> </b> <br>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width: 120px;">Staff ID:</span>
                                            </div>
                                            <input type="text"   id="application_staff_ida" disabled class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">First Name:</span>
                                            </div>
                                            <input type="text"   id="application_first_namea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Last Name:</span>
                                            </div>
                                            <input type="text"  id="application_last_namea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Other Name:</span>
                                            </div>
                                            <input type="text"   id="application_other_namea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">E-Mail:</span>
                                            </div>
                                            <input type="email"  id="application_emaila" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>



                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth:</span>
                                            </div>
                                            <input type="date"  id="application_doba" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                        </div>


                                    </div>

                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Gender:</label>
                                            </div>
                                            <select class="custom-select"  id="application_gendera">
                                                <option value="">-- Gender --</option>
                                                <option value="male" disabled>Male</option>
                                                <option value="female" disabled>Female</option>
                                            </select>
                                        </div>


                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Location:</label>
                                            </div>
                                            <select class="custom-select"  id="application_location_ida">
                                                <option value="1" disabled>-- L --</option>
                                            </select>
                                        </div>


                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Department:</label>
                                            </div>
                                            <select class="custom-select"  id="application_departmenta">
                                                <?php foreach($departments as $department): ?>
                                                    <option disabled value="<?=$department['department_id']; ?>"><?=$department['department_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Payroll Group:</label>
                                            </div>
                                            <select class="custom-select"  id="application_payroll_group_ida">

                                                <?php foreach ($pgs as $pg): ?>
                                                    <option disabled value="<?=$pg['pg_id'] ?>"> <?=$pg['pg_name']; ?></option>
                                                <?php endforeach; ?>

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
                                                <textarea rows="6" cols="5"  disabled  class="form-control" id="application_addressa" aria-label="Address"></textarea>
                                            </div>






                                        </div>

                                        <div class="col-sm-6">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">State:</label>
                                                </div>
                                                <select class="custom-select"  id="application_state_ida">
                                                    <?php foreach($states as $state): ?>
                                                        <option disabled value="<?=$state['state_id']; ?>"><?=$state['state_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                                </div>
                                                <input type="text" disabled  class="form-control" id="application_citya" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                                </div>
                                                <input type="text" disabled  class="form-control" id="application_telephonea" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                                <input type="text" disabled  id="application_kin_fullnamea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                                </div>
                                                <input type="email" disabled id="application_kin_emaila" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                                </div>
                                                <input type="text"   disabled id="application_kin_phonea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>


                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="inputGroupSelect01">Relationship:</label>
                                                </div>
                                                <select class="custom-select"  id="application_kin_relationshipa">
                                                    <option disabled value="1">-- L --</option>
                                                </select>
                                            </div>








                                        </div>

                                        <div class="col-sm-6">

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Address:</span>
                                                </div>
                                                <textarea disabled rows="7" cols="5" id="application_kin_addressa"  class="form-control" aria-label="Address"></textarea>
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
                                                <select class="custom-select"   id="application_bank_ida">
                                                    <?php foreach ($banks as $bank): ?>
                                                        <option disabled value="<?=$bank['bank_id'] ?>"> <?=$bank['bank_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                                </div>
                                                <input type="text" disabled  id="application_bank_brancha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">

                                            <div class="input-group input-group-sm mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                                </div>
                                                <input type="text" disabled  id="application_account_numbera" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="input-group input-group-sm mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                                </div>
                                                <input type="text" disabled id="application_sort_codea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>









                                        </div>

                                    </div>


                                </fieldset>
                                <br> <b> <p>Minimum Savings:</p> </b> <br>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <div class="input-group input-group-sm mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Savings:</span>
                                                </div>
                                                <input type="text" disabled id="application_savingsa" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>





                                        </div>



                                    </div>


                                </fieldset>


                            </div>



                        </div>
                    </fieldset>
                    <?= csrf_field() ?>
                </form>
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
        function preview_form (element_id){

            let new_element_id = element_id+'a';

            document.getElementById(new_element_id).value = document.getElementById(element_id).value
            document.getElementById(new_element_id).disabled = true;
        }

    </script>
<?= $this->endSection() ?>
