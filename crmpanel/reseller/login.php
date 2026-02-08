<?php  
include 'config/config.inc.php';
if(isset($_SESSION[SITE_NAME]['MI_reseller_id']) and !empty($_SESSION[SITE_NAME]['MI_reseller_id']))
{
	header('location:'.BASE_PATH.'Home/');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Reseller Login</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="<?php echo BASE_PATH;?>data/bootstrap.min.css">
  <script src="<?php echo BASE_PATH;?>data/jquery.min.js"></script>
  <script src="<?php echo BASE_PATH;?>data/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<style>
body{background:#eaeaea; }
.login{min-height:200px;background:#fff;margin-top:2%;padding:15px 10px; text-align:center;     box-shadow: 0px 0px 4px 4px #d8cdcd;}
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
	
.login-form {
    width: 340px;
    margin: 20px auto;
}

h3{margin-top: 5px;
    margin-bottom: 5px;}

@media only screen and (min-width: 280px) and (max-width: 600px) 
{
	.login>h3{font-size:12px;}

}



</style>
</head>


<body style="background: url(http://royalapart.xpertedu.in/images/home_bg.jpg) center no-repeat;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
     box-sizing: border-box;">

<div id="preloader">
<div class="text-center loader"><img src="<?php echo BASE_PATH;?>images/loader.gif"/></div>
</div>


<div class="container">
<div class="row">
   <div class="col-lg-6 col-xs-12  col-lg-offset-3 text-center">
   <div class="login">
   
   <img src="<?php echo BASE_PATH;?>data/logo.png" style="width:300px"><hr>
   <h3>Reseller Login </h3>
   <div class="login-form">
    <form id="login-form">
		<input type="hidden" name="method" value="RSL" />
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
        <label class="control-label" id="msg"> </label>
        <div class="form-group text-left">
		<label>Username</label>
            <input autocomplete="nope" type="text" name="username" class="form-control"  required="required">
        </div>
        <div class="form-group text-left">
		<label>Password</label>
            <input autocomplete="nope" type="password" name="pass" class="form-control" autocomplete="off" required="required">
        </div>
		   <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="<?php echo BASE_PATH;?>forgot_password/" class="pull-right"><i class="fa fa-lock"></i> Forgot Password?</a>
        </div>    <br>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Login</button>
			
        </div>
         
    </form>
    <p class="text-center"><a href="#">Create an Account</a></p>
	<small>By signin automatically accept our <a href="">terms & conditions</a></small>
</div>



   
   
   
   
   


<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Register a new school</a>
</div>


  
  
  
   
   </div>
   </div>
</div>
</div>



	


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
					setTimeout(function(){$("#msg").html("");},10000);
				}	
			}
			
		});
	} );
} );
</script>
