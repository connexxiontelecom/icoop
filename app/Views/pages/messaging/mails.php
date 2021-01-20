<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Mails
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Mails
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Mails
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-xl-12">
                        <h6 class="sub-title p-3 text-primary text-uppercase">Mails</h6>
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered table-custom spacing5">
                            <tr>
                                <th>
                                    Subject
                                </th>
                                <th>Receiver</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php foreach($mails as $mail) : ?>
                                    <tr>
                                        <td class="w60">
                                            <?= $mail->subject ?>
                                        </td>
                                        <td>
                                            <?= $mail->cooperator_first_name ?>
                                        </td>
                                        <td>
                                            <?= date('d M, Y', strtotime($mail->created_at)) ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="<?= site_url('/messaging/open-mail/'.$mail->mail_id) ?>">Open mail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
       $(document).ready(function(){
           $('.js-example-basic-multiple').select2();
       });
    </script>
<?= $this->endSection() ?>
