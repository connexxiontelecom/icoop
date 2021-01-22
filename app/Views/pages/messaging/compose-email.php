<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Compose Email  
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Compose Email
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Compose Email
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
                        <h6 class="sub-title p-3 text-primary text-uppercase">Compose Mail</h6>
                        <form action="<?= site_url('/messaging/compose-email') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                        <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Subject</label>
                                        <input required type="text" name="subject" placeholder="Subject"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">To:</label>
                                        <select name="receivers" id="receivers" class="js-example-basic-multiple form-control">
                                            <option disabled selected>--Select member(s)--</option>
                                            <?php foreach($cooperators as $coop) : ?>
                                                <option value="<?= $coop['cooperator_id'] ?>"><?= $coop['cooperator_first_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Body</label>
                                        <textarea name="message" id="message" style="resize:none;" placeholder="Compose mail here..." class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Send</button>
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
    <script src="/assets/js/select2.min.js"></script>
    <script>
       $(document).ready(function(){
           $('.js-example-basic-multiple').select2();
       });
    </script>
<?= $this->endSection() ?>
