<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include './Model/class.product.php';
include './Model/class.category.php';
//error_reporting(E_ALL);
///require 'vendor/autoload.php';
///use PhpOffice\PhpSpreadsheet\IOFactory;
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$sql="select p.*, c.cat_name, s.subcat_name, v.cat_name as varient_name, pt.cat_name as ptype_name, pt2.cat_name as ptype2_name, rt.cat_name as rating_name, b.brand_name, u.unit_name from mi_product p
 
left join mi_category c on p.cat_id=c.id
left join mi_subcategory s on p.subcat_id=s.id
left join mi_ptype pt on p.ptype=pt.id
left join mi_ptype2 pt2 on p.ptype2=pt2.id
left join mi_varient v on p.varient=v.id
left join mi_rating rt on p.rating=rt.id
left join mi_brand b on p.brand=b.id
left join mi_unit u on p.unit_id=u.id
where p.mi_status='Yes' order by p.cat_id,p.subcat_id,p.ptype,p.ptype2,p.varient,p.rating asc
";
$html='
<table border="1">
	<thead><tr>
		<th colspan="20">S.S. Power System</th> 
	</tr>
	<tr>
		<th colspan="20">271, Udyog Kendra 2, Ecotech III, Greater Noida, Tusyana, Uttar Pradesh 201306</th> 
	</tr>
	<tr>
		<th colspan="20">All Products </th> 
	</tr>
	</thead>
';

$html.= '
    <thead>
        <tr style="background:#ff9;">
            <th>Sr.No</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Type</th>
            <th>Product Model</th>
			<th>Varient 1</th>
			<th>Varient 2</th>
			<th>Relay Range</th>
			<th>MCB</th>
			<th>MCCB</th>
			<th>KW</th>
			<th>MRP</th>
			<th>Sale</th>
			<th>Dealer</th>
			<th>Sectors</th>
			<th>Product Name</th>
			<th>Minimum Voltage</th>
			<th>Maximum Voltage</th>
			<th>Current at 415</th>
			<th>Current at 220</th>
			<th>Capacitor MFD Start</th>
			<th>Capacitor MFD Run</th>
			<th>Length (mm)</th>
			<th>Breadth (mm)</th>
			<th>Height (mm)</th>
			<th>Weight (Kgs)</th>
			<th>Unit</th>
			<th>Brand</th>
			<th>Available Qty</th>
			<th>Product Code</th>
			<th>HsnCode</th>
			<th>GST</th>
			<th>Description</th>
			<th>Box Contains</th>
			<th>Warranty</th>
        </tr>
    </thead>
    <tbody>
';

$qr=$db->exeQuery($sql);
$sr=1;
while($row=$qr->fetch_assoc()){
	$sec=$objcat->sector_name($row['sectors']);
	$qoh=$objproduct->item_qoh($row['id']);
	$html.='<tr>
	<td>'.$sr.'</td>
	<td>'.$row['cat_name'].'</td>
	<td>'.$row['subcat_name'].'</td>
	<td>'.$row['ptype_name'].'</td>
	<td>'.$row['ptype2_name'].'</td>
	<td>'.$row['varient_name'].'</td>
	<td>'.$row['rating_name'].'</td>
	<td>'.$row['relay'].'</td>
	<td>'.$row['mcb'].'</td>
	<td>'.$row['mccb'].'</td>
	<td>'.$row['kw'].'</td>
	<td>'.$row['mrp'].'</td>
	<td></td>
	<td></td>
	<td>'.$sec.'</td>
	<td>'.$row['pname'].'</td>
	<td>'.$row['minv'].'</td>
	<td>'.$row['maxv'].'</td>
	<td>'.$row['cat415'].'</td>
	<td>'.$row['cat420'].'</td>
	<td>'.$row['startmfd'].'</td>
	<td>'.$row['runmfd'].'</td>
	<td>'.$row['length'].'</td>
	<td>'.$row['breadth'].'</td>
	<td>'.$row['height'].'</td>
	<td>'.$row['weight'].'</td>
	<td>'.$row['unit_name'].'</td>
	<td>'.$row['brand_name'].'</td>
	<td>'.$qoh.'</td>
	<td>'.$row['model'].'</td>
	<td>'.$row['hsncode'].'</td>
	<td>'.$row['gst'].'</td>
	<td>'.$row['description'].'</td>
	<td>'.$row['inbox'].'</td>
	<td>'.$row['warranty'].'</td>
	<td></td>
	
	</tr>';
	$sr++;
}

$html .= '
    </tbody>
</table>
';
$dt=date("Y-m-d");
/*echo $html;*/
$reader = PHPExcel_IOFactory::createReader('HTML');
$tmpfname = tempnam(sys_get_temp_dir(), 'phpexcel_html_') . '.html';
file_put_contents($tmpfname, $html);

try {
    $excel = $reader->load($tmpfname);
} finally {
    // remove temp file
    if (file_exists($tmpfname)) unlink($tmpfname);
}

// 4) Send as XLSX download
// Clean output buffers to avoid corrupting the file
if (ob_get_length()) ob_end_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Product_At_"'.$dt.'.xlsx"');
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('php://output');
exit;




/*$reader = IOFactory::createReader('Html');
$spreadsheet = $reader->loadFromString($html);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Product_At_"'.$dt.'".xlsx"');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;*/
