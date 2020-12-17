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
                                    <input type="text"  name="application_staff_id" id="application_staff_id" onkeyup="preview_form('application_staff_id')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">First Name:</span>
                                    </div>
                                    <input type="text"  name="application_first_name" id="application_first_name" onkeyup="preview_form('application_first_name')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Last Name:</span>
                                    </div>
                                    <input type="text" name="application_last_name" id="application_last_name" onkeyup="preview_form('application_last_name')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Other Name:</span>
                                    </div>
                                    <input type="text"  name="application_other_name" id="application_other_name" onkeyup="preview_form('application_other_name')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">E-Mail:</span>
                                    </div>
                                    <input type="email" name="application_email" id="application_email" class="form-control" onkeyup="preview_form('application_email')" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>



                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth:</span>
                                    </div>
                                    <input type="date" name="application_dob" id="application_dob" class="form-control" onkeyup="preview_form('application_dob')" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Gender:</label>
                                    </div>
                                    <select class="custom-select" name="application_gender" onchange="preview_form('application_gender')" id="application_gender">
                                        <option value="">-- Gender --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Location:</label>
                                    </div>
                                    <select class="custom-select" name="application_location_id" onkeyup="preview_form('application_location_id')" id="application_location_id">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Department:</label>
                                    </div>
                                    <select class="custom-select" name="application_department_id" id="application_department" onkeyup="preview_form('application_department')">
                                        <?php foreach($departments as $department): ?>
                                            <option value="<?=$department['department_id']; ?>"><?=$department['department_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Payroll Group:</label>
                                    </div>
                                    <select class="custom-select" name="application_payroll_group_id" id="application_payroll_group_id" onkeyup="preview_form('application_payroll_group_id')">
                                        <?php foreach ($pgs as $pg): ?>
                                            <option value="<?=$pg['pg_id'] ?>"> <?=$pg['pg_name']; ?></option>
                                        <?php endforeach; ?>
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
                                    <textarea rows="6" cols="5"  name="application_address"  class="form-control" id="application_address" onkeyup="preview_form('application_address')" aria-label="Address"></textarea>
                                </div>






                            </div>

                            <div class="col-sm-6">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">State:</label>
                                    </div>
                                    <select class="custom-select" name="application_state_id" onchange="preview_form('application_state_id')" id="application_state_id">
                                        <?php foreach($states as $state): ?>
                                            <option value="<?=$state['state_id']; ?>"><?=$state['state_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                    </div>
                                    <input type="text" name="application_city" class="form-control" id="application_city" onkeyup="preview_form('application_city')" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                    </div>
                                    <input type="text" name="application_telephone" class="form-control" id="application_telephone" onkeyup="preview_form('application_telephone')" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                    <input type="text" name="application_kin_fullname" id="application_kin_fullname" onkeyup="preview_form('application_kin_fullname')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                    </div>
                                    <input type="email" name="application_kin_email" id="application_kin_email" onkeyup="preview_form('application_kin_email')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                    </div>
                                    <input type="text" name="application_kin_phone" id="application_kin_phone" onkeyup="preview_form('application_kin_phone')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Relationship:</label>
                                    </div>
                                    <select class="custom-select" name="application_kin_relationship" onchange="preview_form('application_kin_relationship')" id="application_kin_relationship">
                                        <option value="1">-- L --</option>
                                    </select>
                                </div>








                            </div>

                            <div class="col-sm-6">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address:</span>
                                    </div>
                                    <textarea rows="7" cols="5" id="application_kin_address" name="application_kin_address" onkeyup="preview_form('application_kin_address')" class="form-control" aria-label="Address"></textarea>
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
                                    <select class="custom-select" name="application_bank_id" onchange="preview_form('application_bank_id')" id="application_bank_id">
                                        <select class="custom-select"   id="application_bank_ida">
                                            <?php foreach ($banks as $bank): ?>
                                                <option value="<?=$bank['bank_id'] ?>"> <?=$bank['bank_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </select>
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                    </div>
                                    <input type="text" name="application_bank_branch" id="application_bank_branch" onkeyup="preview_form('application_bank_branch')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                    </div>
                                    <input type="text" name="application_account_number" id="application_account_number" onkeyup="preview_form('application_account_number')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                    </div>
                                    <input type="text" name="application_sort_code" id="application_sort_code" onkeyup="preview_form('application_sort_code')" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                        <input type="text" name="application_savings" id="application_savings" onkeyup="preview_form('application_savings')" class="form-control">
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


                        <div class="body">
                           <div class="row">
                               <div class="col-sm-12">

                                       <b><p>Personal Details:</p> </b> <br>
                                       <div class="row">
                                           <div class="col-sm-6">

                                               <div class="input-group input-group-sm mb-3">
                                                   <div class="input-group-prepend">
                                                       <span class="input-group-text" id="inputGroup-sizing-sm">Staff ID:</span>
                                                   </div>
                                                   <input type="text"   id="application_staff_ida" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                                       <option value="male">Male</option>
                                                       <option value="female">Female</option>
                                                   </select>
                                               </div>


                                               <div class="input-group mb-3">
                                                   <div class="input-group-prepend">
                                                       <label class="input-group-text" for="inputGroupSelect01">Location:</label>
                                                   </div>
                                                   <select class="custom-select"  id="application_location_ida">
                                                       <option value="1">-- L --</option>
                                                   </select>
                                               </div>


                                               <div class="input-group mb-3">
                                                   <div class="input-group-prepend">
                                                       <label class="input-group-text" for="inputGroupSelect01">Department:</label>
                                                   </div>
                                                   <select class="custom-select"  id="application_departmenta">
                                                       <?php foreach($departments as $department): ?>
                                                           <option value="<?=$department['department_id']; ?>"><?=$department['department_name']; ?></option>
                                                       <?php endforeach; ?>
                                                   </select>
                                               </div>

                                               <div class="input-group mb-3">
                                                   <div class="input-group-prepend">
                                                       <label class="input-group-text" for="inputGroupSelect01">Payroll Group:</label>
                                                   </div>
                                                   <select class="custom-select"  id="application_payroll_group_ida">
                                                       <select class="custom-select"   id="application_bank_ida">
                                                           <?php foreach ($pgs as $pg): ?>
                                                               <option value="<?=$pg['pg_id'] ?>"> <?=$pg['pg_name']; ?></option>
                                                           <?php endforeach; ?>
                                                       </select>
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
                                                       <textarea rows="6" cols="5"   class="form-control" id="application_addressa" aria-label="Address"></textarea>
                                                   </div>






                                               </div>

                                               <div class="col-sm-6">

                                                   <div class="input-group mb-3">
                                                       <div class="input-group-prepend">
                                                           <label class="input-group-text" for="inputGroupSelect01">State:</label>
                                                       </div>
                                                       <select class="custom-select"  id="application_state_ida">
                                                           <?php foreach($states as $state): ?>
                                                               <option value="<?=$state['state_id']; ?>"><?=$state['state_name'] ?></option>
                                                           <?php endforeach; ?>
                                                       </select>
                                                   </div>
                                                   <div class="input-group input-group-sm mb-3">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                                       </div>
                                                       <input type="text"  class="form-control" id="application_citya" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>

                                                   <div class="input-group input-group-sm mb-3">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                                       </div>
                                                       <input type="text"  class="form-control" id="application_telephonea" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                                       <input type="text"  id="application_kin_fullnamea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>

                                                   <div class="input-group input-group-sm mb-3">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                                       </div>
                                                       <input type="email"  id="application_kin_emaila" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>

                                                   <div class="input-group input-group-sm mb-3">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                                       </div>
                                                       <input type="text"  id="application_kin_phonea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>


                                                   <div class="input-group mb-3">
                                                       <div class="input-group-prepend">
                                                           <label class="input-group-text" for="inputGroupSelect01">Relationship:</label>
                                                       </div>
                                                       <select class="custom-select"  id="application_kin_relationshipa">
                                                           <option value="1">-- L --</option>
                                                       </select>
                                                   </div>








                                               </div>

                                               <div class="col-sm-6">

                                                   <div class="input-group">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text">Address:</span>
                                                       </div>
                                                       <textarea rows="7" cols="5" id="application_kin_addressa"  class="form-control" aria-label="Address"></textarea>
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
                                                           <option value="<?=$bank['bank_id'] ?>"> <?=$bank['bank_name']; ?></option>
                                                           <?php endforeach; ?>
                                                       </select>
                                                   </div>

                                                   <div class="input-group input-group-sm mb-3">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                                       </div>
                                                       <input type="text"  id="application_bank_brancha" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>
                                               </div>

                                               <div class="col-sm-6">

                                                   <div class="input-group input-group-sm mb-4">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                                       </div>
                                                       <input type="text"  id="application_account_numbera" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                   </div>

                                                   <div class="input-group input-group-sm mb-4">
                                                       <div class="input-group-prepend">
                                                           <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                                       </div>
                                                       <input type="text"  id="application_sort_codea" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
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
                                                           <input type="text"  id="application_savingsa" class="form-control">
                                                       </div>
                                                   </div>


                                               </div>

                                               <div class="col-sm-6">
                                                   <div class="form-group row">
                                                       <label class="col-sm-4 col-form-label label-custom">Account Number:</label>
                                                       <div class="col-sm-8 input-custom">
                                                           <input type="text"  id="application_account_numbera" class="form-control">
                                                       </div>
                                                   </div>






                                               </div>

                                           </div>


                                       </fieldset>


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
