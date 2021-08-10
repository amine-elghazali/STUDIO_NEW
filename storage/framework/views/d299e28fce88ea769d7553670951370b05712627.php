


<?php $__env->startSection('content'); ?>
	

<head>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>

<body>
	<!-- main content -->
	<main>
		<div class="container-fluid">
			<div class="row row--grid">
				<!-- title -->
				<div class="col-12">
					<div class="main__title main__title--page">
						<h1>Profile</h1>
					</div>
				</div>
				<!-- end title -->
			</div>

			<div class="row row--grid">
				<div class="col-12">
					<div class="profile">
						<div class="profile__user">
							<div class="profile__avatar">
								<i class="fas fa-user-shield"></i>
							</div>
							<div class="profile__meta">
								<h3 id="userName">John Doe</h3>
								<B>Role :</B><span id="roleName"> </span>
							</div>
						</div>

						<!-- Sing out
						<button class="profile__logout" type="button">
							<span>Sign out</span>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z"/></svg>
						</button> -->
					</div>

					<!-- content tabs -->
					<div class="tab-content">
						<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
							<div class="row row--grid">

								<!-- password form -->
								<div class="col-12 col-lg-6">
									<form action="#" class="sign__form sign__form--profile">
										<div class="row">
											<div class="col-12">
												<h4 class="sign__title">Change profile details</h4>
											</div>

											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label" for="newName">New user name</label>
													<input id="name" type="text" name="newName" class="sign__input">
												</div>
											</div>

											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label" for="newEmail">New email</label>
													<input id="email" type="email" name="newEmail" class="sign__input">
												</div>
											</div>

											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label" for="newPassword">New password</label>
													<input id="password" type="password" name="newPassword" class="sign__input">
												</div>
											</div>

											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label" for="confirmpass">Confirm new password</label>
													<input id="confirmpass" type="password" name="confirmpass" class="sign__input">
												</div>
											</div>


											<div class="col-12">
												<button class="sign__btn" id="changeBtn" type="button">Change</button>
											</div>
										</div>
									</form>
								</div>
								<!-- end password form -->
							</div>
						</div>
					</div>
					<!-- end content tabs -->
				</div>
			</div>	
		</div>
	</main>
	<!-- end main content -->

	<!-- modal top-up -->
	
</body>
<?php $__env->stopSection(); ?>
</html>


<?php $__env->startSection('javascript'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



	<script>
		
		$(document).ready(function() {

					$.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            }
                        });

					$.ajax({
							type : "GET",
							url : "<?php echo e(route('Profile.index')); ?>",
							dataType : 'json',
							success : function(data){
								console.log(data.roleName[0]);
								console.log(data.user)
								
								$('#name').val(data.user.name);
								$('#email').val(data.user.email);
								
							},
							error : function(data){
								console.log('error',data);
							},

						});

			/*$("#show_hide_password a").on('click', function(event) {
				event.preventDefault();
				if($('#show_hide_password input').attr("type") == "text"){
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass( "fa-eye-slash" );
					$('#show_hide_password i').removeClass( "fa-eye" );
				}else if($('#show_hide_password input').attr("type") == "password"){
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass( "fa-eye-slash" );
					$('#show_hide_password i').addClass( "fa-eye" );
				}
			});*/
			
						$("#changeBtn").click(function(e){

							e.preventDefault();

							var name = $('#name').val();
							var email = $('#email').val();
							var password = $('#password').val();
							var confirmpass = $('#confirmpass').val();
							
							var formData = new FormData();
							formData.append('name',name);
							formData.append('email',email); 
							formData.append('password',password); 
							formData.append('confirmpass',confirmpass); 

							//alert(formData);
							
							$.ajax({
								url : "<?php echo e(route('Profile.store')); ?>" ,
								type : "POST",
								dataType : 'json',
								cache:false,
								contentType:false,
								processData:false,
								data:formData,
								success : function(data){
									console.log(data);
									/*Swal.fire({
									position: 'center',
									icon: 'success',
									title: 'Profile updated',
									showConfirmButton: false,
									timer: 1500
									});*/
								},
								error : function(data){
									/*Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'Something went wrong!',
									footer: '<em> Validate the form ! </em>'
									});*/
									console.log('Error:',data);
								},
							});
						});
			
		});


	</script>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Profile/index.blade.php ENDPATH**/ ?>