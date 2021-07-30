<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
GL Extract Details
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
GL Extract Details
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
GL Extract Details
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
<style>
	<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
	
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
				<h2>GL Extract</h2>
			</div>
		
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="body">
			<div class="table-responsive">
				<?php
					$_from = date("M j, Y", strtotime($from));
					$_to = date("M j, Y", strtotime($to));
				?>
				
				<button id="btnExport" onclick="fnExcelReport();"> EXPORT </button>
				
				<table id="glextract" class="table table-bordered js-basic-example dataTable simpletable table-custom spacing5">
					
					<thead>
					<tr role="row">
						<th colspan="9" style="text-align: center;" ><h3> Extract Between <?=$_from." - ".$_to; ?></h3> <h4><?=$account_details['glcode'] ?> - <?=$account_details['account_name']; ?></h4>  </th>
					</tr>
					
					<tr role="row">
						<th>S/No.</th>
						<th>Date</th>
						<th style="width: 200px;">Narration</th>
						<th style="width: 200px;">Description</th>
						<th style="width: 200px; text-align: right">DR </th>
						<th style="width: 200px; text-align: right">CR</th>
						
					</tr>
					
					</thead>
					<tbody>
					<?php
						$i =1;
					?>
					
					<tr>
						<td><?=$i++; ?></td>
						<td> </td>
						<td> </td>
						<td><h5> B/F</h5>  </td>
						
						<td style="text-align: right"> <?=number_format($ob['obdr'], 2); ?> </td>
						<td style="text-align: right"> <?=number_format($ob['obcr'], 2); ?> </td>
					
					</tr>
					
				
							
						<?php
							
							foreach ($pb_details as $detail):
					?>
								<tr>
									<td><?=$i++; ?></td>
									<td><?=$detail['gl_transaction_date'] ?> </td>
									<td><?=$detail['narration'] ?> </td>
									<td><?=$detail['gl_description'] ?>  </td>
								
									<td style="text-align: right"> <?=number_format($detail['dr_amount'], 2); ?> </td>
									<td style="text-align: right"> <?=number_format($detail['cr_amount'], 2); ?> </td>
								
								</tr>
					
					<?php endforeach; ?>
					
					</tbody>
				</table>
				
				<iframe id="txtArea1" style="display:none"></iframe>
			
			</div>
		</div>
	</div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script>
	function fnExcelReport()
	{
		var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
		var textRange; var j=0;
		tab = document.getElementById('glextract'); // id of table
		
		for(j = 0 ; j < tab.rows.length ; j++)
		{
			tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
			//tab_text=tab_text+"</tr>";
		}
		
		tab_text=tab_text+"</table>";
		tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
		tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
		tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
		
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");
		
		if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
		{
			txtArea1.document.open("txt/html","replace");
			txtArea1.document.write(tab_text);
			txtArea1.document.close();
			txtArea1.focus();
			sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
		}
		else                 //other browser not tested on IE 11
			sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
		
		return (sa);
	}
	$(document).ready(function(){
		$('.simpletable').DataTable();
	});
</script>
<?= $this->endSection() ?>
