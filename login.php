<?php include_once('db.php');
session_start(); 

if (isset($_SESSION["member_id"]))
{
	header('location:index.php');
}
?>
	

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<!-- Bootstrap Data Tables -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css">
   <!-- For the group by rows... -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

   <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel = "stylesheet" href = "https://cdn.datatables.net/1.10.19/css/DataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="assets/bootstrap-table.min.css" rel = "stylsheet"/>

</head>

<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(bg-01.jpg);">
					<span class="login100-form-title-1">
						Member Login
					</span>
				</div>

				<form action="login.php" method = "POST" id = "teacher-login-form" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span for="username" class="label-input100 mt-4">Username</span>
						<input class="input100 mt-3" type="text" placeholder="Enter username" name = "t_username" id = "t_username" class="form-control">
						<span class="focus-input100 text-danger" id = "error_t_username" ></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100 mt-4" for="password">Password</span>
						<input class="input100 mt-3" type="password" placeholder="Enter password" name = "t_password" id = "t_password" class = "form-control" >
						<span class="focus-input100 text-danger" id = "error_t_password" ></span>
					</div>

					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							<input type="submit" name = "teacher_login" id = "teacher_login" class = "btn text-white" value = "Login" />
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	
	<script src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function(){
		$("#teacher-login-form").on('submit', function(e){
			e.preventDefault(); 
			$.ajax({
				url: 'check_login.php',
				method: 'POST',
				data: $(this).serialize(), 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#teacher_login').val('Validating...');
					$('#teacher_login').attr('disabled', true); 
				},
				success: function(data)
				{	
					if (data.success)
					{
						location.href="index.php"; 
					}
					if (data.error)
					{
						$('#teacher_login').val('Login');
						$('#teacher_login').attr('disabled', false);
						if (data.error_teacher_username != '')
							$('#error_t_username').text(data.error_teacher_username); 
						else 
							$('#error_t_username').text('');
						if (data.error_teacher_password != '')
						{
								$('#error_t_password').text(data.error_teacher_password); 
						}
						else 
							$('#error_t_password').text(''); 
					}	
				}
			});
		});
	});
</script>
</body>
</html>