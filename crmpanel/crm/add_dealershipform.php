<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
//error_reporting(E_ALL);
include 'Model/class.category.php';
$page="dealership";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_dealership where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dealer Distributor Form Registration  </title>
	<?php include 'config/head.php';?>
	<style>
	.pl-5{padding-left:4px!important; padding-right:4px!important;} 
	</style>
	
	<style>
       
        .form-container { background: #fff; padding: 30px;  margin: auto; border: 1px solid #ddd; }
        
        /* Custom Header Styling */
        .section-header {
            display: flex;
            align-items: center;
            background-color: #1a2b49; /* Navy Blue */
            color: white;
            margin-bottom: 20px;
            margin-top: 30px;
        }
        .header-letter {
            background-color: #e30613; /* Red */
            padding: 10px 20px;
            font-weight: bold;
            font-size: 1.2em;
            
            min-width: 60px;
            text-align: center;
        }
        .header-title {
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* Photo Box */
        .photo-box {
            border: 2px solid #ccc;
            width: 130px;
            height: 150px;
            
            text-align: center;
            padding: 10px;
			padding-top:50px;
            font-size: 11px;
            background: #eee;
        }

        .form-group label { font-weight: bold; color: #333; font-size: 13px; }
        .sub-section-title { color: #e30613; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; }
        
        
        /* Declaration Box */
        .signature-box {
            border: 1px solid #ddd;
            height: 120px;
            background: #f9f9f9;
            margin-top: 10px;
        }
        
        /* Utility */
        .mb-20 { margin-bottom: 20px; }
        .mt-40 { margin-top: 40px; }
        .checkbox-inline, .radio-inline { padding-top: 0; }
    </style>
	
	
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">

	<div class="page-wrapper">
		<!-- start header -->
		<?php include 'config/header.php';?>
		<!-- end header -->
		<!-- start color quick setting -->
		
		<!-- end color quick setting -->
		<!-- start page container -->
		<div class="page-container">
			<!-- start sidebar menu -->
			<?php include 'config/leftmenu.php';?>
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
				

<div class="container">
	<h1>Dealer / Distributor Form Registration </h1>
    <div class="form-container">
        <form method="post" id="act-form" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?=$post_id?>" />
		<input type="hidden" name="method" value="Dealership" />
		<input type="hidden" name="edit_id" value="<?=$edit_id?>" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
        <div class="row">
            <div class="col-xs-8">
                <p>Please fill this form in <strong>BLOCK LETTERS</strong>.</p>
                <p class="small text-muted p-3">All information will be kept confidential and used only for evaluation and onboarding as an authorized Subtech Dealer.</p>
				
				<div class="row m-0 mt-4">
					<div class="col-md-8">
						<div class="form-group">
							<label>Registration Type :</label>
							<select class="form-control" name="reg_type" >
								<option value="Dealer" <?=($row['reg_type']=='Dealer')?"selected":"";?> >Dealer</option>
								<option value="Distributor" <?=($row['reg_type']=='Distributor')?"selected":"";?>>Distributor</option>
							</select>
						</div>
					</div>
				</div>
				
				
            </div>
            <div class="col-xs-4">
                <div class="photo-box" id="photo-preview" <?php if($row['photo']!=''){echo 'style="padding:0"';}?>>
				<?php 
				if($row['photo']!=""){
					echo '<img src="'.BASE_PATH.'images/dealership_img/'.$row['photo'].'" style="max-width: 100%;" alt="Preview">';
				}else{
					echo '(Paste Passport size photo of Owner / MD)';
				}
				?>
                    
                </div>
				<input type="file" id="photo" accept="image/*" name="photo" />
            </div>
        </div>

        
            <div class="section-header">
                <div class="header-letter">A</div>
                <div class="header-title">Basic Identification</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Firm / Shop Name :</label>
                        <input type="text" class="form-control uppercase only-text" value="<?=$row['firm_name']?>"  name="firm_name" required >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Trade Name <small>(if different)</small> :</label>
                        <input type="text" class="form-control uppercase only-text" value="<?=$row['trade_name']?>" name="trade_name">
                    </div>
                </div>
            </div>

            <div class="section-header">
                <div class="header-letter">B</div>
                <div class="header-title">Address & Locations Details</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Shop / Billing Address :</label>
                        <textarea class="form-control uppercase" name="billing_address" rows="2"><?=$row['billing_address']?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City / Town :</label>
                        <input type="text" class="form-control uppercase only-text" value="<?=$row['city']?>" name="city">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State :</label>
						
                        <select class="form-control select2" name="state" >
						<?=$objcat->state_list($row['state'])?>
						</select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pincode :</label>
                        <input type="text" class="form-control only-numeric" name="pincode" value="<?=$row['pincode']?>" maxlength="6">
                    </div>
                </div>
            </div>

            <div class="section-header">
                <div class="header-letter">C</div>
                <div class="header-title">Key Contact Details</div>
            </div>
            <h5 class="sub-section-title">1. Owner / Primary Contact</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>Full Name :</label><input type="text" class="form-control only-text uppercase" name="full_name" value="<?=$row['full_name']?>"></div>
                    <div class="form-group"><label>Phone :</label><input type="text" name="mobile" maxlength="10" class="form-control only-numeric" value="<?=$row['mobile']?>"></div>
                    <div class="form-group"><label>Email ID :</label><input type="email" name="email" value="<?=$row['email']?>" class="form-control"></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Designation :</label><input type="text" name="designation" class="form-control uppercase only-text" value="<?=$row['designation']?>"></div>
                    <div class="form-group"><label>WhatsApp :</label><input type="text" name="whatsapp" class="form-control only-numeric" value="<?=$row['whatsapp']?>"></div>
                    <div class="form-group"><label>Date of Birth :</label><input type="date" name="dob" class="form-control" value="<?=$row['dob']?>"></div>
                </div>
            </div>

            <div class="section-header">
                <div class="header-letter">D</div>
                <div class="header-title">Business Profile</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Year of Establishment :</label>
                        <input type="text" class="form-control only-numeric" name="yoe" value="<?=$row['yoe']?>" maxlength="4">
                    </div>
                </div>
                <div class="col-md-8">
                    <label><b>Ownership Type :</b></label><br>
                    <label class="checkbox-inline mr-2"><input type="radio" name="owner_type" <?php if($row['owner_type']=='Proprietorship'){echo 'checked';}?> value="Proprietorship"> Proprietorship</label>
                    <label class="checkbox-inline mr-2"><input type="radio" name="owner_type" <?php if($row['owner_type']=='Partnership'){echo 'checked';}?> value="Partnership"> Partnership</label>
                    <label class="checkbox-inline mr-2"><input type="radio" name="owner_type" <?php if($row['owner_type']=='Private Limited'){echo 'checked';}?> value="Private Limited"> Private Limited</label>
					
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
				<?php
				
				$buss=explode(",",$row['buss_type']);
				//print_r($buss);
				if(in_array('Pump Dealer',$buss)){echo 'checked';}
			?>
                    <label><b>Business Type :</b></label><br>
                    <label class="checkbox-inline mr-3"><input type="checkbox" name="buss_type[]" <?php if(in_array('Electrical Dealer',$buss)){echo 'checked';}?> value="Electrical Dealer"> Electrical Dealer</label>
                    <label class="checkbox-inline mr-3"><input type="checkbox" name="buss_type[]" <?php if(in_array('Pump Dealer',$buss)){echo 'checked';}?>  value="Pump Dealer"> Pump Dealer</label>
                    <label class="checkbox-inline mr-3"><input type="checkbox" name="buss_type[]" <?php if(in_array('Panel Builder',$buss)){echo 'checked';}?> value="Panel Builder"> Panel Builder</label>
                    <label class="checkbox-inline mr-3"><input type="checkbox" name="buss_type[]" <?php if(in_array('Contractor',$buss)){echo 'checked';}?> value="Contractor"> Contractor</label>
                    <label class="checkbox-inline mr-3"><input type="checkbox" name="buss_type[]" <?php if(in_array('Other',$buss)){echo 'checked';}?> value="Other"> Other: </label>
                    <input type="text" name="other_buss_type" value="<?=$row['other_buss_type']?>" style="display:inline-block; width: 200px; border-bottom: 1px solid #ccc; border-top:none; border-left:none; border-right:none;">
                </div>
            </div>

            <div class="section-header">
                <div class="header-letter">E</div>
                <div class="header-title">Legal & Tax Details</div>
            </div>
            <div class="row">
                <div class="col-md-4"><div class="form-group"><label>GST Number :</label><input type="text" class="form-control uppercase" name="gstno" value="<?=$row['gstno']?>"></div></div>
                <div class="col-md-4"><div class="form-group"><label>PAN Number :</label><input type="text" class="form-control pan-card" name="panno" value="<?=$row['panno']?>"></div></div>
                <div class="col-md-4"><div class="form-group"><label>MSME / Udyam No :</label><input type="text" class="form-control uppercase" placeholder="UDYAM-XX-00-0000000" name="msmeno" value="<?=$row['msmeno']?>"></div></div>
            </div>

            <div class="section-header">
                <div class="header-letter">F</div>
                <div class="header-title">Shop & Service Capability</div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <p><strong>Do you regularly stock electrical products?</strong></p>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline mr-3"><input type="radio" name="stock" <?=($row['stock']=='Yes')?"checked":"";?> value="Yes"> Yes</label>
                    <label class="radio-inline"><input type="radio" name="stock" <?=($row['stock']=='No')?"checked":"";?> value="No"> No</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>Approx. Shop / Warehouse size (sq. ft.) :</label><input type="text" class="form-control only-numeric" maxlength="4" name="shop_size" value="<?=$row['shop_size']?>"></div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Number of technical staff :</label><input type="text" class="form-control only-numeric" maxlength="4" name="staff" value="<?=$row['staff']?>"></div>
                </div>
            </div>
			<div class="section-header">
                <div class="header-letter">G</div>
                <div class="header-title">Upload Documents</div>
            </div>
            <div class="row pt-2 m-0">
                <div class="col-md-6">
                    <label><strong>GST Registration Certificate</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="gstfile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['gstfile']!=""){
					$file=end(explode(".",$row['gstfile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['gstfile'].'" download="gstfile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['gstfile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['gstfile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
				
            </div>
			<div class="row pt-2 m-0" style="background:#dfdfdf">
                <div class="col-md-6">
                    <label><strong>PAN Card (Firm / Proprietor)</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="panfile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['panfile']!=""){
					$file=end(explode(".",$row['panfile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['panfile'].'" download="panfile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['panfile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['panfile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0">
                <div class="col-md-6">
                    <label><strong>MSME / Udyam Registration (if available)</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="msmefile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['msmefile']!=""){
					$file=end(explode(".",$row['msmefile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['msmefile'].'" download="msmefile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['msmefile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['msmefile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0" style="background:#dfdfdf">
                <div class="col-md-6">
                    <label><strong>Address Proof of Firm (Electricity Bill / Rent Agreement / Property Tax etc.)</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="addfile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['addfile']!=""){
					$file=end(explode(".",$row['addfile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['addfile'].'" download="addfile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['addfile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['addfile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0">
                <div class="col-md-6">
                    <label><strong>Cancelled Cheque / Bank Passbook (for payments)</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="cheqfile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['cheqfile']!=""){
					$file=end(explode(".",$row['cheqfile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['cheqfile'].'" download="cheqfile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['cheqfile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['cheqfile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0" style="background:#dfdfdf">
                <div class="col-md-6">
                    <label><strong>Recent Shop / Godown Photographs</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="shopphoto" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['shopphoto']!=""){
					$file=end(explode(".",$row['shopphoto']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['shopphoto'].'" download="shopphoto.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['shopphoto'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['shopphoto'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0">
                <div class="col-md-6">
                    <label><strong>Any existing dealership / distributorship certificates (optional)</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="certifile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['certifile']!=""){
					$file=end(explode(".",$row['certifile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['certifile'].'" download="certifile.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['certifile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['certifile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			
			<div class="row pt-2 m-0" style="background:#dfdfdf">
                <div class="col-md-6">
                    <label><strong>Dealer / Distributor Application Form</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="appfile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['appfile']!=""){
					$file=end(explode(".",$row['appfile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['appfile'].'" download="application_form.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['appfile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['appfile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
			<div class="row pt-2 m-0">
                <div class="col-md-6">
                    <label><strong>Dealer / Distributor Agreement form</strong></label>
                </div>
                <div class="col-md-5">
                    <label class="radio-inline"><input type="file" name="agreefile" accept="image/*, application/pdf"></label>
                </div>
				<div class="col-md-1">
				<?php 
				if($row['agreefile']!=""){
					$file=end(explode(".",$row['agreefile']));
					if($file=="pdf"){
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['agreefile'].'" download="agreement_form.pdf">Download</a>';
					}else{
						echo '<a href="'.BASE_PATH.'images/dealership_img/'.$row['agreefile'].'" target="_blank"><img src="'.BASE_PATH.'images/dealership_img/'.$row['agreefile'].'" style="width:100%" /></a>';
					}
				}?>
				</div>
            </div>
            

            <div class="section-header">
                <div class="header-letter">H</div>
                <div class="header-title">Declaration</div>
            </div>
            <p class="small">I hereby declare that the information provided above is true and correct to the best of my knowledge and belief. I understand that submission of this form does not guarantee appointment as an authorized Subtech Dealer. S S Power System reserves the right to accept or reject this application without assigning any reason.</p>
            
            <div class="row m-0 mt-40">
                <div class="col-xs-6">
                    <div class="form-group"><label>Place :</label><input type="text" name="place" value="<?=$row['place']?>" class="form-control uppercase"></div>
                    <div class="form-group"><label>Date :</label><input type="date" name="doa" value="<?=$row['doa']?>" class="form-control"></div>
                </div>
                <div class="col-xs-6 text-center">
                   <!-- <div class="signature-box"></div>
                    <label>Signature & Stamp of Applicant</label>-->
                </div>
            </div>
<div id="msg"></div>
            <div class="row mt-40">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Submit Application</button>
                </div>
            </div>
        </form>
    </div>
</div>
						
						
						
						
			</div>
			<!-- end page content -->
			<!-- start chat sidebar -->
		</div>
		</div>
			<!-- end chat sidebar -->

		<!-- end page container -->
		<!-- start footer -->
		<?php include 'config/footer.php';?>
		<!-- end footer -->
	</div>

</body>
<script>
$(document).ready(function(){
	$('.uppercase').on('input', function() {
		this.value = this.value.toUpperCase();
	});
	$('.only-text').on('input', function() {
		let val = this.value.replace(/[^a-zA-Z\s]/g, '');

		// 2. Phir multiple spaces ko single space se replace karein
		val = val.replace(/\s\s+/g, ' ');

		// 3. Agar shuruat mein hi space hai toh use remove karein (Optional but recommended)
		val = val.replace(/^\s/g, '');

		this.value = val;
	});
	$('.only-numeric').on('input', function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	$('.pan-card').on('input', function() {
		let val = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
		
		// PAN ki length 10 se zyada nahi honi chahiye
		if (val.length > 10) {
			val = val.substring(0, 10);
		}
		this.value = val;
	});
	$('#photo').on('change', function() {
        const file = this.files[0]; // Select ki gayi file
        const previewDiv = $('#photo-preview');

        if (file) {
            const reader = new FileReader();

            // Jab file puri tarah read ho jaye
            reader.onload = function(e) {
                previewDiv.html(`
                    <img src="${e.target.result}" 
                         style="max-width: 100%;" 
                         alt="Preview">
                `);
				previewDiv.css({
					"padding": "0px"
				});
            };

            reader.readAsDataURL(file); // File ko read karne ka process start karein
        } else {
            previewDiv.html('(Paste Passport size photo of Owner / MD)'); // Agar koi file select nahi hai toh preview clear kar dein
			previewDiv.css({
					"padding": "10px",
					"padding-top":"50px"
				});
        }
    });
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/CATEGORY/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				$("#msg").html(data);
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
					setTimeout(function(){window.location='<?=BASE_PATH;?>All-Dealership';},1500);
				}else{
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
	});
});
</script>
</html>

