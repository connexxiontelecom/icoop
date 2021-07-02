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
			
			
			<div class="body">
				
					
					<form method="POST" action="<?= site_url('trial-balance') ?>" enctype="multipart/form-data">
						
						<fieldset>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-12">
									
									
									
									
									<div class="form-group">
										
										
										<label>Range</label>
										<div class="input-daterange input-group">
											<input type="date" class="input-sm form-control" name="from">
											<span class="input-group-addon range-to">to</span>
											<input type="date" class="input-sm form-control" name="to">
										</div>
									
									</div>
									
									<?= csrf_field() ?>
									<div class="form-group">
										<button type="submit" class="btn btn-info">Retrieve</button>
									</div>
								</div>
							
							
							</div>
						</fieldset>
					
					
					</form>
				
			
			</div>
		
		
		
		
		</div>
		
		
	</div>
	
 
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
