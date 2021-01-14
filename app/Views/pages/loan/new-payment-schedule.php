<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Payment Schedule 
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
New Payment Schedule 
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
New Payment Schedule 
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
                        <h6 class="sub-title p-3  text-uppercase">New Payment Schedule</h6>
                        <form action="<?= site_url('/loan/new') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                        <?= csrf_field() ?>

                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <strong for="">Date</strong>
                                        <input required type="date" name="date" id="date" placeholder="dd/mm/yyyy"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Bank</strong>
                                        <select name="bank" required id="bank" class="form-control">
                                            <option selected disabled>--Select bank--</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Payment to disburse</strong>
                                        <input type="number" step="0.01" required  name="payment" id="payment" placeholder="Payment to disburse"  class="form-control money">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <p><strong>Payment to disburse:</strong></p>
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                                <tr>
                                                <th scope="col">
                                                <div class="form-group form-check">
                                                        <label class="form-check-label" for="exampleCheck1">#</label>
                                                        <input type="checkbox" class="form-check-input ml-2" >
                                                    </div>
                                                </th>
                                                <th scope="col">Coop ID</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Loan Type</th>
                                                <th scope="col">Amount</th>
                                                </tr>
                                            <tbody>
                                                <?php $i = 1; foreach($loan_apps as $loan): ?>
                                                    <tr>
                                                        <th scope="row"> 
                                                            <div class="form-group form-check">
                                                                <label class="form-check-label" for="exampleCheck1"><?= $i++; ?></label>
                                                                <input type="checkbox" class="form-check-input ml-2">
                                                            </div>
                                                        </th>
                                                        <td><?= $loan['staff_id'] ?></td>
                                                        <td><?= $loan['name'] ?></td>
                                                        <td><?= $loan['loan_type'] ?></td>
                                                        <td>₦<?= number_format($loan['amount'],2) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <button class="btn btn-primary btn-sm float-right">Add to cart</button>
                                </div>
                            </div>
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
        var guarantor = null;
        var staff = null;
        $(document).ready(function(){
            $('#guarantor_wrapper_1').hide();
            $('#guarantor_wrapper_2').hide();
            $('#submitLoanBtn').attr('disabled','disabled');
            $('.money').simpleMoneyFormat();
           $(document).on('blur', '#staff_id', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-cooperator/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#name').text('');
                        }else{
                            $('#name').text(handler.cooperator_first_name+" "+handler.cooperator_last_name);
                        }
                    }
                    });
               }
           });
           $(document).on('blur', '#guarantor_1', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-cooperator/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_1').val('');
                        }else{
                            $('#guarantor_wrapper_1').show();
                            $('#guarantor_badge_1').html(handler.cooperator_first_name+" "+handler.cooperator_last_name);
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
                    url: '/get-cooperator/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_2').val('');
                        }else{
                            $('#guarantor_wrapper_2').show();
                            $('#guarantor_badge_2').html(handler.cooperator_first_name+" "+handler.cooperator_last_name);
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
               if(parseInt(money.replace(/,/g, '')) > amount){
                Toastify({
                    text: "Ooop! Amount must not exceed maximum credit limit for the selected loan type.",
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
        });
    </script>
<?= $this->endSection() ?>