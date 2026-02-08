

<!DOCTYPE html>
<html lang="en">
<title>Admin Login</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="data/bootstrap.min.css">
  <script src="data/jquery.min.js"></script>
  <script src="data/bootstrap.min.js"></script>
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



<div class="container">
<div class="row">
   <div class="col-lg-6 col-xs-12  col-lg-offset-3 text-center">
   <div class="login">
   
   <img src="data/logo.png" style="width:300px"><hr>
   
   <div class="login-form">
   
   <div class="form-group">
            <a class="btn btn-primary btn-block" href="<?php echo BASE_PATH;?>/admin/">Admin </a>
			 <a class="btn btn-info btn-block" href="<?php echo BASE_PATH;?>reseller/">Reseller </a>
			  <a class="btn btn-warning btn-block" href="<?php echo BASE_PATH;?>/school/">School </a>
			
        </div>
		
   
   
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
				}	
			}
			
		});
	} );
} );
</script>
