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
                                                    <td><?= $customer_name ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Transaction Date</strong>
                                                    </td>                                                    
                                                    <td><?= !is_null($transaction_date) ? date('d M, Y', strtotime($transaction_date)) : '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Account Name</strong>
                                                    </td>                                                    
                                                    <td><?= $account_name ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Account No.</strong>
                                                    </td>                                                    
                                                    <td> <?= $account_no ?? '' ?></td>
                                                </tr>                                           
                                                <tr>
                                                    <td>
                                                        <strong>Amount</strong>
                                                    </td>                                                    
                                                    <td> <?= '₦'.number_format($amount,2) ?? '' ?> 
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