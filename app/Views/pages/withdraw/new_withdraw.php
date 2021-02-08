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
                            <div class="col-lg-7 col-md-12">
                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Staff ID or Name: </b></label>
                                    <input type="text" class="form-control"  id="search_account"  onblur="get_ct()"   required  name="withdraw_staff_id" placeholder="Enter staff ID or  name">



                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>

                                    <select class="custom-select" id="ct_id" required name="withdraw_ct_id" onchange="get_account_balance()">
                                    <option> -- Select Contribution Type --</option>
<!--                                        --><?php //foreach ($cts as $ct): ?>
<!--                                            <option value="--><?//=$ct['contribution_type_id'] ?><!--"> --><?//=$ct['contribution_type_name']; ?><!--</option>-->
<!--                                        --><?php //endforeach; ?>
                                    </select>
                                </div>
                                <div class="alert alert-warning alert-dismissible" role="alert" id="balance_warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa fa-warning"></i> <span id="b_t"></span>
                                </div>

                                <div class="form-group">

                                    <label  for="application_payroll_group_id"> <b> Amount: </b></label>
                                    <input type="text" class="form-control"  required  name="withdraw_amount" id="withdraw_amount"  placeholder="Enter Amount">




                                    <input type="hidden" id="withdraw_balance" name="withdraw_balance" >

                                    <input type="hidden" id="withdraw_charge" name="withdraw_charge" value="<?=$policy_configs['savings_withdrawal_charge']; ?>" >

                                </div>

                                <div class="alert alert-warning alert-dismissible" role="alert" id="charge_warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <i class="fa fa-warning"></i> <span id="c_t"></span>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label for="application_first_name"><b>Date:</b></label>-->
<!--                                    <input type="date"  class="form-control" placeholder="Date" name="withdraw_date" required>-->
<!--                                </div>-->
                                <input type="hidden"  class="form-control" placeholder="Date" name="withdraw_date" value="<?=date('Y-m-d') ?>" required>


                                <div class="form-group">
                                    <label for="application_address"><b>Narration:</b></label>
                                    <textarea name="withdraw_narration" id="withdraw_narration"  cols="30" rows="3" placeholder="Narration "  class="form-control no-resize"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="application_first_name"><b>File(.PDF):</b></label>
                                    <input type="file"  class="form-control"  name="withdraw_file">
                                </div>


                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <button type="submit" id="withdraw_submit" class="btn btn-info btn-block">Submit</button>
                                    <div class="alert alert-danger alert-dismissible" role="alert" id="withdraw_warning">
                                        <!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                        <i class="fa fa-warning"></i> Withdraw Amount is Greater than Withdrawable Amount
                                    </div>

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

    $(document).ready(function() {
        $('#balance_warning').hide();
        $('#withdraw_submit').hide();
        $('#withdraw_warning').hide();
        $('#charge_warning').hide();

        $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });

            $("#withdraw_amount").keyup(function () {
                let withdraw_amount = parseFloat($(this).val());
                let withdraw_charge = parseFloat($('#withdraw_charge').val());
                let withdraw_balance = parseFloat($('#withdraw_balance').val());
                let charge = (withdraw_charge/100)*withdraw_amount;
                // alert(withdraw_balance);
                if(withdraw_amount <= withdraw_balance){
                    $('#withdraw_submit').show();
                    $('#withdraw_warning').hide();
                    $('#charge_warning').show();
                    $("#c_t").empty();
                    $("#c_t").append('Withdraw Charges: '+' NGN'+charge.toLocaleString());

                   // alert(withdraw_balance);
                }

                if(withdraw_amount > withdraw_balance){
                    $('#withdraw_submit').hide();
                    $('#withdraw_warning').show();
                    $("#c_t").empty();
                    $('#charge_warning').hide();
                   //alert(withdraw_balance);
                }




            });
        });
    });

    function get_account_balance(){
        $("#balance_warning").hide();
        $("#withdraw_balance").val(0);
        $("#b_t").empty()
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
                $("#balance_warning").show();
                $("#b_t").append(response.note);
                $("#withdraw_balance").val(response.balance);
                console.log(response)
            }
        });

    }




    function get_ct(){
        let t_staff_id =  $("#search_account").val();
        let staff_id = t_staff_id.split(',')[0];
        $.ajax({
            url: '<?php echo site_url('get_ct') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
            },
            dataType: 'json',
            success:function(response){
                $("#ct_id").empty();
                $("#ct_id").append('<option> -- Select Contribution Type --</option>');
                for (var i=0; i<response.length; i++) {
                    $("#ct_id").append('<option value="' + response[i].contribution_type_id + '">' + response[i].contribution_type_name + '</option>');
                }
                // console.log(response);
            }
        });

    }

</script>
<?= $this->endSection() ?>


