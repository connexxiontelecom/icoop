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
                        <form action="<?= site_url('/loan/new-payment-schedule') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                        <?= csrf_field() ?>

                            <div class="row bg-light">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <strong for="">Payable Date</strong>
                                        <input required type="date" name="payable_date" id="payable_date" placeholder="dd/mm/yyyy"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 response">
                                    <div class="form-group">
                                        <strong for="">Bank</strong>
                                        <select name="bank" required id="bank" class="form-control">
                                            <option selected disabled>--Select bank--</option>
                                            <?php foreach($coopbank as $bank) : ?>
                                                <option value="<?= $bank->coop_bank_id ?>"><?= $bank->bank_name ?? '' ?> - (<?= $bank->account_no ?? '' ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <p><strong>Payment to disburse:</strong></p>
                                        <div class="table-responsive" style="overflow-y: scroll; height:300px;">
                                            <table class="table table-hover src-table">
                                                    <tr>
                                                    <th scope="col">#
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
                                                                        <input type="checkbox" name="approved_loans[]" class="form-check-input ml-2">
                                                                    </div>
                                                                </th>
                                                                <td><?= $loan->staff_id ?>
                                                                    <input type="hidden" name="coop_id[]" value="<?= $loan->staff_id ?>">
                                                                </td>
                                                                <td><?= $loan->cooperator_first_name ?? '' ?> <?= $loan->cooperator_last_name ?? '' ?></td>
                                                                <td>
                                                                    <?= $loan->loan_description ?? '' ?> 
                                                                    <input type="hidden" name="loan_type[]" value="">
                                                                </td>
                                                                <td>
                                                                    ₦<?= number_format($loan->amount ?? 0,2) ?>
                                                                    <input type="hidden" name="amount[]" value="<?= $loan->amount ?? 0 ?>">
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <button class="btn btn-primary btn-sm float-right" id="addToCart" type="button">Add to cart</button>
                                </div>
                            </div>
                            <div class="row p-2 mb-2">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <p><strong>Cart</strong></p>
                                        <div class="table-responsive">
                                        <table class="table table-hover target-table">
                                                <tr>
                                                <th scope="col">#
                                                </th>
                                                <th scope="col">Coop ID</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Loan Type</th>
                                                <th scope="col">Amount</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 d-flex justify-content-center">
                                    <div class="btn-group ">
                                        <a href="" class="btn btn-danger btn-sm">Cancel</a>
                                        <button class="btn btn-primary btn-sm">Submit</button>
                                    </div>
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

            $(document).on("click","#addToCart",function(){
                var getSelectedRows = $(".src-table input:checked").parents("tr");
                
                $(".target-table tbody").append(getSelectedRows);
            })
        });
    </script>
<?= $this->endSection() ?>
