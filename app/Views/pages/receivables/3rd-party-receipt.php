<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    3rd Party Receipt
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
  3rd Party Receipt
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    3rd Party Receipt 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link rel="stylesheet" href="/assets/vendor/sweetalert/sweetalert.css"/>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

   <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card" id="printArea">
                        <div class="header">
                            <img src="/assets/images/logo.png" alt="iCoop" height="92" width="220">
                            <p class="m-b-0"><strong>Address:</strong> 795 Folsom Ave, Suite 546 San Francisco, CA 54656</p>
                            <p class="m-b-0"><strong>Phone:</strong> +234</p>
                            <p class="m-b-0"><strong>Email:</strong> @</p>
                            <p class="m-b-0"><strong>Website:</strong> www</p>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-custom spacing5 mb-5">
                                            
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Customer Name</strong>
                                                    </td>                                                    
                                                    <td><?= $receipt->customer_name ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Transaction Date</strong>
                                                    </td>                                                    
                                                    <td><?= !is_null($receipt->cr_transaction_date) ? date('d M, Y', strtotime($receipt->cr_transaction_date)) : '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Account Name</strong>
                                                    </td>                                                    
                                                    <td><?= $receipt->account_name ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Account No.</strong>
                                                    </td>                                                    
                                                    <td> <?= $receipt->account_no ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Amount</strong>
                                                    </td>                                                    
                                                    <td> <?= '₦'.number_format($receipt->cr_amount,2) ?? '' ?> 
                                                        <p></p>
                                                    </td>
                                                </tr>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>         
                    <div class="row clearfix mb-5">
                        <div class="col-md-6 text-right">
                        <div class="btn-group">
                            <a class="btn btn-primary" href="<?= site_url('/third-party/email-receipt/'.$receipt->customer_receivable_id) ?>"><i class="icon-paper-plane"></i> Email</a>
                            <button class="btn btn-info print"><i class="icon-printer"></i> Print</button>
                        
                        </div>
                        </div>
                    </div> 
                </div>
            </div>
<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
<script src="/assets/js/printThis.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click', '.print', function(event){
        $('#printArea').printThis({
            header:"<p></p>",
            footer:"<p></p>",
        });
    });
});
</script>
<?= $this->endSection() ?>
