<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Loan Application
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   New Loan Application
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    New Loan Application
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-xl-12">
                        <h6 class="sub-title p-3  text-uppercase">New Loan Application</h6>
                        <form action="<?= site_url('/loan/new') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                        <?= csrf_field() ?>
                            <div class="row bg-info p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <h6 class="text-uppercase text-white">Staff Details</h6>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <strong for="">Staff ID</strong>
                                        <input required type="number" name="staff_id" id="staff_id" placeholder="Staff ID"  class="form-control">
                                        <div id="suggesstion-box"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Name</strong>
                                        <p id="name"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Loan Type</strong>
                                        <select name="loan_type" required id="loan_type" class="form-control">
                                            <option selected disabled>--Select loan type--</option>
                                            <?php foreach($loan_types as $type) : ?>
                                                <option value="<?= $type['loan_setup_id'] ?>"><?= $type['loan_description'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Duration (months)</strong>
                                        <input type="number" required class="form-control" placeholder="Duration" id="duration" name="duration" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Amount</strong>
                                        <input type="text" required  name="amount" id="amount" placeholder="Amount"  class="form-control money">
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-info p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <h6 class="text-uppercase text-white">Loan Terms & Conditions</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 response">
                                    <div class="form-group">
                                        <strong for="">Loan Terms</strong>
                                        <p id="loan_terms"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-info p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <h6 class="text-uppercase text-white">Guarantor & Terms</h6>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Guarantor ID <small>(1)</small></strong>
                                        <input type="number" required  name="guarantor_1" id="guarantor_1" placeholder="Guarantor ID 1"  class="form-control">
                                        <small class="float-right" id="guarantor_wrapper_1"><label for="" class="badge badge-info" id="guarantor_badge_1">Guarantor</label></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                <div class="form-group">
                                    <strong for="">Guarantor ID <small>(2)</small> </strong>
                                    <input type="number" required  name="guarantor_2" id="guarantor_2" placeholder="Guarantor ID 2"  class="form-control">
                                    <small class="float-right" id="guarantor_wrapper_2"><label for="" class="badge badge-info" id="guarantor_badge_2">Guarantor</label></small>
                                </div>

                            </div>
                            <div class="row ">
                                    <div class="col-md-12 col-sm-12 col-lg-12 response ">
                                        <div class="fancy-checkbox" style="margin-top:30px;">
                                            <label><input type="checkbox" required name="terms_conditions"><span>Agree to terms and condition</span></label>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary" id="submitLoanBtn"><i class="ti-check mr-2"></i>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/simple.money.format.js"></script>
    <script>
        var duration = 0;
        var amount = 0;
        var savings = 0;
        var guarantor = null;
        var staff = null;
        $(document).ready(function(){
            $('#guarantor_wrapper_1').hide();
            $('#guarantor_wrapper_2').hide();
            $('#submitLoanBtn').attr('disabled','disabled');
            $('.money').simpleMoneyFormat();
            
/*             $("#staff_id").keyup(function(){
                $.ajax({
                type: "POST",
                url: "<?php echo site_url('compute_balance') ?>",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                    //$("#staff_id").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#staff_id").css("background","#FFF");
                }
                });
            });
             */
            $(document).on('blur', '#staff_id', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-cooperator/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        //if(html.length == 0){
                            $('#name').text('');
                        //}else{
                        savings = handler.savings.pd_amount;
                        
                            $('#name').text(handler.cooperator.cooperator_first_name+" "+handler.cooperator.cooperator_last_name);
                        //}
                    }
                    });
               }
           }); 
           $(document).on('blur', '#guarantor_1', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-guarantor/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_1').val('');
                        }else{
                            $('#guarantor_wrapper_1').show();
                            $('#guarantor_badge_1').html(handler.cooperator.cooperator_first_name+" "+handler.cooperator.cooperator_last_name);
                        }
                    }
                    });
               }
           });
           $(document).on('blur', '#guarantor_2', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-guarantor/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_2').val('');
                        }else{
                            $('#guarantor_wrapper_2').show();
                            $('#guarantor_badge_2').html(handler.cooperator.cooperator_first_name+" "+handler.cooperator.cooperator_last_name);
                        }
                    }
                    });
               }
           });
           $(document).on('blur', '#duration', function(e){
               e.preventDefault();
               if(parseInt($(this).val()) > duration){
                Toastify({
                    text: "Ooop! The duration you entered cannot be more than the maximum repayment periods for the selected loan type.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "linear-gradient(to right, #FF0000, #FFE8AC)",
                    stopOnFocus: true, 
                    onClick: function(){} 
                    }).showToast();
                    $('#submitLoanBtn').attr('disabled',true);
               }else{
                $('#submitLoanBtn').attr('disabled',false);
               }
           });
           $(document).on('blur', '#amount', function(e){
               e.preventDefault();
               var money = $(this).val();
               if(parseInt(money.replace(/,/g, '')) > amount || parseInt(money.replace(/,/g, '')) > savings){
                Toastify({
                    text: "Ooop! Amount must not exceed maximum credit limit for the selected loan type or your savings is not up to this amount.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "linear-gradient(to right, #FF0000, #FFE8AC)",
                    stopOnFocus: true, 
                    onClick: function(){} 
                    }).showToast();
                    $('#submitLoanBtn').prop('disabled',true);
               }else{
                $('#submitLoanBtn').prop('disabled',false);
               }
           });
           $(document).on('change', '#loan_type', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-loan-type/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        duration = handler.max_repayment_periods;
                        amount = handler.max_credit_limit;
                        $('#loan_terms').text(handler.loan_terms);
                        $('#duration').val('');
                        $('#amount').val('');
                    }
                    });
               }
           });
            $('#loanSetupForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; 
            });

            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });

          
        });
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
