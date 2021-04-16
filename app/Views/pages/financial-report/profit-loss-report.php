<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Profit/Loss 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Profit/Loss 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Profit/Loss
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Profit/Loss</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form action="<?= site_url('/profit-loss') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="input-group mb-3 ml-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">From</span>
                                    </div>
                                    <input type="date" name="from" class="form-control" aria-label="From">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input type="date" name="to" class="form-control" aria-label="To">
                                    <button class="btn  btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="body">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <tr role="row">
                            <th rowspan="2" colspan="1" >S/No.</th>
                            <th rowspan="2" colspan="1" >ACCOUNT CODE</th>
                            <th rowspan="2" colspan="1" >ACCOUNT NAME</th>
                            <th rowspan="2" colspan="1" >DR</th>
                            <th rowspan="2" colspan="1" >CR</th>
                        </tr>
                        <tbody>
                        <?php
                            $a = 1;
                        ?>
                        <?php 
                            $aOPDrTotal = 0;
                            $aOPCrTotal = 0;

                            $aPDrTotal = 0;
                            $aPCrTotal = 0;

                            $aCPCrTotal = 0;
                            $aCPDrTotal = 0;
                            $dr = 0;
                            $cr = 0;
                        ?>
                         <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5">
                                    <strong style="font-size:16px; text-transform:uppercase;">Revenue</strong>
                                </td>
                            </tr>
                             <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 4): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) > 0 ?  number_format((($bfDr + $sumDebit) - ($bfCr + $sumCredit)),2) : 0 ?>
                                            <small style="display: none;">  <?= $aCPDrTotal +=  (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) > 0 ? (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) : 0  ?></small>
                                        </td>
                                        <td class="text-center"><?= (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) < 0 ? number_format((($bfCr + $sumCredit) - ($bfDr + $sumDebit)),2) : 0 ?>
                                            <small style="display: none;">  <?= $aCPCrTotal += (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) < 0 ? (($bfCr + $sumCredit) - ($bfDr + $sumDebit)) : 0 ?></small>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5">
                                    <strong style="font-size:16px; text-transform:uppercase;">Expenses</strong>
                                </td>
                            </tr>
                            <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 5): ?>
                                     <tr role="row" class="odd">
                                    <td class="text-center"><?= $a++ ?></td>
                                    <td class="sorting_1 text-center"><?= $report->glcode ?? '' ?></td>
                                    <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                    <td class="text-center"><?= (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) > 0 ?  number_format((($bfDr + $sumDebit) - ($bfCr + $sumCredit)),2) : 0 ?>
                                        <small style="display: none;">  <?= $aCPDrTotal +=  (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) > 0 ? (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) : 0  ?></small>
                                    </td>
                                    <td class="text-center"><?= (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) < 0 ? number_format((($bfCr + $sumCredit) - ($bfDr + $sumDebit)),2) : 0 ?>
                                        <small style="display: none;">  <?= $aCPCrTotal += (($bfDr + $sumDebit) - ($bfCr + $sumCredit)) < 0 ? (($bfCr + $sumCredit) - ($bfDr + $sumDebit)) : 0 ?></small>
                                    </td>
                                </tr>

                            <?php endif; ?>
                        <?php endforeach; ?>

                        
                        <tr>
                            <td colspan="3" class="text-right">
                            <strong style="font-size:14px; text-transform:uppercase; text-align: right;">Total:</strong></td>
                            <td class="text-center"><?= number_format($aOPDrTotal,2) ?> </td>
                            <td class="text-center"> <?= number_format($aOPCrTotal,2) ?> </td>                        
                        </tr>
                    </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
