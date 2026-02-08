<?php 
$page_permission=array();
function find_page_permission($schid,$uid,$pgid)
{
	$n=count($_SESSION[SITE_NAME]['PAGE_PERMISSION']);
	for($i=0;$i<$n;$i++)
	{
		if($_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['cmp_id']==$schid and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['emp_id']==$uid and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['rr_page_code']==$pgid )
		{
			return $i;
		}
	}
}
//echo $page;
//print_r($_SESSION['PAGE_PERMISSION']);
if(isset($page))
{
	$uid=$_SESSION[SITE_NAME]['MICMP_userid'];
	$schid=$_SESSION[SITE_NAME]['MICMP_cmpid'];
	$pgid=$page;
	
	$pid=find_page_permission($schid,$uid,$pgid);
	
	if($pid>=0 or $_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
	{ 
		$pg_create=$_SESSION[SITE_NAME]['PAGE_PERMISSION'][$pid]['rr_create'];
		
		$pg_edit=$_SESSION[SITE_NAME]['PAGE_PERMISSION'][$pid]['rr_edit'];
		$pg_delete=$_SESSION[SITE_NAME]['PAGE_PERMISSION'][$pid]['rr_delete'];
		$pg_view=$_SESSION[SITE_NAME]['PAGE_PERMISSION'][$pid]['rr_view'];
		$page_permission=array('pg_create' => $pg_create,'pg_edit' => $pg_edit,'pg_delete' => $pg_delete,'pg_view' => $pg_view);
	}else{
		$permission_error='Permission Error For this Page';
		header('Refresh:2;url='.BASE_PATH);
	}
}else{
	$permission_error='Undefined Error';
	header('Refresh:2;url='.BASE_PATH);
}

?>