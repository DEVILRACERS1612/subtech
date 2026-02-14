<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.student.php';
include 'Model/class.class.php';
include 'Model/class.subject.php';
include 'Model/class.testtopic.php';
include 'Model/class.testsetting.php';

$page="test_report";

include 'config/page_permission_check.php';
if($_SESSION['MISCHOOL_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'';
if($method=='ACT')
{
	$q=$db->exeQuery("update mi_test_setting set act_status='Yes' where id='".$act_id."' and mi_status='Yes' ");
	$error="<span class='text-success'>Test Activated Successfull</span>";
	header('Refresh:1;url='.BASE_PATH.'All_Test/');
}else if($method=='DACT')
{
	$q=$db->exeQuery("update mi_test_setting set act_status='No' where id='".$act_id."' and mi_status='Yes' ");
	$error="<span class='text-danger'>Test De-Activated Successfull</span>";
	header('Refresh:1;url='.BASE_PATH.'All_Test/');
}

?>
<!DOCTYPE html>
<html lang="en">
	<title>All Test Report </title>
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
														<header>All Test Report  </header>
																											
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<?php echo $error;?>
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																
															</div>
														</div>
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<form action="" method="post" id="msg_form">
														<div class="row">
															
															<div class="col-md-9 col-xs-6">
															<div class="form-group">
																<label>Report Test For :</label>									
																<select name="test" id="method" class="form-control select2" required>
																<?php echo $objtsetting->test_name_list($_POST['test']);?>
																</select>
															</div>
															</div>
															
															<div class="col-md-3 col-xs-2">
															<div class="form-group">
																<label> &nbsp; </label>									
																<input type="submit" name="submit" class="form-control btn btn-primary" value="Search"/>
															</div>
															</div>
														</div>
													</form>
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																
															</div>
														</div>
														
														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
																<thead>
																	<tr>
																		<th>S.No.</th>
																		<th>Test</th>
																		<th> Candidate Name </th>
																		<th> Total Question </th>
																		<th> Total Time </th>
																		<th> Right </th>
																		<th> Wrong </th>
																		<th> Not Attempt </th>
																		<th> Achieve</th>
																		
																	</tr>
																</thead>
																<tbody id="displaydata">
																<?php
																if($_POST['test']!="")
																{
																$qr=$db->exeQuery("SELECT a.admno, a.test_id, sum(a.marks) as marks, (SELECT sum(b.marks) as marks FROM mi_test_submit b WHERE b.test_id=a.test_id and b.marks='1' and b.school_id=a.school_id and b.admno=a.admno) as rightm,(SELECT count(c.marks) as marks FROM mi_test_submit c WHERE c.test_id=a.test_id and (c.marks<=0 and c.marks!='') and c.school_id=a.school_id and c.admno=a.admno) as wrongm,(SELECT count(d.marks) as marks FROM mi_test_submit d WHERE d.test_id=a.test_id and d.marks='' and d.school_id=a.school_id and d.admno=a.admno) as notattemptm FROM mi_test_submit a WHERE a.test_id='".$db->filterVar($_POST['test'])."' and a.school_id='".$_SESSION['MISCHOOL_schoolid']."' group by a.admno,a.test_id");
																}else{
																$qr=$db->exeQuery("SELECT a.admno, a.test_id, sum(a.marks) as marks, (SELECT sum(b.marks) as marks FROM mi_test_submit b WHERE b.test_id=a.test_id and b.marks='1' and b.school_id=a.school_id and b.admno=a.admno) as rightm,(SELECT count(c.marks) as marks FROM mi_test_submit c WHERE c.test_id=a.test_id and (c.marks<=0 and c.marks!='') and c.school_id=a.school_id and c.admno=a.admno) as wrongm,(SELECT count(d.marks) as marks FROM mi_test_submit d WHERE d.test_id=a.test_id and d.marks='' and d.school_id=a.school_id and d.admno=a.admno) as notattemptm FROM mi_test_submit a WHERE  a.school_id='".$_SESSION['MISCHOOL_schoolid']."' group by a.admno,a.test_id");
																}
																$str="";
																$i=1;
																
																while($row=$qr->fetch_assoc())
																{
																	$ttr=$objtsetting->test_row($row['test_id']);
																	$stu=$objstu->student_detail($row['admno']);
																	$tm=($stu['caste']=='DISABLED')?($ttr['ttime']+$ttr['intime']):$ttr['ttime'];
																	$nat=$ttr['tnoq']-($row['rightm']+$row['wrongm']);
																	echo "<tr><td>".$i."</td><td>".$ttr['testname']."</td><td>".$stu['fname']." ".$stu['lname']." (".$row['admno'].")</td><td>".$ttr['tnoq']."</td><td>".$tm." min.</td><td>".$row['rightm']."</td><td>".$row['wrongm']."</td><td>".$nat."</td><td>".$row['marks']."</td>"; 
																	
																	
																	//echo "<td><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$page_permission."'><i class='fa fa-trash-o '></i></a></td>";
																	echo "</tr>";
																	$i++;
																}
																?>
																</tbody>
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
	///display();
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		//var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=Delete";
		e.preventDefault();
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/TESTSETTING/',
			method:'post',
			data:datastr,
			success:function(data){
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
		var pgpmsn=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&method=View";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/TESTSETTING/',
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
	<!-- end js include path -->
</body>

</html>