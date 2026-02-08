<?php 
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
include 'config/function.php';
//require './Model/class.activity.php';
//require './Model/class.activity_cat.php';

$page="printhistory";

$coach=(isset($_REQUEST['coach']) and $_REQUEST['coach'] !='')?$db->filterVar($_REQUEST['coach']):'';


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
    <title>Print History for Coach No. <?php echo $coach;?>  </title>
      
  <style>
  .pagebreak { page-break-before: always;  } 
	@media print{
	@page {size: a4 landscape;margin:.5cm;margin-top:1cm;font-size:11px;}
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
			<tr><th colspan="14"><i><u>NORTHERN RAILWAY</u></i><br>MEMU CAR SHED, Saharanpur,<br>
			History for Coach No. <?php echo $coach;?>
			</th></tr>
			<tr>
			<td colspan="14">Motor Coach No...............................  Rake No................................  Date.: <?php echo date("d-M-Y");?></td></tr>
			
		</thead>
		<tbody>
			<tr><th>#</th><th>POH Date</th><th>IA1</th><th>IA2</th><th>IA3</th><th>IC1</th><th>IA1</th><th>IA2</th><th>IA3</th><th>IC2</th><th>IA1</th><th>IA2</th><th>IA3</th><th>Next POH</th></tr>
			
			
			<tr><th>Scheduled</th><td><?php echo fn_pohdate($coach);?></td><td><?php echo fn_schdate('ia1',$coach);?></td><td><?php echo fn_schdate('ia2',$coach);?></td><td><?php echo fn_schdate('ia3',$coach);?></td><td><?php echo fn_schdate('ic1',$coach);?></td><td><?php echo fn_schdate('ic1_ia1',$coach);?></td><td><?php echo fn_schdate('ic1_ia2',$coach);?></td><td><?php echo fn_schdate('ic1_ia3',$coach);?></td><td><?php echo fn_schdate('ic2',$coach);?></td><td><?php echo fn_schdate('ic2_ia1',$coach);?></td><td><?php echo fn_schdate('ic2_ia2',$coach);?></td><td><?php echo fn_schdate('ic2_ia3',$coach);?></td><td><?php echo fn_schdate('next_poh',$coach);?></td></tr>
			
			<tr><th>Due Date</th><td><?php echo fn_pohdate($coach);?></td><td><?php echo fn_duedate('memu_ia1',$coach);?></td><td><?php echo fn_duedate('memu_ia2',$coach);?></td><td><?php echo fn_duedate('memu_ia3',$coach);?></td><td><?php echo fn_duedate('memu_ic1',$coach);?></td><td><?php echo fn_duedate('memu_ic1_ia1',$coach);?></td><td><?php echo fn_duedate('memu_ic1_ia2',$coach);?></td><td><?php echo fn_duedate('memu_ic1_ia3',$coach);?></td><td><?php echo fn_duedate('memu_ic2',$coach);?></td><td><?php echo fn_duedate('memu_ic2_ia1',$coach);?></td><td><?php echo fn_duedate('memu_ic2_ia2',$coach);?></td><td><?php echo fn_duedate('memu_ic2_ia3',$coach);?></td><td><?php echo fn_schdate('next_poh',$coach);?></td></tr>
			
			<tr><th>Done Date</th><td><?php echo fn_pohdate($coach);?></td><td><?php echo fn_donedate('memu_ia1',$coach);?></td><td><?php echo fn_donedate('memu_ia2',$coach);?></td><td><?php echo fn_donedate('memu_ia3',$coach);?></td><td><?php echo fn_donedate('memu_ic1',$coach);?></td><td><?php echo fn_donedate('memu_ic1_ia1',$coach);?></td><td><?php echo fn_donedate('memu_ic1_ia2',$coach);?></td><td><?php echo fn_donedate('memu_ic1_ia3',$coach);?></td><td><?php echo fn_donedate('memu_ic2',$coach);?></td><td><?php echo fn_donedate('memu_ic2_ia1',$coach);?></td><td><?php echo fn_donedate('memu_ic2_ia2',$coach);?></td><td><?php echo fn_donedate('memu_ic2_ia3',$coach);?></td><td><?php echo fn_schdate('next_poh',$coach);?></td></tr>
			
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