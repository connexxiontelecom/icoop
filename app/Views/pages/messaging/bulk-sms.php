<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Bulk SMS
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Bulk SMS
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Bulk SMS
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/select2.min.css" rel="stylesheet">
<link href="/assets/css/parsley.min.css" rel="stylesheet">
<link href="/assets/css/toastify.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="/assets/css/toastify.min.css"/>
<link rel="stylesheet" href="/assets/css/datatable.min.css"/>
<style>
	label{
		font-weight: bold;
	}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    
                    <div class="col-lg-8 col-xl-8">
                        <h6 class="sub-title p-3 text-primary text-uppercase">Compose SMS</h6>
                        <form action="<?= site_url('/messaging/bulk-sms') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">Sender ID</label>
                                <input type="text" name="sender_id" placeholder="Sender ID" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Receivers</label>
                                <textarea name="receivers" placeholder="Enter contacts here. Separate with comma." id="receivers" style="resize:none;" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="message" rows="10" placeholder="Type message here..." id="message" style="resize:none;" class="form-control"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
	
				<div class="row m-b-30">
		
				
					<div class="col-lg-12 col-xl-12">
						<h6 class="sub-title p-3 text-primary text-uppercase">Bulk SMS</h6>
						<div class="table-responsive">
							<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
							
							<thead>
								<tr>
									
									<th>
										Sender ID
									</th>
									<th>Receiver</th>
									<th>Message</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
					            <?php foreach($sms as $sm) : ?>
									<tr>
										<td><?= $sm['sender_id'] ?></td>
										<td><?= $sm['receivers'] ?></td>
										<td><?= $sm['message'] ?></td>
										<td>
											<a href="" class="btn btn-sm btn-primary">Learn more</a>
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
<script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
<script src="/assets/js/parsley.min.js"></script>
<script src="/assets/js/toastify.min.js"></script>

<script src="/assets/js/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/select2.min.js"></script>
    <script>
       $(document).ready(function(){
           $('.js-example-basic-multiple').select2();
       });
    </script>
<?= $this->endSection() ?>
