<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Trial Balance 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Trial Balance 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Trial Balance
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
                <h2>Trial Balance</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form action="<?= site_url('trial-balance') ?>" method="post">
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
                            <th colspan="2" rowspan="1" class="text-center">OPENING PERIOD</th>
                            <th rowspan="2" colspan="1" >DR</th>
                            <th rowspan="2" colspan="1" >CR</th>
                            <th colspan="2" rowspan="1" class="text-center">CLOSING PERIOD</th>
                        </tr>
                        <tr role="row">
                            <th rowspan="1" colspan="1" >DR</th>
                            <th rowspan="1" colspan="1" >CR</th>
                            <th rowspan="1" colspan="1" >DR</th>
                            <th rowspan="1" colspan="1" >CR.</th>
                        </tr>
                        <tbody>
                        <?php
                            $a = 1;
                        ?>
                        <tr role="row" class="odd">
                            <td  colspan="9"><strong style="font-size:16px; text-transform:uppercase;">Assets</strong></td>
                        </tr>
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
                        <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 1): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= $bfDr - $bfCr > 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPDrTotal += ($bfDr - $bfCr) > 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= $bfDr - $bfCr < 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPCrTotal += ($bfDr - $bfCr) < 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumDebit ,2)?? 0 ?>
                                            <small style="display: none;">  <?= $aPDrTotal += $sumDebit ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumCredit,2) ?? 0 ?>
                                            <small style="display: none;">  <?= $aPCrTotal += $sumCredit ?></small>
                                        </td>
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
                            <td class="sorting_1"  colspan="9">
                                <strong style="font-size:16px; text-transform:uppercase;">Liability</strong>
                            </td>
                        </tr>
                        <?php
                            $l_opdr = 0;
                            $l_opcr = 0;
                        ?>
                         <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 2): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= $bfDr - $bfCr > 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPDrTotal += ($bfDr - $bfCr) > 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= $bfDr - $bfCr < 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPCrTotal += ($bfDr - $bfCr) < 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumDebit ,2)?? 0 ?>
                                            <small style="display: none;">  <?= $aPDrTotal += $sumDebit ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumCredit,2) ?? 0 ?>
                                            <small style="display: none;">  <?= $aPCrTotal += $sumCredit ?></small>
                                        </td>
                                            <small style="display: none;">  <?php $l_opdr = ($bfDr - $bfCr) > 0 ? (($bfDr - $bfCr) + $sumDebit) : 0  ?></small>
                                            <small style="display: none;">  <?php $l_opcr = ($bfDr - $bfCr) < 0 ? (($bfDr - $bfCr) + $sumCredit) : 0  ?></small>
                                        <td class="text-center"><?= $l_opdr - $l_opcr > 0 ? number_format($l_opdr - $l_opcr,2) : 0 ?>
                                        </td>
                                        <td class="text-center"><?=  $l_opdr - $l_opcr < 0 ? number_format($l_opdr - $l_opcr,2) : 0 ?>
                                           
                                        </td>
                                    </tr>
                              <?php endif; ?>
                            <?php endforeach; ?>
                             <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="9">
                                    <strong style="font-size:16px; text-transform:uppercase;">Equity</strong>
                                </td>
                            </tr>
                            <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 3): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= $bfDr - $bfCr > 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPDrTotal += ($bfDr - $bfCr) > 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= $bfDr - $bfCr < 0 ? number_format($bfCr - $bfDr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPCrTotal += ($bfDr - $bfCr) < 0 ? ($bfCr - $bfDr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumDebit ,2)?? 0 ?>
                                            <small style="display: none;">  <?= $aPDrTotal += $sumDebit ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumCredit,2) ?? 0 ?>
                                            <small style="display: none;">  <?= $aPCrTotal += $sumCredit ?></small>
                                        </td>
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
                                <td class="sorting_1"  colspan="9">
                                    <strong style="font-size:16px; text-transform:uppercase;">Revenue</strong>
                                </td>
                            </tr>
                             <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 4): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= $bfDr - $bfCr > 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPDrTotal += ($bfDr - $bfCr) > 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= $bfDr - $bfCr < 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPCrTotal += ($bfDr - $bfCr) < 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumDebit ,2)?? 0 ?>
                                            <small style="display: none;">  <?= $aPDrTotal += $sumDebit ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumCredit,2) ?? 0 ?>
                                            <small style="display: none;">  <?= $aPCrTotal += $sumCredit ?></small>
                                        </td>
                                        <td class="text-center"><?= ($bfDr - $bfCr) > 0 ?  number_format($bfDr + $bfCr)  : 0 ?>
                                            <small style="display: none;">  <?= $aCPDrTotal += $bfDr - $bfCr > 0 ? ($bfDr - $bfCr) : 0  ?></small>
                                        </td>
                                        <td class="text-center"><?= ($bfDr - $bfCr) < 0 ? number_format($bfDr - $bfCr) : 0 ?>
                                            <small style="display: none;">  <?= $aCPCrTotal += $bfDr - $bfCr < 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="9">
                                    <strong style="font-size:16px; text-transform:uppercase;">Expenses</strong>
                                </td>
                            </tr>
                            <?php foreach($reports as $report): ?>
                            <?php if($report->account_type == 5): ?>
                                    <tr role="row" class="odd">
                                        <td class="text-center"><?= $a++ ?></td>
                                        <td class="sorting_1 text-center"><?= $report->glcode ?? ''?></td>
                                        <td class="text-center"><?= $report->account_name ?? '' ?></td>
                                        <td class="text-center"><?= $bfDr - $bfCr > 0 ? number_format($bfDr - $bfCr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPDrTotal += ($bfDr - $bfCr) > 0 ? ($bfDr - $bfCr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= $bfDr - $bfCr < 0 ? number_format($bfCr - $bfDr,2) : 0 ?>
                                            <small style="display: none;">  <?= $aOPCrTotal += ($bfDr - $bfCr) < 0 ? ($bfCr - $bfDr) : 0 ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumDebit ,2)?? 0 ?>
                                            <small style="display: none;">  <?= $aPDrTotal += $sumDebit ?></small>
                                        </td>
                                        <td class="text-center"><?= number_format($sumCredit,2) ?? 0 ?>
                                            <small style="display: none;">  <?= $aPCrTotal += $sumCredit ?></small>
                                        </td>
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
                            <td class="text-center"> <?= number_format($aPDrTotal,2) ?> </td>
                            <td class="text-center"> <?= number_format($aPCrTotal,2) ?> </td>
                            <td class="text-center"> <?= number_format($aCPDrTotal,2) ?></td>
                            <td class="text-center"> <? number_format($aCPCrTotal,2) ?></td>
                        </tr>
                    </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
