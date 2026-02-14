<?php  
include 'config/config.inc.php';
if(isset($_SESSION[SITE_NAME]['MICMP_cmpid']) and !empty($_SESSION[SITE_NAME]['MICMP_cmpid']))
{
header('location:'.BASE_PATH.'Home/');
die();
}
$cmp_id=(isset($_GET['cmpid']) and !empty($_GET['cmpid']))?$db->filterVar($_GET['cmpid']):'';
$lql=$db->exeQuery("select * from mi_cmp_profile where cmp_id='".$cmp_id."' and mi_status='Yes'");
if($lql->num_rows)
{
    $logrow=$lql->fetch_assoc();
}else{
    $error='Invalid Link';
    header('Refresh:2;url=https://www.microelectra.in/crmpanel/');
}
?>


<!DOCTYPE html>
<html lang="en">
<title>Main Login</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
 <link rel="stylesheet" href="<?php echo BASE_PATH;?>data/bootstrap.min.css">
  <script src="<?php echo BASE_PATH;?>data/jquery.min.js"></script>
  <script src="<?php echo BASE_PATH;?>data/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<style>
body{
	
	display: flex;
    -ms-flex-align: center;
    -ms-flex-pack: center;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5; }
.login{min-height:200px;background:#fff;padding:15px 10px; text-align:center;     box-shadow: 0px 0px 4px 4px #d8cdcd;}
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
    
	width: 100%;
    max-width: 380px;
       padding: 0px 15px 15px 15px;
    margin: 0 auto;
	
}

h3{margin-top: 5px;
    margin-bottom: 5px;}

@media only screen and (min-width: 280px) and (max-width: 600px) 
{
	.login>h3{font-size:12px;}
}


.login .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.login .form-control:focus {
  z-index: 2;
}

.login input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.login input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


</style>
</head>


<body style="">

<div id="preloader">
<div class="text-center loader"><img src="<?php echo BASE_PATH;?>images/loader.gif"/></div>
</div>



   <div class=" text-center">
   <div class="login" style="padding-top:25px;">
   <?php 
   if($logrow['logo']!='')
   {
       echo '
        <img src="'.BASE_PATH.'images/cmp_img/'.$logrow['logo'].'" style="height:65px;width:280px;">';
   }else{
       echo '<div class="text-danger">'.$error.'</div>';
   }
   echo '<h4 style="padding-bottom:0px;">Login</h4><hr>';

   ?>
   
   <!--<h3>'.$logrow['cmp_name'].'</h3>-->
   <div class="login-form">
    <form id="login-form">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
        <input type="hidden" name="cmp_id" value="<?php echo $cmp_id;?>" />
		<input type="hidden" name="method" value="SchL" />
        
		<label class="control-label" id="msg"> </label>
        
		
		<label for="inputEmail" class="sr-only">Username</label>
      <input autocomplete="nope" type="text" name="username" class="form-control" placeholder="Username" maxlength="30" required="required">
      <label for="inputPassword" class="sr-only">Password</label>
      <input autocomplete="nope" type="password" name="pass" class="form-control" maxlength="30" placeholder="Password" autocomplete="off" required="required">
	  
	  
		
		  
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </div>
         
    </form>
	<p><small>By signin automatically accept our <a href="">terms & conditions</a></small></p>
	<?php
	/*$q=$db->exeQuery("select * from mi_sms_setting where cmp_id='".$cmp_id."' and mi_status='Yes'");
	
	if($q->num_rows)
	{
		$r=$q->fetch_assoc();
		$pg=explode(",",$r['page_code']);
		if(in_array("login_page",$pg))
		{
			echo '<p class="pull-left"><a href="#login_otp" data-toggle="modal" ><i class="fa fa-mobile"></i> Login with OTP</a></p>';
		}
	}*/
	?>
    <p class="pull-right"><a href="#"><i class="fa fa-lock"></i> Forgot password</a></p>
	
	
</div>
<!--<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Register a new school</a>
</div>-->


   </div>
   </div>

</body>
</html>

<script>
$(document).ready(function(){
    //alert("ok");
	$("#login-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		// alert("okkk");
		$.ajax({
			url:'<?php echo BASE_PATH;?>/Controller/Login/',
			type:'POST',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
			   //alert(data);
				$('#preloader').hide();
				
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#msg").html(response.message);
					setTimeout(function(){window.location.reload(true);},500);
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html("");},2000);
				}
			}
		});
	} );
	/////////////////////////////
	$("#otp").hide();
	$("#umobile").on("keyup",function(e){
		var l=$(this).val();
		if(l.length>9)
		{
			$("#uerror").html("<span class='text-danger'>OTP is sending to your Mobile...</span>");
			$("#umobile").prop("readonly",true);
			$("#preloader").show();			
			var datastr="post_id=<?php echo $post_id;?>&cmp_id=<?php echo $cmp_id;?>&mobile="+l+"&method=sendotp";
			$.ajax({
				url:'<?php echo BASE_PATH;?>Controller/Login/',
				type:'POST',
				data:datastr,
				success:function(data){
					$('#preloader').hide();
					var response=(JSON.parse(data));
					if(response.type=="success")
					{	
						$("#umobile").prop("readonly",true);
						$("#uerror").html(response.message);
						setTimeout(function(){$("#uerror").html("");},1500);
						$("#otp").show();
						$("#otp").focus();
					}else{
						$("#umobile").prop("readonly",false);
						$("#uerror").html(response.message);
						//setTimeout(function(){$("#msg").html("");},2000);
					}
				}
				
			});
		}else{
			$("#uerror").html("<span class='text-danger'>Enter Valid Mobile Number</span>");
		}
	});
	$("#login-otp-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		// alert("okkk");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Login/',
			type:'POST',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
			   //alert(data);
				$('#preloader').hide();
				
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#omsg").html(response.message);
					setTimeout(function(){window.location.reload(true);},500);
				}
				else
				{
					$("#omsg").html(response.message);
					setTimeout(function(){$("#omsg").html("");},2000);
				}
			}
		});
	} );
	
} );
</script>
<!-- Add New -->
<div class="modal fade" id="login_otp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel"><b>Login with OTP</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="login-otp-form" autocomplete="off">
			<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
			<input type="hidden" name="cmp_id" value="<?php echo $cmp_id;?>" />
			<input type="hidden" name="method" value="otp-login" />
			
			
			
			
			<label for="mobile" class="sr-onlys">Enter Registered Mobile</label>
			<input type="text" id="umobile" name="mobile" class="form-control" placeholder="Mobile Number" maxlength="10" onkeypress="return isNumber(event);" required="required">
			<label class="control-label" id="uerror"> </label>
			<br>
			<label for="otp" class="sr-only">Enter OTP</label>
			<input type="text" id="otp" name="otp" class="form-control" maxlength="6" placeholder="Enter OTP" required="required">
		  <br>
		  
			
			<div id="omsg"> </div>  
			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Login</button>
			</div>
			 
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode==46 ||charCode==43 ||charCode==45 ){return true;}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
	}
	</script>