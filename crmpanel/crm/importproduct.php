<?php  
include 'config/config.inc.php';
include 'config/login_check.php';

//error_reporting(E_ALL);
///require 'vendor/autoload.php';
///use PhpOffice\PhpSpreadsheet\IOFactory;
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$method=(isset($_POST['method']) and $_POST['method'] !='')?$db->filterVar($_POST['method']):'';
$cpost_id=(isset($_POST['post_id']) and $_POST['post_id'] !='')?$db->filterVar($_POST['post_id']):'';


if($method=="import" and $cpost_id==$post_id){
	if (!isset($_FILES['excel_file'])) {
		die("No file uploaded");
	}

	$tmpFile = $_FILES['excel_file']['tmp_name'];

	// Validate extension
	$allowed = ['xls', 'xlsx'];
	$ext = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);

	if (!in_array($ext, $allowed)) {
		die("Invalid Excel file");
	}

	// (Optional) Move file
	$uploadPath = "data/" . time() . "_" . $_FILES['excel_file']['name'];
	move_uploaded_file($tmpFile, $uploadPath);

	// Load Excel with PHPExcel
	$objPHPExcel = PHPExcel_IOFactory::load($uploadPath);
	$sheet = $objPHPExcel->getActiveSheet();
	$rows = $sheet->toArray(null, true, true, true);

	// DB Connection
		
		$current_product_id = null;

		foreach ($rows as $index => $row) {

			if ($index == 1) continue; // Header skip

			$category     = $db->filterVar(trim($row['A']));
			$type         = $db->filterVar(trim($row['B']));
			$type2        = $db->filterVar(trim($row['C']));
			$variant      = $db->filterVar(trim($row['D']));
			$rating       = $db->filterVar(trim($row['E']));
			$product_name = $db->filterVar(trim($row['F']));
			$url          = $db->filterVar(trim($row['G']));
			$rate         = $db->filterVar(trim($row['H']));
			$moq          = $db->filterVar(trim($row['I']));
			$sdes          = $db->filterVar(trim($row['J']));
			$des          = $db->filterVar(trim($row['K']));
			
			$key_data     = $db->filterVar(trim($row['L'])); // Key
			$value_data   = $db->filterVar(trim($row['M'])); // Value
			$img   = $db->filterVar(trim($row['N'])); // Value
			$alttxt   = $db->filterVar(trim($row['O'])); // Value
			$img1   = $db->filterVar(trim($row['P'])); // Value
			$alttxt1   = $db->filterVar(trim($row['Q'])); // Value
			$img2   = $db->filterVar(trim($row['R'])); // Value
			$alttxt2   = $db->filterVar(trim($row['S'])); // Value
			$img3   = $db->filterVar(trim($row['T'])); // Value
			$alttxt3   = $db->filterVar(trim($row['U'])); // Value
			$img4   = $db->filterVar(trim($row['V'])); // Value
			$alttxt4   = $db->filterVar(trim($row['W'])); // Value
			$img5   = $db->filterVar(trim($row['X'])); // Value
			$alttxt5   = $db->filterVar(trim($row['Y'])); // Value
	$subcat=$db->exeQuery("select id from mi_subcategory where subcat_name='".$category."' and mi_status='Yes'")->fetch_assoc();	
	
	if ($product_name != "") {
		$sql=$db->exeQuery("select * from mi_wproduct where cat_id='".$subcat['id']."' and product_name='".$product_name."' and mi_status='Yes'");
		if($sql->num_rows<1){
			
			$prow=$db->exeQuery("select * from mi_product where subcat_id='".$subcat['id']."' and pname='".$product_name."' and mi_status='Yes'")->fetch_assoc();
			/*echo "ok"."select * from mi_product where cat_id='".$subcat['id']."' and pname='".$product_name."' and mi_status='Yes'";
			exit;*/
			if($prow['pname']!=""){
				$str="INSERT INTO `mi_wproduct`(`pdate`, `user_id`, `cat_id`, `product_name`, `urlname`, `rate`, `moq`, `sdes`, `description`, `alttext`,`image`, `alttext1`, `image1`, `alttext2`, `image2`, `alttext3`, `image3`, `alttext4`, `image4`, `alttext5`,`image5`) values ('".date("Y-m-d H:i:s")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$subcat['id']."','".$product_name."','".$prow['url_name']."','".$prow['mrp']."','".$moq."','".$sdes."','".$des."','".$alttxt."','".$img."','".$alttxt1."','".$img1."','".$alttxt2."','".$img2."','".$alttxt3."','".$img3."','".$alttxt4."','".$img4."','".$alttxt5."','".$img5."')";
			
				$current_product_id = $db->inserted_id($str);
			}
			}
		}

		// 2️⃣ Insert attribute into product_attributes
			if ($current_product_id && $key_data != "") {

				$stmt2 = $db->exeQuery("INSERT INTO mi_wproduct_detail (pdate,user_id,prd_id, `keyname`, `keyvalue`)
					VALUES ('".date("Y-m-d H:i:s")."','".$_SESSION[SITE_NAME]['MICMP_userid']."','".$current_product_id."','".$key_data."','".$value_data."')");
			}
		}
	echo '{"type":"success","message":"Import Successful!"}';
}else{
	echo '{"type":"fail","message":"Invalid Request"}';
}

