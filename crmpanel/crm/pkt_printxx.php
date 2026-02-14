<?php 
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.party.php';
include 'Model/class.product.php';
include 'Model/class.unit.php';
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include 'phpqrcode/qrlib.php';

$recdate=date("d-m-Y");
$method=(isset($_REQUEST['method']) and trim($_REQUEST['method']) !='')?$db->filterVar($_REQUEST['method']):'';

$prd_id=(isset($_REQUEST['prd_id']) and trim($_REQUEST['prd_id']) !='')?$db->filterVar($_REQUEST['prd_id']):'';


$resql=$db->exeQuery("select * from mi_company where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
$school=$resql->fetch_assoc();

?>
<!Doctype html>
<html>
	<head>
		<title>Label</title>
		<style>
		body {
    font-family: Arial, sans-serif;
    
    justify-content: left;
    align-items: left;
    min-height: 100vh;
    background-color: #fff;
    margin: 0!important;
    padding: 0!important; /* Reduced padding for screen preview as well */
    box-sizing: border-box;
}


/* Main container for the product label - Screen display version */
.product-label {
    height: 49.5mm!important; /* Smaller screen preview width */
	width: 49.5mm!important;
    border: 1px solid #000;
    padding: 5px; /* Reduced padding for screen preview */
    background-color: #fff;
    text-align: center;
    font-size: 12px; /* Smaller font for screen preview */
    line-height: 1.0;
    box-sizing: border-box;
}
.product-label .qr-code-image{
	height:45px;
}
/* Section for Brand and Manufacturer - Screen display version */
.label-section.brand-info {
   /* margin-bottom: 2px;  Reduced margin */
}
.label-section.brand-info .add {
	font-size: 8px; 
}
.label-section.brand-info strong {
    font-size: 14px; /* Smaller font for screen preview */
    /*display: block;
    margin-bottom: 2px;  Reduced margin */
}

/* Section for Customer Support - Screen display version */
.label-section.customer-support {
    border-top: 1px solid #000;
    padding: 0px 0; /* Reduced padding */
    margin-bottom: 0px; /* Reduced margin */
}

.label-section.customer-support .contact-info {
    margin-top: 1px; /* Reduced margin */
    display: block;
}

.label-section.customer-support .contact-info span {
    margin: 0 0px; /* Reduced margin */
	font-size:8px;
}
.label-section.customer-support .contact-info a {
   text-decoration:none;
   color:#000;
}

.label-section.customer-support a:hover {
    text-decoration: underline;
}

/* Product Details Table - Screen display version */
.product-details-table {
    
    border-collapse: collapse;
    font-size: 10px; /* Smaller font for screen preview */
    margin-bottom: 5px; /* Reduced margin */
}

.product-details-table td {
    padding: .5mm 0.8mm; /* Reduced cell padding */
    border: 1px solid #000;
    text-align: left;
	margin:1mm;
	line-height:.8;
}

.product-details-table td:first-child {
    font-weight: bold;
    width: 28%; /* Adjust width to balance columns for screen */
    white-space: nowrap;
}

.product-details-table tr.serial-row td {
    vertical-align: top;
}

/* --- PRINT-SPECIFIC STYLES FOR 50mm x 50mm LABEL --- */
@media print {
    @page {
        /*size: 100mm 50mm;
        margin: 0; padding:0;*/
		
		margin: 0!important;
        padding: 0!important;
		height: 50mm!important;
		width:100mm!important;
		
		/* Important: No default margins */
        /* If content is still cut off by printer's non-printable area,
           you might need a slight padding here. Example: padding: 0.5mm; */
    }

    body {
        margin: 0!important;
        padding: 0!important;
		height: 50mm!important;
		width:100mm!important;
        overflow: hidden;
        display: block;
        /* Force minimum browser margin for the content area to be truly 0 */
        -webkit-print-color-adjust: exact; /* For better color accuracy if any colors were used */
        print-color-adjust: exact;
    }

    .product-label {
        width: 49.5mm!important;
        height: 49.5mm!important;
        border: none; /* No border for print */
        margin: 0;padding:0;
        box-shadow: none;
        box-sizing: border-box;
        /*overflow: hidden;  Crucial to prevent content from overflowing */

        /* Drastic Font and Line Height Reductions */
        font-size: 9px; /* VERY SMALL FONT SIZE */
        line-height: 1.0; /* VERY TIGHT LINE HEIGHT */
        text-align: center; /* Re-center overall content */
    }

    /* Further optimize individual sections for print */
    .label-section {
        margin-bottom: 0.5mm; /* Very small margin between sections */
    }

    .label-section.brand-info strong {
        font-size: 12px; /* Brand name slightly larger but still very small */
        margin-bottom: 0.3mm;
        line-height: 1.0;
    }
.label-section.brand-info .add {
	font-size: 8px; 
}
    .label-section.customer-support {
        border-top: 0.25px solid #000; 
        padding: 0.3mm 0; 
        margin-bottom: 0mm;
		border-bottom: 0.25px solid #000;
        line-height: 1.0;
    }

    .label-section.customer-support .contact-info span {
        margin: 0 0.0mm; 
		font-size: 8.0px;
    }
    .label-section.customer-support span {
          /* Ensure links also use the small font */
    }


    .product-details-table {
        font-size: 10px; /* EXTREMELY SMALL FONT FOR TABLE DATA */
        margin-bottom: 0.5mm;
        width: calc(100% - 0.5mm); /* Slightly less than 100% to ensure no overflow */
        margin-left: 0.25mm; /* Slight adjustment */
        margin-right: 0.25mm; /* Slight adjustment */
    }

    .product-details-table td {
        padding: 0.6mm 0.8mm; /* EXTREMELY SMALL CELL PADDING */
        border: 0px; /* Extremely thin borders */
        line-height: .8;
    }

    .product-details-table td:first-child {
        width: 28%; /* Adjust width to balance columns for tiny fonts */
    }

  
    /* Hide anything that shouldn't print */
    .no-print {
        display: none !important;
    }

}
	
		</style>
	</head>
	<body>
<center>
<button class="no-print" onclick="window.print();">Print</button>
</center>
<?php 
if($method=='SGL'){
$sql=$db->exeQuery("select * from mi_product_detail where id='".$prd_id."' and mi_status='Yes'");
}
if($method=='MUL'){
$sql=$db->exeQuery("select * from mi_product_detail where batch_no='".$prd_id."' and mi_status='Yes'");
}
while($row=$sql->fetch_assoc()){

$link_to_encode = "https://www.subtech.in/srverify/qrc/".base64_encode($row['serial_no']);
$base_folder = __DIR__ . '/qrcodes/'; // __DIR__ should return D:\xampp\htdocs\crmpanel\crm

// Ensure the folder exists
if (!is_dir($base_folder)) {
    mkdir($base_folder, 0755, true);
}

$file_name = $row['serial_no'] . '.png';
$file_path = $base_folder . $file_name;

// ************************************************************
// *** CRITICAL DEBUGGING STEP: INSPECT THE $file_path ***
// ************************************************************
//var_dump($file_path);
//die("Stopping execution to show the file path.");


$file_path = $base_folder.$row['serial_no'].'.png.';
$ecc_level = 'H';
$pixel_size = 8;
$frame_size = 4;
QRcode::png($link_to_encode, $file_path, $ecc_level, $pixel_size, $frame_size);

$prd=$objproduct->item_details($row['prd_id']);
//print_r($prd);
?>
<table style="height:50mm!important;width:100mm!important">
<tr style="height:50mm!important">
<td style="width:50mm!important">
	<div class="product-label">
    <div class="label-section brand-info">
        <strong>SUBTECH</strong>
        <div>Mfd: S S Power System</div>
        <div class="add">271, Udyog Kendra II, Ecotech III, Greater Noida</div>
    </div>

    <div class="label-section customer-support">
        Customer Support
        <div class="contact-info">
            <span><b>Call: 8506060581</b></span> | <span><b>Mail: support@subtech.in</b></span>
        </div>
        
    </div>

    <table class="product-details-table" style="border:none!important;">
        <tr>
            <td>Product</td>
            <td colspan="2"><?=$objcat->subcat_name($prd['subcat_id'])?>  </td>
        </tr>
        <tr>
            <td>Type</td>
            <td colspan="2"><?=$objcat->ptype2_name($prd['ptype2'])?> (<?=$objcat->ptype_name($prd['ptype'])?>)</td>
        </tr>
        <tr>
            <td>Model No.</td>
            <td colspan="2"><?=$prd['model']?></td>
        </tr>
        <tr>
            <td>Rating</td>
            <td colspan="2" ><?=$objcat->rating_name($prd['rating'])?> <?=($prd['varient']!="")?"(".$objcat->varient_name($prd['varient']).")":""?></td>
			
        </tr>
        <tr>
            <td>MFD</td>
            <td><b><?=date("d-M-Y",strtotime($row['mfg_date']))?></b></td>
			
        </tr>
        <tr>
            <td>MRP</td>
            <td colspan="2"><b>Rs. <?=$prd['mrp']?>/- (incl. GST)</b></td>
        </tr>
		<?php if($prd['relay']!=""){ ?>
		<tr>
            <td>Relay</td>
            <td ><?=$prd['relay']?></td>
        </tr>
		<?php }
		if($prd['kva']!=""){ ?>
		<tr>
            <td>KVA</td>
            <td ><?=$prd['kva']?></td>
        </tr>
		<?php } if($prd['inbox']!=""){?>
		
        <tr>
            <td>Contents</td>
            <td colspan="2"><?=$prd['inbox']?></td>
        </tr>
		<?php } ?>
        <tr class="serial-row">
            <td>Serial No.</td>
            <td>
                <span style="font-size:11px;"><b><?=$row['serial_no']?></b></span>
            </td>
        </tr>
    </table>
</div>
</td>
<td style="width:50mm!important">
	<div class="product-label">
    <div class="label-section brand-info">
        <strong>SUBTECH</strong>
        <div>Mfd: S S Power System</div>
        <div class="add">271, Udyog Kendra II, Ecotech III, Greater Noida</div>
    </div>

    <div class="label-section customer-support">
        Customer Support
        <div class="contact-info">
            <span><b>Call: 8506060581</b></span> | <span><b>Mail: support@subtech.in</b></span>
        </div>
        
    </div>

    <table class="product-details-table" style="border:none!important;">
        <tr>
            <td>Product</td>
            <td colspan="2"><?=$objcat->subcat_name($prd['subcat_id'])?> </td>
        </tr>
        <tr>
            <td>Type</td>
            <td colspan="2"><?=$objcat->ptype2_name($prd['ptype2'])?> (<?=$objcat->ptype_name($prd['ptype'])?>)</td>
        </tr>
        <tr>
            <td>Model No.</td>
            <td colspan="2"><?=$prd['model']?></td>
        </tr>
        
		<tr>
            <td>Rating</td>
            <td colspan="2" ><?=$objcat->rating_name($prd['rating'])?>  <?=($prd['varient']!="")?"(".$objcat->varient_name($prd['varient']).")":""?></td>
			
        </tr>
        
        <tr>
            <td>MFD</td>
            <td><b><?=date("d-M-Y",strtotime($row['mfg_date']))?></b></td>
			<td rowspan="3"><img src="<?=BASE_PATH?>generate_qr.php?data=<?=$link_to_encode;?>" class="qr-code-image"/></td>
        </tr>
        <?php if($prd['relay']!=""){ ?>
		<tr>
            <td>Relay</td>
            <td ><?=$prd['relay']?></td>
        </tr>
		<?php }if($prd['kva']!=""){ ?>
		<tr>
            <td>KVA</td>
            <td ><?=$prd['kva']?></td>
        </tr>
		<?php } ?>
        <tr class="serial-row">
            <td>Serial No.</td>
            <td>
                <span style="font-size:11px;"><b><?=$row['serial_no']?></b></span>
            </td>
        </tr>
    </table>
</div></td>
</tr>


</table>
<?php } ?>

	</body>
</html>