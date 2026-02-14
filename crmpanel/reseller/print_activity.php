<?php 
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
require './Model/class.activity.php';
require './Model/class.activity_cat.php';

$page="printact";

$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';

$csql=$db->exeQuery("select * from memu_activity_detail where act_id='".$act_id."' and m_status='Yes' group by cat_id");
//$sql=$db->exeQuery("select * from memu_activity_detail where act_id='".$act_id."' and m_status='Yes' ");
//$row=$sql->fetch_assoc();

$sql1=$db->exeQuery("select * from memu_activity where id='".$act_id."' and m_status='Yes'");
$hrow=$sql1->fetch_assoc();


date_default_timezone_set("Asia/Kolkata");
$dt=date("Y-m-"."01");
$rt=date("H");

	//$dom=(isset($_POST['dom']) and $_POST['dom']!='')?protect($_POST['dom']):'';
	
	$dt=explode("-",$dom);
	$m=$dt[0];
	$y=$dt[1];
	
$sr=Array('0'=>'A','1'=>'B');	
	
?>	

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Activity for <?php echo $activity->catname($act_id);?>  </title>
      
  <style>
  .pagebreak { page-break-before: always;  } 
	@media print{
	@page {size: a4;margin:.5cm;margin-top:1cm;font-size:11px;}
	.prints{display:none;}
	}
	table { page-break-inside:auto }
	tr    { page-break-inside:avoid; page-break-after:auto }
	thead { display:table-header-group }
	tfoot { display:table-footer-group }

	.table,.table th,.table td
	{
		border:1px solid #000;
		border-collapse:collapse;
	}
	.table th{font-size:16px;background:#f7f7f7;}
	.table td{
		height:18px;
		font-size:15px;
		text-align:center;
	}
	.table thead td{ text-align:left; padding-left:12px;}
  </style>
</head>
<body style="font-family:arial;font-size:11px;">
<div class="container">

<center>
<button class="prints" onclick="window.close();"> Close </button>
<button class="prints" onclick="window.print();">Print</button>
</center>
<?php 
	///echo '<h2 style="text-align:center">Total House Mould Closing for '.date("M-Y",strtotime($dt) ).'  </h2>';
?>
		<table width="100%">
		<tr>
		<td  valign="top">
		
		<table class="table" width="100%">
		<thead>
			<tr><th colspan="3"><i><u>NORTHERN RAILWAY</u></i><br>MEMU CAR SHED, Saharanpur,<br>
			<?php echo $hrow['a_type'];?> <?php echo $hrow['aname'];?> Inspection Schedule of MEMU <?php echo $hrow['coach'];?>
			</th></tr>
			<tr>
			<td colspan="3">Motor Coach No...............................  Rake No................................  Date.: <?php echo date("d-M-Y");?></td></tr>
			<tr><td colspan="3">Activity No. <?php echo $activity->catname($act_id);?></td></tr>
		</thead>
		<tbody>
			<tr><th>S.No.</th><th>ACTIVITY DETAIL</th><th>ACTION TAKEN</th>	</tr>
			<?php 
				$sn=0;
				while($crow=$csql->fetch_assoc())
				{
					echo '<tr><th>'.$sr[$sn].'</th><th style="padding-left:12px;text-align:left;">'.$activity_cat->catname($crow['cat_id']).'</th><th></th></tr>';
					
					$isql=$db->exeQuery("select * from memu_activity_detail where act_id='".$crow['act_id']."' and cat_id='".$crow['cat_id']."' and m_status='Yes'");
					$i=1;
					while($irow=$isql->fetch_assoc())
					{
						echo '<tr><td>'.$i.'.</td><td style="padding-left:12px;text-align:left;">'.$irow['act_name'].'</td><td></td></tr>';
						$i++;
					}
					//echo '<tr><td>'.$sr[$sn].'</td><td>'.$crow['cat_id'].'</td><td></td></tr>';
					$sn++;
				}
			
			?>
			
			
		</tbody>
		</table>
		
		</td></tr>
		</table>
		<br><br>
		<table width="100%">
		
		<tr><td>Name & signature of JE/E</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Name & signature of SSE/E </td><td style="text-align:center;">Name & Sinature of tech</td></tr>
		</table>
		
						
						


</div>

<center>
<button class="prints" onclick="window.close();"> Back </button>
<button class="prints" onclick="window.print();">Print</button>
</center>
</body>
</html>