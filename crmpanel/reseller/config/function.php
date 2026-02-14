<?php
function total_cat($id)
{
	$db=new DB();
	$q=$db->exeQuery("select * from am_category where am_status='Yes'");
	$str='<option value="">--Select--</option>';
	while($row=$q->fetch_assoc())
	{
		if($row['id']==$id){
			$str.='<option value="'.$row['id'].'" selected >'.$row['cat'].'</option>';
		}else{
			$str.='<option value="'.$row['id'].'" >'.$row['cat'].'</option>';
		}
	}
	return $str;
}
function total_subcat($id)
{
	$db=new DB();
	$q=$db->exeQuery("select * from nt_subcategory where id='".$id."' and nt_status='Yes'");
	$str='<option value="">--Select--</option>';
	while($row=$q->fetch_assoc())
	{
		if($row['id']==$id){
			$str.='<option value="'.$row['id'].'" selected >'.$row['subcat'].'</option>';
		}else{
			$str.='<option value="'.$row['id'].'" >'.$row['subcat'].'</option>';
		}
	}
	return $str;
}
?>