<?php 
require '../config/config.inc.php';
require '../Model/class.category.php';
	
	$objcat->rdate = date("Y-m-d H:i:s");
	$objcat->code = strtoupper($db->filterVar($_POST['code']));
	$objcat->cat_name = $db->filterVar($_POST['cat_name']);
	$objcat->product_name = $db->filterVar($_POST['product_name']);
	$objcat->rate = $db->filterVar($_POST['rate']);
	$objcat->moq = $db->filterVar($_POST['moq']);
	$objcat->god_name = $db->filterVar($_POST['god_name']);
	$objcat->brand_name = $db->filterVar($_POST['brand_name']);
	$objcat->job_type = $db->filterVar($_POST['job_type']);
	$objcat->location = $db->filterVar($_POST['location']);
	$objcat->cat_id = $db->filterVar($_POST['cat_id']);
	$objcat->subcat_id = $db->filterVar($_POST['subcat_id']);
	$objcat->varient_id = $db->filterVar($_POST['varient_id']);
	$objcat->ptype_id = $db->filterVar($_POST['ptype_id']);
	$objcat->ptype2_id = $db->filterVar($_POST['ptype2_id']);
	$objcat->rating_id = $db->filterVar($_POST['rating_id']);
	$objcat->subcat_name = $db->filterVar($_POST['subcat_name']);
	$objcat->description = $db->filterVar($_POST['description']);
	$objcat->soft_title = $db->filterVar($_POST['soft_title']);
	$objcat->web_title = $db->filterVar($_POST['web_title']);
	
	$objcat->dname = $db->filterVar($_POST['dname']);
	$objcat->aname = $db->filterVar($_POST['aname']);
	$objcat->email = $db->filterVar($_POST['email']);
	$objcat->mobile = $db->filterVar($_POST['mobile']);
	$objcat->address = $db->filterVar($_POST['address']);
	$objcat->state = $db->filterVar($_POST['state']);
	$objcat->city = $db->filterVar($_POST['city']);
	$objcat->pincode = $db->filterVar($_POST['pincode']);
	$objcat->title = $db->filterVar($_POST['title']);
	$objcat->subtitle = $db->filterVar($_POST['subtitle']);
	$objcat->urlname = $db->filterVar($_POST['urlname']);
	$objcat->sdes = $db->filterVar($_POST['sdes']);
	$objcat->blogs = $db->filterVar($_POST['blogs']);
	$objcat->author = $db->filterVar($_POST['author']);
	$objcat->mtitle = $db->filterVar($_POST['mtitle']);
	$objcat->mdes = $db->filterVar($_POST['mdes']);
	$objcat->mkeywords = $db->filterVar($_POST['mkeywords']);
	$objcat->mtags = $db->filterVar($_POST['mtags']);
	$objcat->alttext = $db->filterVar($_POST['alttext']);
	$objcat->alttext1 = $db->filterVar($_POST['alttext1']);
	$objcat->alttext2 = $db->filterVar($_POST['alttext2']);
	$objcat->alttext3 = $db->filterVar($_POST['alttext3']);
	$objcat->alttext4 = $db->filterVar($_POST['alttext4']);
	$objcat->alttext5 = $db->filterVar($_POST['alttext5']);
	$objcat->alttext6 = $db->filterVar($_POST['alttext6']);
	$objcat->alttext7 = $db->filterVar($_POST['alttext7']);
	$objcat->alttext8 = $db->filterVar($_POST['alttext8']);
	$objcat->vurl = $db->filterVar($_POST['vurl']);
	$objcat->schematext = $db->filterVar($_POST['schematext']);
	$objcat->image = $_FILES['image'];
	$objcat->image1 = $_FILES['image1'];
	$objcat->image2 = $_FILES['image2'];
	$objcat->image3 = $_FILES['image3'];
	$objcat->image4 = $_FILES['image4'];
	$objcat->image5 = $_FILES['image5'];
	$objcat->image6 = $_FILES['image6'];
	$objcat->image7 = $_FILES['image7'];
	$objcat->image8 = $_FILES['image8'];
	$objcat->voucher = $_FILES['voucher'];
	$objcat->keyname = $_POST['keyname'];
	$objcat->keyvalue = $_POST['keyvalue'];
	$objcat->edid = $_POST['edid'];
	$objcat->pcat_id = $_POST['pcat_id'];
	$objcat->prd_id = $_POST['prd_id'];
	$objcat->ques = $_POST['ques'];
	$objcat->ans = $_POST['ans'];
	
	$objcat->reg_type=$db->filterVar($_POST['reg_type']);
	$objcat->photo= $_FILES['photo'];
	$objcat->firm_name=$db->filterVar($_POST['firm_name']);
	$objcat->trade_name=$db->filterVar($_POST['trade_name']);
	$objcat->billing_address=$db->filterVar($_POST['billing_address']);
	$objcat->full_name=$db->filterVar($_POST['full_name']);
	$objcat->designation=$db->filterVar($_POST['designation']);
	$objcat->whatsapp=$db->filterVar($_POST['whatsapp']);
	$objcat->dob=(isset($_POST['dob']) && ($_POST['dob']!=""))?date("Y-m-d",strtotime($_POST['dob'])):Null;
	$objcat->yoe=$db->filterVar($_POST['yoe']);
	$objcat->owner_type=$db->filterVar($_POST['owner_type']);
	$objcat->buss_type=$_POST['buss_type'];
	$objcat->other_buss_type=$db->filterVar($_POST['other_buss_type']);
	$objcat->gstno=$db->filterVar($_POST['gstno']);
	$objcat->panno=$db->filterVar($_POST['panno']);
	$objcat->msmeno=$db->filterVar($_POST['msmeno']);
	$objcat->stock=$db->filterVar($_POST['stock']);
	$objcat->staff=$db->filterVar($_POST['staff']);
	$objcat->shop_size=$db->filterVar($_POST['shop_size']);
	$objcat->addfile= $_FILES['addfile'];
	$objcat->cheqfile= $_FILES['cheqfile'];
	$objcat->shopphoto= $_FILES['shopphoto'];
	$objcat->certifile= $_FILES['certifile'];
	$objcat->appfile= $_FILES['appfile'];
	$objcat->agreefile=$_FILES['agreefile'];
	$objcat->place=$db->filterVar($_POST['place']);
	$objcat->doa=(isset($_POST['doa']) && ($_POST['doa']!=""))?date("Y-m-d",strtotime($_POST['doa'])):Null;
	
	
    $objcat->edit_id = $db->filterVar($_POST['edit_id']);
	$objcat->del_id = $db->filterVar($_POST['del_id']);
	$objcat->permission = json_decode($_POST['pg_pmsn'],true);
    $cpost_id=$db->filterVar($_POST['post_id']);
    $method = $db->filterVar($_POST['method']);
	/*echo '<pre>';
	
	print_r($_POST);
	return true;*/
	if($post_id==$cpost_id)
	{
		if($method=='New')
		{
			if($objcat->find_id() )
			{
				echo '{"type":"fail","message":"Category  Already Exists"}';
			}
			else
			{
				if($objcat->insert()){
					echo '{"type":"success","message":"Category Save Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Category Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Edit')
		{
			if($objcat->find_id() )
			{
				echo '{"type":"fail","message":"Category Already Exists"}';
			}
			else
			{
				if($objcat->update()){
					echo '{"type":"success","message":"Category Update Successfully"}';
				}
				else{
					echo '{"type":"fail","message":"Category Not Save Due to Some Internal Error"}';
				}
			}
		}
		else if($method=='Delete')
		{
			if($objcat->deleteme()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='View')
		{
			echo '{"type":"success","message":"'.$objcat->view().'"}';
			
		}else if($method=='catcode')
		{
			echo $objcat->cat_code_name($objcat->edit_id);
		}
		else if($method=='solcat')
		{
			$ok=$objcat->update_solcat();

			if($ok==1){
				echo '{"type":"success","message":"Solution Category Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Solution Category Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteSolcat')
		{
			if($objcat->deletesolcat()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='ViewSolcat')
		{
			echo '{"type":"success","message":"'.$objcat->solcat_view().'"}';
			
		}else if($method=='solsubcat')
		{
			$ok=$objcat->update_solsubcat();

			if($ok==1){
				echo '{"type":"success","message":"Solution SubCategory Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Solution SubCategory Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='FindSolsubcat'){
			$response = [
				'type'   => 'success',
				'message' => $objcat->solsubcat_list($objcat->cat_id,'')
			];
			echo json_encode($response);
		}else if($method=='DeleteSolsubcat')
		{
			if($objcat->deletesolsubcat()){
				echo '{"type":"success","message":"SubCategory Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='ViewSolsubcat')
		{
			echo '{"type":"success","message":"'.$objcat->solsubcat_view().'"}';
			
		}else if($method=='Subcat')
		{
			$ok=$objcat->update_subcat();
			if($ok==1){
				echo '{"type":"success","message":"Sub-Category Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Sub-Category Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='subcatcode')
		{
			echo $objcat->subcat_code_name($objcat->edit_id);
		}else if($method=='subcatview')
		{
			$str=$objcat->subcat_list($objcat->cat_id);
			echo '{"type":"success","message":"'.$str.'"}';
		}else if($method=='DeleteSubcat')
		{
			if($objcat->deletesubcat()){
				echo '{"type":"success","message":"SubCategory Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Viewsubcat')
		{
			echo '{"type":"success","message":"'.$objcat->viewsubcat().'"}';
			
		}else if($method=='Godown')
		{
			$ok=$objcat->update_godown();
			if($ok==1){
				echo '{"type":"success","message":"Godown Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Godown Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=="searchproduct"){
			$response=[
				'type' => 'success',
				'prdlist' => $objcat->find_product_for_serial(),
				'subcatlist' => $objcat->subcatlist,
				'varientlist' => $objcat->varientlist,
				'ptypelist' => $objcat->ptypelist,
				'ratinglist' => $objcat->ratinglist,
				'ptype2list' => $objcat->ptype2list
				
			];
			echo json_encode($response);
		}
		else if($method=="FindType2List"){
			$response=[
				'type' => 'success',
				'ptype2list' => $objcat->find_type2_list(),
			];
			echo json_encode($response);
		}
		else if($method=="FindVarientList"){
			$response=[
				'type' => 'success',
				'varientlist' => $objcat->find_varient_list(),
			];
			echo json_encode($response);
		}
		else if($method=="FindRatingList"){
			$response=[
				'type' => 'success',
				'ratinglist' => $objcat->find_rating_list(),
			];
			echo json_encode($response);
		}
		else if($method=="FindTypeList"){
			$response=[
				'type' => 'success',
				'ptypelist' => $objcat->find_type_list(),
			];
			echo json_encode($response);
		}
		else if($method=='DeleteGodown')
		{
			if($objcat->deletegodown()){
				echo '{"type":"success","message":"Godown Deleted Successfully"}';
			}
			else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Viewgodown')
		{
			echo '{"type":"success","message":"'.$objcat->viewgodown().'"}';
			
		}else if($method=='Varient')
		{
			$ok=$objcat->update_varient();
			if($ok==1){
				echo '{"type":"success","message":"Varient Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Varient Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='varcode')
		{
			echo $objcat->varient_code_name($objcat->edit_id);
		}else if($method=='DeleteVarient')
		{
			if($objcat->deletevarient()){
				echo '{"type":"success","message":"Varient Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Viewvarient')
		{
			echo '{"type":"success","message":"'.$objcat->viewvarient().'"}';
			
		}else if($method=='Rating')
		{
			$ok=$objcat->update_rating();
			if($ok==1){
				echo '{"type":"success","message":"Rating Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Rating Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteRating')
		{
			if($objcat->deleterating()){
				echo '{"type":"success","message":"Rating Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Viewrating')
		{
			echo '{"type":"success","message":"'.$objcat->viewrating().'"}';
			
		}else if($method=='ratcode')
		{
			echo $objcat->rating_code_name($objcat->edit_id);
		}else if($method=='Ptype')
		{
			$ok=$objcat->update_ptype();
			if($ok==1){
				echo '{"type":"success","message":"Type Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Type Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeletePtype')
		{
			if($objcat->deleteptype()){
				echo '{"type":"success","message":"Type Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='typecode')
		{
			echo $objcat->ptype_code_name($objcat->edit_id);
		}else if($method=='Viewptype')
		{
			echo '{"type":"success","message":"'.$objcat->viewptype().'"}';
			
		}else if($method=='Ptype2')
		{
			$ok=$objcat->update_ptype2();
			if($ok==1){
				echo '{"type":"success","message":"Type Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Type Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeletePtype2')
		{
			if($objcat->deleteptype2()){
				echo '{"type":"success","message":"Type Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='type2code')
		{
			echo $objcat->ptype2_code_name($objcat->edit_id);
		}else if($method=='Viewptype2')
		{
			echo '{"type":"success","message":"'.$objcat->viewptype2().'"}';
			
		}else if($method=='Sector')
		{
			$ok=$objcat->update_sector();
			if($ok==1){
				echo '{"type":"success","message":"Sector Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Sector Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteSector')
		{
			if($objcat->deletesector()){
				echo '{"type":"success","message":"Sector Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='sectorcode')
		{
			echo $objcat->sector_code_name($objcat->edit_id);
		}else if($method=='Viewsector')
		{
			echo '{"type":"success","message":"'.$objcat->viewsector().'"}';
			
		}else if($method=='Brand')
		{
			$ok=$objcat->update_brand();
			if($ok==1){
				echo '{"type":"success","message":"Brand Updated Successfully"}';
			}else if($ok=='2'){
				echo '{"type":"fail","message":"Brand Already Exist"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteBrand')
		{
			if($objcat->deletebrand()){
				echo '{"type":"success","message":"Brand Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Viewbrand')
		{
			echo '{"type":"success","message":"'.$objcat->viewbrand().'"}';
		}else if($method=='Blogs')
		{
			$ok=$objcat->update_blogs();
			if($ok==1){
				echo '{"type":"success","message":"Blog Updated Successfully"}';
			}else if($ok==2){
                echo '{"type":"fail","message":"Duplicate Blog url / title found"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteBlog')
		{
			if($objcat->deleteblog()){
				echo '{"type":"success","message":"Blog Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Slider')
		{
			if($objcat->update_slider()){
				echo '{"type":"success","message":"Slider Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteSlider')
		{
			if($objcat->deleteslider()){
				echo '{"type":"success","message":"Slider Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Pcat')
		{
			if($objcat->update_pcat()){
				echo '{"type":"success","message":"Category Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeletePcat')
		{
			if($objcat->deletepcat()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='verifycomment')
		{
			if($objcat->verify_comment()){
				echo '{"type":"success","message":"Comment Verified Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='deletecomment')
		{
			if($objcat->delete_comment()){
				echo '{"type":"success","message":"Comment Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		else if($method=='Bcat')
		{
			if($objcat->update_bcat()){
				echo '{"type":"success","message":"Category Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteBcat')
		{
			if($objcat->deletebcat()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Product')
		{
			if($objcat->update_product()){
				echo '{"type":"success","message":"Product Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteProduct')
		{
			if($objcat->deleteproduct()){
				echo '{"type":"success","message":"Product Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='News')
		{
			if($objcat->update_news()){
				echo '{"type":"success","message":"News Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteNews')
		{
			if($objcat->deletenews()){
				echo '{"type":"success","message":"News Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Jobs')
		{
			if($objcat->update_jobs()){
				echo '{"type":"success","message":"Job Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteJobs')
		{
			if($objcat->deletejobs()){
				echo '{"type":"success","message":"Job Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Dealer')
		{
			if($objcat->update_dealer()){
				echo '{"type":"success","message":"Dealer Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteDealer')
		{
			if($objcat->deletedealer()){
				echo '{"type":"success","message":"Dealer Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='Dealership')
		{
			$ok=$objcat->update_dealership();
			if($ok==1){
				echo '{"type":"success","message":"Dealership form Updated Successfully"}';
			}else if($ok==2){
				echo '{"type":"fail","message":"Dealer duplicate found"}';
			}else if ($ok==4){
				echo '{"type":"fail","message":"Error! Permission Denied "}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteDealership')
		{
			if($objcat->deletedealership()){
				echo '{"type":"success","message":"Dealership form Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='FAQ')
		{
			$ok=$objcat->update_faq();
			/*echo $ok;*/
			if($ok){
				echo '{"type":"success","message":"FAQ Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteFaq')
		{
			if($objcat->deletefaq()){
				echo '{"type":"success","message":"FAQ Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='listbycat')
		{
			if($objcat->listbycat()){
				echo '{"type":"success","message":"FAQ Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='ResourceCat')
		{
			$ok=$objcat->update_resourcecat();
			/*echo $ok;*/
			if($ok){
				echo '{"type":"success","message":"Category Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DisplayRcat')
		{
			$data=[
				"type"=>"success",
				"message"=>$objcat->resource_view()
			];
			echo json_encode($data);
		}else if($method=='DeleteRcat')
		{
			if($objcat->deletercat()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Delete Not Possible. Something Went Wrong"}';
			}
		}else if($method=='Resource')
		{
			$ok=$objcat->update_resource();
			/*echo $ok;*/
			if($ok){
				echo '{"type":"success","message":"Resources Updated Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}else if($method=='DeleteResource')
		{
			if($objcat->deleteresource()){
				echo '{"type":"success","message":"Category Deleted Successfully"}';
			}else{
				echo '{"type":"fail","message":"Something Went Wrong"}';
			}
		}
		
		
    }else{
		echo '{"type":"fail","message":"Invalid User"}';
	}

?>