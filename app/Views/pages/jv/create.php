<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Journal Voucher 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>New Journal Voucher</h2>
            </div>
            <a href="<?= site_url('/add-new-chart-of-account') ?>" class="btn btn-sm btn-primary float-right mb-3">Add New Account</a>
            <div class="body">
            <h5 class="sub-title">New Journal Entry</h5>
                    <form action="<?php site_url('new-journal-voucher')?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Entry #</label>
                                            <input type="text"  name="entry_no" value="JV<?= rand(10,100)?>" readonly placeholder="Entry #" class="form-control">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table  invoice-detail-table">
                                        <thead>
                                        <tr class="thead-default">
                                            <th>Account</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Narration</th>
                                            <th>Name</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products">
                                                <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <select name="account[]" class="text-white  account js-example-basic-single select-account form-control">
                                                            <option disabled selected>Select account</option>
                                                            <?php foreach($accounts as $account) : ?>
                                                                    <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?? ''?> - <?= $account['glcode'] ?? ''?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Debit Amount" class="form-control debit-amount" value="0"  name="debit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Credit Amount" class="form-control credit-amount" value="0"  name="credit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="narration[]" class="form-control" placeholder="Narration">
                                                </td>
                                                <td>
                                                    <input type="text" name="name[]" class="form-control" placeholder="Name">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <table class="table  invoice-detail-table">
                                    <tr>
                                        <td colspan="3" class="text-right"><strong style="font-size:14px; text-transform:uppercase; text-align: right;">Total:</strong></td>
                                        <td class="text-right drTotal">0.00

                                        </td>
                                        <td class="text-center crTotal"> 00

                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="hidden" id="drTotalHidden">
                                    <input type="hidden" id="crTotalHidden">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary save-entry btn-mini"><i class="ti-check mr-2"> Save</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
        var debitTotal = 0;
        var creditTotal = 0;
        $(document).ready(function(){
            $(".select-account").select2({
                placeholder: "Select account"
            });
            //updateStatus();
            var grand_total = 0;
            var invoice_total = 0;

            $('#creditTotal').text(creditTotal);
            $('#debitTotal').text(debitTotal);
            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-account").select2({
                    placeholder: "Select account"
                });
                $(".select-account").last().next().next().remove();
            });

            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
            });
            $("body").on('focusout', '.debit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.credit-amount').val(0);
                sumDebit();
                sumCredit();
            });
            $("body").on('focusout', '.credit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.debit-amount').val(0);
                sumDebit();
                sumCredit();
            });

        });
        function updateStatus(debit, credit){
            if(debit != credit && debit <= 0 && credit <= 0){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

        function sumDebit(){
            var sum = 0;
            $(".debit-amount").each(function(){
                sum += +$(this).val();
            });
            $(".drTotal").text(sum.toLocaleString());
            $('#drTotalHidden').val(sum);
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }
        function sumCredit(){
            var sum = 0;
            $(".credit-amount").each(function(){
                sum += +$(this).val();
            });
            $('#crTotalHidden').val(sum);
            $(".crTotal").text(sum.toLocaleString());
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

    </script>
<?= $this->endSection() ?>
