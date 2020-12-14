<?= 
    $this->extend('layouts/master')
?>

<?= $this->section('title') ?>
Dashboard 
<?= $this->endSection() ?>


<?= $this->section('content') ?>
    <div class="row">
        <!-- sale card start -->

        <div class="col-md-3">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">Pending Registration</h6>
                    <h4 class="m-t-15 m-b-15"><i class="ti-timer m-r-15 text-c-white"></i>7652</h4>
                    <p class="m-b-0">48% From Last 24 Hours</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">Loan Application</h6>
                    <h4 class="m-t-15 m-b-15"><i class="ti-files m-r-15 text-c-white"></i>6325</h4>
                    <p class="m-b-0">36% From Last 6 Months</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">New Messages</h6>
                    <h4 class="m-t-15 m-b-15"><i class="ti-email m-r-15 text-c-white"></i>652</h4>
                    <p class="m-b-0">36% From Last 6 Months</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">Contact Enquiries</h6>
                    <h4 class="m-t-15 m-b-15"><i class="ti-user m-r-15 text-c-white"></i>5963</h4>
                    <p class="m-b-0">36% From Last 6 Months</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">Ending Loans</h6>
                    <p>View loan ending this month.</p>
                    <div id="morris-site-visit"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="card text-center order-visitor-card">
                <div class="card-block">
                    <h6 class="m-b-0">Our Growth</h6>
                    <p>View members have increased over time.</p>
                    
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>