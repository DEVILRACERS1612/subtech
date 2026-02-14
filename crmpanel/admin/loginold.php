<?php  
include 'config/config.inc.php';
if(isset($_SESSION['MI_admin_id']) and !empty($_SESSION['MI_admin_id']))
{
header('location:'.BASE_PATH.'Home/');
die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="robots" content="noindex, nofollow">
	<title>MicroSchools.ERP Admin Login </title>
	<!-- google font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
	<!-- icons -->
	<link href="<?php echo BASE_PATH;?>fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo BASE_PATH;?>fonts/material-design-icons/material-icon.css">
	<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/plugins/material/material.min.css">
	<!-- bootstrap -->
	<link href="<?php echo BASE_PATH;?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/pages/extra_pages.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="" />
	<style>
	#preloader{
		position:absolute;
		z-index:99;
		height:100%;
		width:100%;
		background:#f5f5f5;
		opacity:.8;
		display:none;
	}
	.loader img{position:absolute;left:40%;top:25%;height:40%;width:20%;}
	</style>
</head>

<body>
<div id="preloader">
<div class="text-center loader"><img src="<?php echo BASE_PATH;?>images/loader.gif"/></div>
</div>
	<div class="limiter">
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="login-form">
					
					<span class="login100-form-title p-b-34 p-t-27">
						MicroSchools.ERP  <BR/>Admin Log in
					</span>
					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="\f00c"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100 inputpwd100" type="password" name="pass" placeholder="Password">
						<span class="focus-inputpwd100" data-placeholder=""></span>
					</div>
					<div class="contact100-form-checkbox">
						<!--<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
						<label class="control-label text-white" id="msg"> </label>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">Login</button>
					</div>
					<div class="text-center p-t-30">
						<a class="txt1" href="<?php echo BASE_PATH;?>forgot_password/">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- bootstrap -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/extra-pages/pages.js"></script>
	<!-- end js include path -->
</body>
</html>
<script>
$(document).ready(function(){
	$("#login-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Login/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#msg").html(response.message);
					setTimeout(function(){window.location.reload(true);},500);
				}
				else
				{
					$("#msg").html(response.message);
				}	
			}
			
		});
	} );
} );
</script>