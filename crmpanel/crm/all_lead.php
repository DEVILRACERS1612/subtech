<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.product.php';
include 'Model/class.user.php';
include 'Model/class.enquiry_status.php';

$page="lead";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
?>

<style>
.checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}
</style>
<script>
$(".checkbox-menu").on("change", "input[type='checkbox']", function() {
   $(this).closest("li").toggleClass("active", this.checked);
});

$(document).on('click', '.allow-focus', function (e) {
  e.stopPropagation();
});
</script>
<!DOCTYPE html>
<html lang="en">
	<title>All Lead </title>
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
							<header>All Lead <ul class="dropdown-menu checkbox-menu allow-focus">
                                  <li >
                                    <label>
                                      <input type="checkbox"> Cheese
                                    </label>
                                  </li>
                                </ul></header>
							<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
								<a href="<?php echo BASE_PATH;?>Add_Lead/" id="addRow" class="btn btn-primary">
									Add New Lead <i class="fa fa-plus"></i>
								</a>
							</div>
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
								<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
									<thead>
										<tr>
											<th> S.No.</th>
											<th> Lead Date</th><th> Organization Name </th>
											<th> Address </th>
											<th> Mobile </th>
											<th> Expected Order Date </th>
											<th> Product </th>
											<th> Executive </th>
											<th> Initiated By </th>
											<th> Status </th>
											
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
								<?php
								if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
									$qr=$db->exeQuery("select * from mi_lead where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and mi_status='Yes' order by id desc ");
								}else{
									$qr=$db->exeQuery("select * from mi_lead where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and (user_id='".$_SESSION[SITE_NAME]['MICMP_userid']."' or executive='".$_SESSION[SITE_NAME]['MICMP_userid']."' or initiated_by='".$_SESSION[SITE_NAME]['MICMP_userid']."') and mi_status='Yes' order by id desc ");
								}
								
								$i=1;
								while($row=$qr->fetch_assoc())
								{
									echo "<tr><td>".$i."</td><td>".date("d-M-Y",strtotime($row['enq_date']))."</td><td><a href='".BASE_PATH."Add_Lead/Edit/".$row['id']."/' title='Edit'>".$row['cmp_name']."</a></td><td>".$row['address']."</td><td>".$row['mobile']."</td><td>".date("d-M-Y",strtotime($row['ext_date']))."</td><td>".$objproduct->item_name($row['product'])."</td><td>".$objuser->username($row['executive'])."</td><td>".$objuser->username($row['initiated_by'])."</td> <td>".$objenqs->enquiry_status_name($row['enquiry_status'])."</td><td><a href='".BASE_PATH."Add_Lead/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
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