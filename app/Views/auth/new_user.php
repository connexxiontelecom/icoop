<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New User
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New User
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New User
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-steps/jquery.steps.css">
<link rel="stylesheet" href="assets/vendor/dropify/css/dropify.min.css">
<link rel="stylesheet" href="assets/third-party/previewForm/previewForm.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>New User</h2>
				
						</div>
			<div class="body">
				
					<form method="POST" data-persist="garlic">
					
						<fieldset>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-12">
									<div class="form-group">
										<label for="application_staff_id"><b>Username*: </b></label>
										<input type="text"  class="form-control" placeholder="Username *" id="username"  name="username"  required>
									</div>
									<div class="alert alert-danger alert-dismissible" role="alert" id="warning">
										<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<i class="fa fa-warning"></i> Username already taken, Enter a different one
									</div>
									<div class="form-group">
										<label for="application_first_name"><b>First Name*:</b></label>
										<input type="text"  class="form-control" placeholder="First Name *" name="first_name" required>
									</div>
									
									<div class="form-group">
										<label for="application_last_name"><b>Email:</b></label>
										<input type="email"  class="form-control" placeholder="email" name="email" id="email" >
									</div>
									
									<div class="alert alert-danger alert-dismissible" role="alert" id="warning-email">
										<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<i class="fa fa-warning"></i> Email already taken, Enter a different one
									</div>
								
								
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="form-group">
										<label for="application_dob"><b>Password</b></label>
										<input type="text" class="form-control" placeholder="" name="password"  value="password1234" required>
									</div>
									
									<div class="form-group">
										<label for="application_first_name"><b>Last Name*:</b></label>
										<input type="text"  class="form-control" placeholder="Last Name *" name="last_name" required>
									</div>
									<div class="form-group">
										
										<label ><b>Status: </b></label>
										
										<select class="custom-select" required name="user_status">
											
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</div>
									
								
									
								
								
								</div>
							
							</div>
							<div class="row clearfix">
								<div class="col-lg-3 offset-9 col-md-3">
									<div class="form-group">
										<button type="submit" id="submit" class="btn btn-info btn-block" disabled>Submit</button>
									
									
									</div>
								</div>
							</div>
						</fieldset>
					
						<?= csrf_field() ?>
					</form>
				
			</div>
		</div>
	</div>
	
	


</div>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/dropify.js"></script>
<script src="assets/third-party/previewForm/previewForm.js"></script>
<script>
	

    $(document).ready(function(){
       $('#warning').hide();
        $('#warning-email').hide();

        $(function () {
          

            $("#username").keyup(function () {

                let user_name = $(this).val();
                if(user_name.length >= 4){

                    $.ajax({
                        url: '<?php echo site_url('check_user') ?>',
                        type: 'post',
                        data: {
                            'user_name': user_name,
							'type': 1
                        },
                        dataType: 'json',
                        success:function(response){
                           
                            //response = JSON.parse(response);

                            if(jQuery.isEmptyObject(response)){
                                $('#warning').hide();
                                $("#submit").prop('disabled', false);
                            } else{
                                //console.log(response);
                                $('#warning').show();
                                $("#submit").prop('disabled', true);
                            }
                            

                        }
                    });
				} else{
                    $("#submit").prop('disabled', true);
                    
				}

            



            });

            //$("#username").autocomplete(function () {
			//
            //    let user_name = $("#username").val();
            //    if(user_name.length >= 4){
			//
            //        $.ajax({
            //            url: '<?php //echo site_url('check_user') ?>//',
            //            type: 'post',
            //            data: {
            //                'user_name': user_name,
            //                'type': 1
            //            },
            //            dataType: 'json',
            //            success:function(response){
			//
            //                //response = JSON.parse(response);
			//
            //                if(jQuery.isEmptyObject(response)){
            //                    $('#warning').hide();
            //                    $("#submit").prop('disabled', false);
            //                } else{
            //                    //console.log(response);
            //                    $('#warning').show();
            //                    $("#submit").prop('disabled', true);
            //                }
			//
			//
            //            }
            //        });
            //    } else{
            //        $("#submit").prop('disabled', true);
			//
            //    }
			//
			//
			//
			//
			//
            //});

            $("#email").keyup(function () {

                let email = $(this).val();
                    $.ajax({
                        url: '<?php echo site_url('check_user') ?>',
                        type: 'post',
                        data: {
                            'email': email,
                            'type': 2
                        },
                        dataType: 'json',
                        success:function(response){

                            //response = JSON.parse(response);

                            if(jQuery.isEmptyObject(response)){
                                $('#warning-email').hide();
                                $("#submit").prop('disabled', false);
                            } else{
                                //console.log(response);
                                $('#warning-email').show();
                                $("#submit").prop('disabled', true);
                            }


                        }
                    });
               





            });
            
            //$("#email").autocomplete(function () {
			//
            //    let email = $("#email").val();
            //    $.ajax({
            //        url: '<?php //echo site_url('check_user') ?>//',
            //        type: 'post',
            //        data: {
            //            'email': email,
            //            'type': 2
            //        },
            //        dataType: 'json',
            //        success:function(response){
			//
            //            //response = JSON.parse(response);
			//
            //            if(jQuery.isEmptyObject(response)){
            //                $('#warning-email').hide();
            //                $("#submit").prop('disabled', false);
            //            } else{
            //                //console.log(response);
            //                $('#warning-email').show();
            //                $("#submit").prop('disabled', true);
            //            }
			//
			//
            //        }
            //    });
			//
			//
			//
			//
			//
			//
            //});
        });
    });
</script>
<?= $this->endSection() ?>

