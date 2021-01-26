<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Withdrawal
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Withdrawal
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Withdrawal
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>New Withdrawal</h2>
            </div>

            <div class="body">
                <form method="POST" enctype="multipart/form-data">

                    <fieldset>
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Staff ID or Name: </b></label>
                                    <input type="text" class="form-control"  id="search_account"  required  name="withdraw_staff_id" placeholder="Enter staff id or  name">



                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>

                                    <select class="custom-select" id="ct_id" required name="contribution_upload_ct" onchange="get_account_balance()">

                                        <?php foreach ($cts as $ct): ?>
                                            <option value="<?=$ct['contribution_type_id'] ?>"> <?=$ct['contribution_type_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="application_first_name"><b>Date:</b></label>
                                    <input type="date"  class="form-control" placeholder="Date" name="contribution_upload_date" required>
                                </div>


                                <div class="form-group">
                                    <label for="application_address"><b>Narration:</b></label>
                                    <textarea name="contribution_upload_narration" id="application_address"  cols="30" rows="3" placeholder="Address *" onautocomplete="preview_form('application_address')" onkeyup="preview_form('application_address')" class="form-control no-resize" required></textarea>
                                </div>




                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>
                                </div>
                            </div>


                        </div>
                    </fieldset>


                </form>
            </div>
        </div>
    </div>




</div>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script>

    function get_account_balance(){

        let t_staff_id =  $("#search_account").val();
        let ct_id = $("#ct_id").val();
        let staff_id = t_staff_id.split(',')[0];

        $.ajax({
            url: '<?php echo site_url('compute_balance') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
                'ct_id': ct_id
            },
            dataType: 'json',
            success:function(response){
                console.log(response)
            }
        });

    }
    $(document).ready(function() {
        $('#balance_warning').hide();



        $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });
        });



//        $('input.number').keyup(function(event) {
//
//            // skip for arrow keys
//            if(event.which >= 37 && event.which <= 40) return;
//
//            // format number
//            $(this).val(function(index, value) {
//
//                    var parts = value.toString().split(".");
//                    parts[0] = parts[0].replace(/\D/g, "");
//                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//                   return parts.join(".");
//
////                return value
////                    .replace(/\D/g, "")
////                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
////                    ;
//            });
//        });

        $("#loan_type").change(function () {
            var id = $(this).val();
            var output;

            var dataString = 'id='+id;
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('loans/getloantype'); ?>',
                data: dataString,
                cache: false,
                datatype: "json",

                success : function(result){
                    output = result;
                    $('#loan_details').val(output);

                    var loan_details = $('#loan_details').val();
                    var loan_details_array = loan_details.split(" ");
                    var maximum_credit = loan_details_array[0].replace(/[^\w\s]/gi, '');
                    var maximum_tenure = loan_details_array[1].replace(/[^\w\s]/gi, '');
                    maximum_tenure = parseInt(maximum_tenure);
                    var interest_rate = loan_details_array[2];

                    var credit_format = maximum_credit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#maximum_credit_warning').show();
                    $('#maximum_duration_warning').show();
                    $('#interest_rate_warning').show();

                    $('#maximum_credit_warning').html("Maximum Credit limit is: "+credit_format);
                    $('#maximum_duration_warning').html("Maximum allowed tenure: "+maximum_tenure+" month(s)");
                    $('#interest_rate_warning').html("Loan Interest Rate: "+interest_rate+"%");

                    $('#maximum_credit_hidden').val(maximum_credit);
                    $('#maximum_tenure_hidden').val(maximum_tenure);
                    $('#interest_rate_hidden').val(interest_rate);

                }
            });
        });
        $("#principal").blur(function () {
            var entered_principal = $(this).val();
            entered_principal = entered_principal.replace(/,/g, '');
            entered_principal = parseFloat(entered_principal);
            var principal = $('#maximum_credit_hidden').val();
            principal = parseFloat(principal);



            if(entered_principal > principal){
                $('#maximum_credit_warning').attr("class", "alert alert-danger");
                $('#loan_button').prop("disabled", true);
            }
            else{
                $('#maximum_credit_warning').attr("class", "alert alert-success");
                $('#loan_button').prop("disabled", false);
            }
        });

        $("#duration").blur(function () {
            var entered_duration = $(this).val();
            entered_duration = parseInt(entered_duration);
            var duration = $('#maximum_tenure_hidden').val();
            duration = parseInt(duration);

            if(entered_duration > duration){
                $('#maximum_duration_warning').attr("class", "alert alert-danger");
                $('#loan_button').prop("disabled", true);
            }

            else {
                $('#maximum_duration_warning').attr("class", "alert alert-success");
                $('#loan_button').prop("disabled", false);
            }
        });

    });
</script>
<?= $this->endSection() ?>


