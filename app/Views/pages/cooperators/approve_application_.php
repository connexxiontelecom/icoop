<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Verify Application
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Verify Application
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Verify Application
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>

<link rel="stylesheet" href="assets/vendor/jquery-steps/jquery.steps.css">
<link rel="stylesheet" href="assets/vendor/dropify/css/dropify.min.css">



<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: white">
        <div class="card" >
            <div class="header">
                <h2>Cooperators - Verify Application</h2>

            </div>
            <div class="body " style="background-color: white">

                <div>

                    <h5>Personal Details</h5>
                    <section style="background-color: white;">

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Staff ID:</span>
                                    </div>
                                    <input type="text"  disabled readonly value="<?=$application->application_staff_id; ?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">First Name:</span>
                                    </div>
                                    <input type="text" required disabled readonly value="<?=$application->application_first_name; ?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Last Name:</span>
                                    </div>
                                    <input type="text" required disabled readonly value="<?=$application->application_last_name; ?>" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Other Name:</span>
                                    </div>
                                    <input type="text"   disabled readonly value="<?=$application->application_other_name; ?>"  class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">E-Mail:</span>
                                    </div>
                                    <input type="email"  disabled readonly value="<?=$application->application_email; ?>"   class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>





                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Gender:</span>
                                    </div>
                                    <input type="text"  disabled readonly value="<?=$application->application_gender; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Location:</span>
                                    </div>
                                    <input type="text"  disabled readonly value="<?=$application->location_name; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Department:</span>
                                    </div>
                                    <input type="text"  disabled readonly value="<?=$application->department_name; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Payroll Group:</span>
                                    </div>
                                    <input type="text"  disabled readonly value="<?=$application->pg_name; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>


                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Date of Birth:</span>
                                    </div>
                                    <input type="date"  disabled readonly value="<?=$application->application_dob; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>



                            </div>

                        </div>





                    </section>
                    <br>
                    <h5>Contact Details</h5>
                    <section style="background-color: white">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address:</span>
                                        </div>
                                        <textarea rows="4" disabled cols="5" class="form-control" aria-label="Address"> <?=$application->application_address; ?></textarea>
                                    </div>






                                </div>

                                <div class="col-sm-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm"> State:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->state_name; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">City:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_city; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>


                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_telephone; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>




                                </div>

                            </div>


                        </fieldset>
                    </section>

                    <br>
                    <h5>Next of Kin</h5>
                    <section style="background-color: white">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Full Name:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_kin_fullname; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>


                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Email:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_kin_email; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Telephone:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_kin_phone; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>



                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Relationship:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_kin_relationship; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>









                                </div>

                                <div class="col-sm-6">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address:</span>
                                        </div>
                                        <textarea rows="5" disabled cols="5" class="form-control" aria-label="Address"> <?=$application->application_kin_address ?></textarea>
                                    </div>






                                </div>

                            </div>


                        </fieldset>

                    </section>

                    <br>
                    <h5>Bank Details</h5>
                    <section style="background-color: white">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Bank:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->bank_name; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>


                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Bank Branch:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_bank_branch; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                </div>


                                <div class="col-sm-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Account Number:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_account_number; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>


                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Sort Code:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_sort_code; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>









                                </div>

                            </div>


                        </fieldset>
                    </section>

                    <br>
                    <h5>Minimum Savings</h5>
                    <section style="background-color: white">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Savings:</span>
                                        </div>
                                        <input type="text"  disabled readonly value="<?=$application->application_savings; ?>" class="form-control"  aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                        <div class="header">
                                                <h2> <small>Verified By: <?=$application->application_verify_by; ?></small></h2>
                                                <h2><small>Verified Date: <?=$application->application_verify_date; ?></small></h2>
                                        </div>


                                </div>

                                <div class="col-sm-6">
                                    <label>Verification Comments:</label>
                                    <textarea class="form-control"  disabled rows="5" cols="30"> <?=$application->application_verify_comment ?></textarea>

                                    <br>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#discardModal">Discard</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifyModal">Approve</button>



                                </div>

                            </div>


                        </fieldset>
                    </section>

                    <section style="background-color: white">
                        <fieldset>
                            <div class="row">

                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-3">


                                    <div class="modal fade bd-example-modal-lg" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Approve Application</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <div class="form-group">
                                                            <label>Comments:</label>
                                                            <textarea class="form-control" name="application_approved_comment" rows="5" cols="30"></textarea>
                                                        </div>
                                                        <input type="hidden" name="application_status" value="2">

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-info btn-block">Approve</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <div class="col-sm-3">




                                    <div class="modal fade bd-example-modal-lg" id="discardModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title h4" id="myLargeModalLabel">Discard Application</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="">
                                                        <div class="form-group">
                                                            <label>Reason:</label>
                                                            <textarea class="form-control" name="application_discarded_reason" rows="5" cols="30" required></textarea>
                                                        </div>

                                                        <input type="hidden" name="application_status" value="3">

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-info btn-block">Discard</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>
                                <div class="col-sm-3"></div>

                            </div>


                        </fieldset>
                    </section>





                </div>

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

<script>
    function preview_form (element_id){

        let new_element_id = element_id+'a';

        document.getElementById(new_element_id).value = document.getElementById(element_id).value
        document.getElementById(new_element_id).disabled = true;
    }

</script>
<?= $this->endSection() ?>
