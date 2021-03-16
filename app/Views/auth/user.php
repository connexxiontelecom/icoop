<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
User - <?=$user['first_name'].' '.$user['last_name'];  ?>

<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
User - <?=$user['first_name'].' '.$user['last_name'];  ?>
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
User - <?=$user['first_name'].' '.$user['last_name'];  ?>
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>




<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>User - <?=$user['first_name'].' '.$user['last_name'];  ?></h2>
				<button style="float: right" type="button" class="btn btn-primary" onclick="edit()" > <i class="fa fa-pencil"></i> Edit</button>
			
			</div>
			<div class="body">
				
				<form method="POST" id="user_form" data-persist="garlic">
					
						<fieldset>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-12">
									<div class="form-group">
										<label for="application_staff_id"><b>Username*: </b></label>
										<input type="text"  class="form-control" placeholder="Username *" id="username"  name="username" disabled readonly value="<?=$user['username'] ?>" required>
									</div>
									
									<div class="form-group">
										<label for="application_first_name"><b>First Name*:</b></label>
										<input type="text"  class="form-control" placeholder="First Name *" name="first_name" disabled value="<?=$user['first_name'] ?>" required>
									</div>
									
									<div class="form-group">
										<label for="application_last_name"><b>Email:</b></label>
										<input type="email"  class="form-control" placeholder="email" name="email" value="<?=$user['email'] ?>" disabled id="email" >
									</div>
								
								
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="form-group">
										<label for="application_dob"><b>Password</b></label>
										<input type="text" class="form-control" placeholder="" name="password"   disabled>
										
										<div class="alert alert-warning alert-dismissible" role="alert" id="warning-password">
											<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
											<i class="fa fa-warning"></i> Leave password field blank if you do not intend to change password
										</div>
									</div>
									<input type="hidden" name="user_id" value="<?=$user['user_id']; ?>">
									<div class="form-group">
										<label for="application_first_name"><b>Last Name*:</b></label>
										<input type="text"  class="form-control" placeholder="Last Name *"  disabled  value="<?=$user['last_name'] ?>" name="last_name" required>
									</div>
									<div class="form-group">
										
										<label ><b>Status: </b></label>
										
										<select class="custom-select" required name="user_status">
											
											<option value="1" <?php if($user['user_status'] == 1): echo 'selected'; endif; ?>> Active</option>
											<option value="0" <?php if($user['user_status'] == 0): echo 'selected'; endif; ?>>Inactive</option>
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

<script>

    function edit() {
     	let master_inputs = $("#user_form").find("select, input");
        let index;
        for (index = 0; index < master_inputs.length; ++index) {
            master_inputs[index].disabled = false;
        }
        $("#submit").prop('disabled', false);
     }
    
    
    
    $(document).ready(function(){
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
            

        });
    });
</script>
<?= $this->endSection() ?>

