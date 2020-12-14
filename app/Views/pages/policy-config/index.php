<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Policy Config  
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <h5 class="sub-title">Policy Config</h5>
            <div class="row m-b-30">
                <div class="col-lg-12 col-xl-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Profile</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Savings Rate</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Saving GL Config</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Loan Setup</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="home3" role="tabpanel">
                            <form action="">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Coop Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Coop Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <input type="file" name="logo" class="form-control-file" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Authorized Signatory 1:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Authorized Signatory 1" name="authorized_signatory_1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Authorized Signatory 2:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Authorized Signatory 2" name="authorized_signatory_2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Authorized Signatory 3:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Authorized Signatory 3" name="authorized_signatory_3">
                                </div>
                            </div>
                            <div class="row form-group d-flex justify-content-center">
                                <button class="btn-mini btn btn-primary"><i class="ti-check mr-2"></i> Save</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="profile3" role="tabpanel">
                        <form action="">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Minimum saving</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" placeholder="Minimum saving" name="minimum_saving">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Registration Fee</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" placeholder="Registration Fee" name="registration_fee">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Savings Interest Rate</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" placeholder="Savings Interest Rate" name="savings_interest_rate">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Savings Withdrawal Charge</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" placeholder="Savings Withdrawal Charge" name="savings_withdrawal_charge">
                                </div>
                            </div>
                           
                            <div class="row form-group d-flex justify-content-center">
                                <button class="btn-mini btn btn-primary"><i class="ti-check mr-2"></i> Save</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="messages3" role="tabpanel">
                        <form action="">
                            <table class="table table-stripped">
                                
                                    <thead>
                                        <th></th>
                                        <th>DR</th>
                                        <th>CR</th>
                                    </thead>
                                    <tr>
                                        <td>
                                            Contribution (Payroll)
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Contribution (External)
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Withdrawal
                                        </td>
                                        
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Registration Fee
                                        </td>
                                        
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Income on Savings Withdrawal Charge
                                        </td>
                                        
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <select name="contribution" class="form-control" id="contribution">
                                                    <option disabled selected>Select GL</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                            </table>   
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save</button>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane" id="settings3" role="tabpanel">
                            <p class="m-0">4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    
    <script>
        $(document).ready(function(){
           

            
        });
    </script>
<?= $this->endSection() ?>