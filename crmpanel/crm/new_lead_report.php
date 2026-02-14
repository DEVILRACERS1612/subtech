<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.product.php';
include 'Model/class.user.php';
include 'Model/class.enquiry_status.php';

$page="new-lead-report";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
?>
<!DOCTYPE html>
<html lang="en">
	<title>New Lead Report</title>
<head>
<?php include 'config/head.php';?>

</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
<div class="page-wrapper">
<!-- start header -->
<?php include 'config/header.php';?>
<!-- end header -->

<div class="page-container">
<!-- start sidebar menu -->
<?php include 'config/leftmenu.php';?>
<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
<div class="col-md-12">
<div class="tabbable-line">
	
	<div class="tab-content" style="padding:0;">
		<div class="tab-pane active fontawesome-demo" id="tab1">
			<div class="row">
				<div class="col-md-12">
	<div class="card card-box">
		<div class="card-head">
			<header> Lead Report</header>
			<!---<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
				<a href="<?php echo BASE_PATH;?>Add_Lead/" id="addRow" class="btn btn-primary">
					Add New Lead <i class="fa fa-plus"></i>
				</a>
			</div>--->
		</div>
		<div class="card-body ">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-6">
					<?php echo $error;?>
				</div>
				<div class="col-md-6 col-sm-6 col-6">
				</div>
			</div>
			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTablexx">
					<thead>
						<tr>
							<th> S.N.</th>
							
							<th> A/C Manager</th>
							<?php
							for($i=15;$i>=0;$i--){
							echo '<th class="text-center">';
							echo date('D',strtotime(date("Y-m-d")."-".$i." day"));
							echo '<br/>';
							echo date('d',strtotime(date("Y-m-d")."-".$i." day"));
							echo '</th>';
							}
							?>
							<!--<th class="text-center"> <?php echo date('D\<\b\\r\>d',strtotime(date("Y-m-d")."-15 day"));?> </th>
							<th class="text-center"> <?php echo date("D \<\b\\r\>d");?> </th>-->
							
							<th class="text-center"> Total </th>
						</tr>
					</thead>
					<tbody id="displaydata">
				<?php

				$jnrow=$db->exeQuery("select * from mi_emp_juniors where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes'")->fetch_assoc();
				
				$juniors=implode("','",explode(",",$jnrow['juniors']));
				//"SELECT a.user_id, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -15 DAY)) and user_id=a.user_id) as 15d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -14 DAY)) and user_id=a.user_id) as 14d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -13 DAY)) and user_id=a.user_id) as 13d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -12 DAY)) and user_id=a.user_id) as 12d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -11 DAY)) and user_id=a.user_id) as 11d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -10 DAY)) and user_id=a.user_id) as 10d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -9 DAY)) and user_id=a.user_id) as 9d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -8 DAY)) and user_id=a.user_id) as 8d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -7 DAY)) and user_id=a.user_id) as 7d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -6 DAY)) and user_id=a.user_id) as 6d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -5 DAY)) and user_id=a.user_id) as 5d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -4 DAY)) and user_id=a.user_id) as 4d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -3 DAY)) and user_id=a.user_id) as 3d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -2 DAY)) and user_id=a.user_id) as 2d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -1 DAY)) and user_id=a.user_id) as 1d, (select count(*) from mi_lead where enq_date=DATE(NOW()) and user_id=a.user_id) as tday FROM `mi_lead` a  WHERE cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and user_id in ('".$juniors."') and mi_status='Yes' group by user_id"
				
				if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
					$qr=$db->exeQuery("SELECT a.user_id, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -15 DAY)) and user_id=a.user_id) as 15d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -14 DAY)) and user_id=a.user_id) as 14d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -13 DAY)) and user_id=a.user_id) as 13d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -12 DAY)) and user_id=a.user_id) as 12d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -11 DAY)) and user_id=a.user_id) as 11d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -10 DAY)) and user_id=a.user_id) as 10d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -9 DAY)) and user_id=a.user_id) as 9d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -8 DAY)) and user_id=a.user_id) as 8d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -7 DAY)) and user_id=a.user_id) as 7d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -6 DAY)) and user_id=a.user_id) as 6d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -5 DAY)) and user_id=a.user_id) as 5d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -4 DAY)) and user_id=a.user_id) as 4d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -3 DAY)) and user_id=a.user_id) as 3d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -2 DAY)) and user_id=a.user_id) as 2d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -1 DAY)) and user_id=a.user_id) as 1d, (select count(*) from mi_lead where enq_date=DATE(NOW()) and user_id=a.user_id) as tday FROM `mi_lead` a  WHERE cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes' group by user_id");
				}else{
					$qr=$db->exeQuery("SELECT a.user_id, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -15 DAY)) and user_id=a.user_id) as 15d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -14 DAY)) and user_id=a.user_id) as 14d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -13 DAY)) and user_id=a.user_id) as 13d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -12 DAY)) and user_id=a.user_id) as 12d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -11 DAY)) and user_id=a.user_id) as 11d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -10 DAY)) and user_id=a.user_id) as 10d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -9 DAY)) and user_id=a.user_id) as 9d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -8 DAY)) and user_id=a.user_id) as 8d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -7 DAY)) and user_id=a.user_id) as 7d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -6 DAY)) and user_id=a.user_id) as 6d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -5 DAY)) and user_id=a.user_id) as 5d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -4 DAY)) and user_id=a.user_id) as 4d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -3 DAY)) and user_id=a.user_id) as 3d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -2 DAY)) and user_id=a.user_id) as 2d, (select count(*) from mi_lead where enq_date=DATE(DATE_ADD(NOW(), INTERVAL -1 DAY)) and user_id=a.user_id) as 1d, (select count(*) from mi_lead where enq_date=DATE(NOW()) and user_id=a.user_id) as tday FROM `mi_lead` a  WHERE cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and user_id in ('".$juniors."') and mi_status='Yes' group by user_id");
				}
				
				$i=1;
				$d15=0; $d14=0; $d13=0; $d12=0; $d11=0; $d10=0;$d9=0;$d8=0;$d7=0;$d6=0;$d5=0;$d4=0;$d3=0;$d2=0;$d1=0;$d0=0;
				$tot=0;$ntot=0;
				while($row=$qr->fetch_assoc())
				{
					$d15+=$row['15d'];$d14+=$row['14d'];$d13+=$row['13d'];$d12+=$row['12d'];$d11+=$row['11d'];$d10+=$row['10d'];$d9+=$row['9d'];$d8+=$row['8d'];$d7+=$row['7d'];$d6+=$row['6d'];$d5+=$row['5d'];$d4+=$row['4d'];$d3+=$row['3d'];$d2+=$row['2d'];$d1+=$row['1d'];$d0+=$row['tday'];
					$tot=$d15+$d14+$d13+$d12+$d11+$d10+$d9+$d8+$d7+$d6+$d5+$d4+$d3+$d2+$d1+$d0;
					$ntot+=$tot;
					echo "<tr><td>".$i."</td><td>".$objuser->username($row['user_id'])."</td><td class='text-center'>".$row['15d']."</td><td class='text-center'>".$row['14d']."</td><td class='text-center'>".$row['13d']."</td><td class='text-center'>".$row['12d']."</td><td class='text-center'>".$row['11d']."</td><td class='text-center'>".$row['10d']."</td><td class='text-center'>".$row['9d']."</td><td class='text-center'>".$row['8d']."</td><td class='text-center'>".$row['7d']."</td><td class='text-center'>".$row['6d']."</td><td class='text-center'>".$row['5d']."</td><td class='text-center'>".$row['4d']."</td><td class='text-center'>".$row['3d']."</td><td class='text-center'>".$row['2d']."</td><td class='text-center'>".$row['1d']."</td><td class='text-center'>".$row['tday']."</td><td class='text-center'>".$tot."</td></tr>";
					$i++;
				}
					?>
			</tbody>
			<tfoot>
			<?php
				echo "<tr><th>#</th><th>Total</th><th class='text-center'>".$d15."</th><th class='text-center'>".$d14."</th><th class='text-center'>".$d13."</th><th class='text-center'>".$d12."</th><th class='text-center'>".$d11."</th><th class='text-center'>".$d10."</th><th class='text-center'>".$d9."</th><th class='text-center'>".$d8."</th><th class='text-center'>".$d7."</th><th class='text-center'>".$d6."</th><th class='text-center'>".$d5."</th><th class='text-center'>".$d4."</th><th class='text-center'>".$d3."</th><th class='text-center'>".$d2."</th><th class='text-center'>".$d1."</th><th class='text-center'>".$d0."</th><th class='text-center'>".$ntot."</th></tr>";
			?>
			</tfoot>
		</table>
	</div>
</div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
		<!-- end page content -->
		<!-- start chat sidebar -->
	
		<!-- end chat sidebar -->
	</div>
	<!-- end page container -->
	<!-- start footer -->
	<?php include 'config/footer.php';?>
	<!-- end footer -->
</div>
<script>
$(document).ready(function(){
	//display();
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=Delete";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/LEAD/',
			method:'post',
			data:datastr,
			success:function(data){
				//$('#preloader').hide();
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$.toast({
						heading: 'Success',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'success'
					});
					setTimeout(function(){display();},2500);
				}
				else
				{
					$.toast({
						heading: 'Fail',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'error'
					});
					
				}	
			}
			
		});
	} );
	
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=View";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PURCHASE/',
			method:'post',
			data:datastr,
			success:function(data){
				
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displaydata").html(response.message);
					//alert(response.message);
				}
			}
		});
	}
	
	<?php 
	if($permission_error!='')
	{
		?>
		$.toast({
			heading: 'Fail',
			text: '<?php echo $permission_error;?>',
			position: 'mid-center',
			stack: false,
			icon:'error'
		});
		<?php 
	}
	?>
} );
</script>

</body>

</html>