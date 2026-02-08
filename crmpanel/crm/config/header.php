<?php 
$resql=$db->exeQuery("select * from mi_cmp_profile where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
$school=$resql->fetch_assoc();

?>
<!--<div id="preloader">
<div class="text-center loader"><img src="<?php echo BASE_PATH;?>images/loader.gif"/></div>
</div>-->

<style>

#preloader {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}

.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid firebrick;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
<div id="preloader" style="display:none;">
    <div class="spinner"></div>
    <br/>
    Loading...
</div>



	
	<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				<!-- logo start -->
				<div class="page-logo">
					<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
					<span></span>
					</a>
				
				
					<a href="./">
					
						<span class="logo-default">	<img alt="" class="" src="<?php echo BASE_PATH;?>images/cmp_img/<?php echo $school['logo'];?>" style="height:30px"></span> </a>
						
				</div>
				<form id="noti_form" action="<?php echo BASE_PATH;?>All_Noti" method="post">
				<input type="hidden" id="to_date" name="to_date" value="" />
				<input type="hidden" id="fr_date" name="fr_date" value="" />
				
				</form>
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
					<li><a class="fullscreen-btn"><i class="fa fa-window-maximize" aria-hidden="true"></i></a></li>
					<!--<li><a class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>"><input type="text" value="<?php echo date("d-m-Y");?>" /><span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span></a></li>-->
					<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar00">
					<?php 
					$fr_date1=date("Y-m-d");
					$to_date1=date("Y-m-d");
					if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
						$nnoti=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and date(plan_date)>='".date("Y-m-d",strtotime($fr_date1))."' and date(plan_date)<='".date("Y-m-d",strtotime($to_date1))."' and lead_action='Not Completed' and mi_status='Yes'")->num_rows;
					}else{
						$nnoti=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and date(plan_date)>='".date("Y-m-d",strtotime($fr_date1))."' and date(plan_date)<='".date("Y-m-d",strtotime($to_date1))."' and plan_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and lead_action='Not Completed' and mi_status='Yes'")->num_rows;
					}
					//$nnoti=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and plan_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes'")->num_rows;
					//echo $nnoti;
					?>
						<a class="dropdown-toggle input-append date form_date" data-date-format="dd-mm-yyyy" id="notidt" data-date="<?php echo date("Y-m-d");?>" style="padding-top:5px;"><input type="hidden" value="<?php echo date("d-m-Y");?>" id="notidate"  /><span class="add-on"><i class="fa fa-calendar icon-th"></i></span>
							<span class="badge headerBadgeColor1" style="top:-3px;"><?php echo $nnoti;?> </span>
						</a>
						<ul class="dropdown-menu">
						</ul>
					</li>
					<!--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a class="dropdown-toggle" id="showdate" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="fa fa-calendar icon-th"></i>
							<span class="badge headerBadgeColor1"> 6 </span>
						</a>
						<ul class="dropdown-menu">
							<li class="external data-date">
								<a class="dropdown-toggle" data-date-format="dd-mm-yyyy" id="notidt" data-date="<?php echo date("Y-m-d");?>" style="padding-top:7px;"><input type="hidden" value="<?php echo date("d-m-Y");?>" id="notidate"  />
							
								</a>
							</li>
							
						</ul>
					</li>--->
					<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							
								<span class="username username-hide-on-mobile"> <?php echo $school['cmp_name'];?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								
								<li>
									<a href="#support" data-toggle="modal">
										<i class="icon-directions"></i> Support
									</a>
								</li>
								<li class="divider"> </li>
								<li>
									<a href="<?php echo BASE_PATH;?>Change_Password/">
										<i class="icon-lock"></i> Change Password
									</a>
								</li>
								<li>
									<a href="<?php echo BASE_PATH;?>Logout/">
										<i class="icon-logout"></i> Log Out </a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
				<!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
				
			
			</div>
		</div>
		
<div id="support" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-arrow-left" ></i></button>
        <h4 class="modal-title text-center">Microelectra Support</h4>
      </div>
      <div class="modal-body">
        <div style="">
		<center>
		<h4 class="text-primary">Call me @</h4>
		<h4><i class="fa fa-phone"></i> 9899816353</h4>
		<h4><i class="fa fa-phone"></i> 8130576962</h4>
		<br>
		<h4 class="text-primary">Write me @</h4>
		<h4><i class="fa fa-envelope"></i> info@microelectra.in</h4>
		</center>
		</div>
      </div>

    </div>

  </div>
</div>

<script>
$(document).ready(function(){
	/*$("#showdate").on("click",function(){
		//$(".datetimepicker").css("top","32px!important");
		$('#data-date').datetimepicker({
		    weekStart: 1,
		    todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 1,
			minView: 1,
			maxView: 0,
			forceParse: 0
		});
	});*/
	$("body").on("change","#notidate",function(){
		var vd=$(this).val();
		$("#fr_date").val(vd);
		$("#to_date").val(vd);
		$("#noti_form").submit();
		//alert(vd);
	});
});
</script>