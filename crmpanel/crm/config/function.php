<?php
$months=Array('01' => 'January', '02' => 'February','03' => 'March','04' => 'April','05' => 'May','06' => 'June','07' => 'July','08' => 'August','09' => 'Septermber','10' => 'October','11' => 'November','12' => 'December');
$days = array('01' => 'First', '02' => 'Second', '03' => 'Third', '04' => 'Fourth', '05' => 'Fifth', '06' => 'Sixth', '07' => 'Seventh', '08' => 'Eighth', '09' => 'Nineth','10' => 'Tenth', '11' => 'Eleventh', '12' => 'Twelveth','13' => 'Thirteen', '14' => 'Fourteen','15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen','18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty','21' => 'Twenty One', '22' => 'Twenty Two', '23' => 'Twenty Three', '24' => 'Twenty Four', '25' => 'Twenty Five','26' => 'Twenty Six','27' => 'Twenty Seven','28' => 'Twenty Eight','29' => 'Twenty Nine','30' => 'Thirty','31'=>'Thirty One' );

function check_module($findtext,$module)
{
	$n=count($_SESSION[SITE_NAME]['PAGE_PERMISSION']);
	foreach($module as $value)
	{
		if($findtext==$value)
		{
			if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
        	{
        		return true;
        	}else{
				for($i=0;$i<$n;$i++)
				{
					if(($_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['cmp_id']==$_SESSION[SITE_NAME]['MICMP_cmpid'] and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['emp_id']==$_SESSION[SITE_NAME]['MICMP_userid'] and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['module']==$value))
					{
						return true;
					}
				}
			
		    }	
			
		}
	}
	return false;
}
function check_feature($findtext,$feature)
{
	foreach($feature as $value)
	{
		if($findtext==$value)
		{
			return true;
		}
	}
}
function check_page_permission($pgid)
{
	if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin')
	{
		return true;
	}else{
		$n=count($_SESSION[SITE_NAME]['PAGE_PERMISSION']);
		for($i=0;$i<$n;$i++)
		{
			if(($_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['cmp_id']==$_SESSION[SITE_NAME]['MICMP_cmpid'] and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['emp_id']==$_SESSION[SITE_NAME]['MICMP_userid'] and $_SESSION[SITE_NAME]['PAGE_PERMISSION'][$i]['rr_page_code']==$pgid)  )
			{
				return true;
			}
		}
		return false;
	}
	return false;
	
}
function fn_medium($apid='')
{
	$gen = array("ENGLISH", "HINDI", "OTHER");
	$arrlength = count($gen);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$gen[$x])
		{
			$data.='<option value="'.$gen[$x].'" selected>'.$gen[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$gen[$x].'">'.$gen[$x].'</option>';
		}
	}
	return $data;
}
function fn_gender($apid='')
{
	$gen = array("MALE", "FEMALE", "OTHER");
	$arrlength = count($gen);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$gen[$x])
		{
			$data.='<option value="'.$gen[$x].'" selected>'.$gen[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$gen[$x].'">'.$gen[$x].'</option>';
		}
	}
	return $data;
}
function fn_caste($apid='')
{
	$caste = array("GENERAL", "SC", "ST", "OBC", "EWS","DISABLED","SG CHILD");
	$arrlength = count($caste);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$caste[$x])
		{
			$data.='<option value="'.$caste[$x].'" selected>'.$caste[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$caste[$x].'">'.$caste[$x].'</option>';
		}
	}
	return $data;
}
function fn_relation($apid='')
{
	$reln = array("BROTHER", "SISTER");
	$arrlength = count($reln);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$reln[$x])
		{
			$data.='<option value="'.$reln[$x].'" selected>'.$reln[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$reln[$x].'">'.$reln[$x].'</option>';
		}
	}
	return $data;
}
function fn_lang($apid='')
{
	$rel = array("ENGLISH", "HINDI", "URDU", "SANSKRIT");
	$arrlength = count($rel);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$rel[$x])
		{
			$data.='<option value="'.$rel[$x].'" selected>'.$rel[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$rel[$x].'">'.$rel[$x].'</option>';
		}
	}
	return $data;
}
function fn_religion($apid='')
{
	$rel = array("HINDU", "MUSLIM", "SIKH", "CHRISTIAN");
	$arrlength = count($rel);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$rel[$x])
		{
			$data.='<option value="'.$rel[$x].'" selected>'.$rel[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$rel[$x].'">'.$rel[$x].'</option>';
		}
	}
	return $data;
}

function fn_occu($apid='')
{
	$ocu = array("EMPLOYED", "SELF-EMPLOYED", "AG", "BUSINESS","HOUSE-WIFE","NON-SERVICE","OTHER");
	$arrlength = count($ocu);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$ocu[$x])
		{
			$data.='<option value="'.$ocu[$x].'" selected>'.$ocu[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$ocu[$x].'">'.$ocu[$x].'</option>';
		}
	}
	return $data;
}
function fn_income($apid='')
{
	$income = array("LESS THAN 300000", "300000-500000", "500000-1000000", "GREATER THAN 1000000");
	$arrlength = count($income);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$income[$x])
		{
			$data.='<option value="'.$income[$x].'" selected>'.$income[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$income[$x].'">'.$income[$x].'</option>';
		}
	}
	return $data;
}

function fn_bgroup($apid='')
{
	$bld = array("A+", "A-", "B+", "B-","AB+","AB-","O+","O-");
	$arrlength = count($bld);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$bld[$x])
		{
			$data.='<option value="'.$bld[$x].'" selected>'.$bld[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$bld[$x].'">'.$bld[$x].'</option>';
		}
	}
	return $data;
}
function fn_nationality($apid='')
{
	$ocu = array("INDIAN");
	$arrlength = count($ocu);
	$data='';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$ocu[$x])
		{
			$data.='<option value="'.$ocu[$x].'" selected>'.$ocu[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$ocu[$x].'">'.$ocu[$x].'</option>';
		}
	}
	return $data;
}

function fn_vtype($apid='')
{
	$vt = array("BUS", "VAN", "AUTO-RICKSHAW", "RICKSHAW", "BIKE");
	$arrlength = count($vt);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.='<option value="'.$vt[$x].'" selected>'.$vt[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$vt[$x].'">'.$vt[$x].'</option>';
		}
	}
	return $data;
}
function fn_veh_lap($apid='')
{
	$vt = array("1", "2", "3", "4", "5");
	$arrlength = count($vt);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.='<option value="'.$vt[$x].'" selected>'.$vt[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$vt[$x].'">'.$vt[$x].'</option>';
		}
	}
	return $data;
}
function fn_shift($apid='')
{
	$vt = array("Shift-1", "Shift-2", "Shift-3");
	$arrlength = count($vt);
	$data='<option value="">--Select--</option>';
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.='<option value="'.$vt[$x].'" selected>'.$vt[$x].'</option>';
		}
		else
		{
			$data.='<option value="'.$vt[$x].'">'.$vt[$x].'</option>';
		}
	}
	return $data;
}

function fn_latefee_day($apid='')
{
	$vt = array("1", "2", "3", "4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
	$arrlength = count($vt);
	$data="<option value=''>--Select--</option>";
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.="<option value='".$vt[$x]."' selected>".$vt[$x]."</option>";
		}
		else
		{
			$data.="<option value='".$vt[$x]."'>".$vt[$x]."</option>";
		}
	}
	return $data;
}
function fn_timetable_period($apid='')
{
	$vt = array("1", "2", "3", "4","5","6","7","8","9","10");
	$arrlength = count($vt);
	$data="<option value=''>--Select--</option>";
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.="<option value='".$vt[$x]."' selected>".$vt[$x]."</option>";
		}
		else
		{
			$data.="<option value='".$vt[$x]."'>".$vt[$x]."</option>";
		}
	}
	return $data;
}
function fn_fee_schedule($apid='')
{
	$vt = array("Scheduled", "Not Scheduled");
	$arrlength = count($vt);
	$data="<option value=''>--Select--</option>";
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.="<option value='".$vt[$x]."' selected>".$vt[$x]."</option>";
		}
		else
		{
			$data.="<option value='".$vt[$x]."'>".$vt[$x]."</option>";
		}
	}
	return $data;
}
function fn_staff_list($apid='')
{
	$vt = array("Co-Ordinator","Principal", "Clerk","Teacher","Helper","Peon","Guard");
	$arrlength = count($vt);
	$data="<option value=''>--Select--</option>";
	for($x = 0; $x < $arrlength; $x++) {
		if($apid!='' and $apid==$vt[$x])
		{
			$data.="<option value='".$vt[$x]."' selected>".$vt[$x]."</option>";
		}
		else
		{
			$data.="<option value='".$vt[$x]."'>".$vt[$x]."</option>";
		}
	}
	return $data;
}
function fn_sess_month_list($id='')
{
	$ida=explode(",",$id);
	$data="<option value=''>Select</option>";
	foreach($_SESSION['MICMP_Month'] as $key=>$val)
	{
		if(count($ida)>0 and in_array($key,$ida))
		{
			$data.="<option value='".$key."' selected >".$val."-".date("y",strtotime($key))."</option>";	
		}else{
			$data.="<option value='".$key."' >".$val."-".date("y",strtotime($key))."</option>";
		}
	}
	return $data;
}
function fn_month_name($mnth1)
{
	$fm=explode(",",$mnth1);
	$mnth='';
	foreach($fm as $v)
	{
		$mnth.=date("M-Y",strtotime($v)).", ";
	}
	$mnth=rtrim($mnth,", ");
	return $mnth;
}

function fn_total_mobile_class_wise($student,$class,$sec)
{
	$n=count($student);
	$data='';
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['smsmobile']!='')
		{
			$data.=$student[$i]['smsmobile'].",";
		}
	}
	$data=rtrim($data,",");
	return $data;
}
function fn_total_admno_class_wise($student,$class,$sec)
{
	$n=count($student);
	$data='';
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['admno']!='')
		{
			$data.=$student[$i]['admno'].",";
		}
	}
	$data=rtrim($data,",");
	return $data;
}
function fn_tot_strength($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['admno']!='')
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_male($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['gender']=='MALE')
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_female($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['gender']=='FEMALE')
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_new($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['stu_type']=='NEW')
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_old($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['stu_type']=='OLD')
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_caste($student,$class,$sec,$caste)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['caste']==$caste)
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_religion($student,$class,$sec,$caste)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['religion']==$caste)
		{
			$data++;
		}
	}
	return $data;
}
function fn_tot_stuck($student,$class,$sec)
{
	$n=count($student);
	$data=0;
	for($i=0;$i<$n;$i++)
	{
		if($student[$i]['class_id']==$class and $student[$i]['sec_id']==$sec and $student[$i]['stuck_status']=='Yes')
		{
			$data++;
		}
	}
	return $data;
}







function numtowords($number){ 
 $no = ($number);
  // $point = round($number - $no, 2) * 100;
  $p = explode(".",$number);
	if($p[1]==0) {$point='';}else{$point=$p[1];}
 //$point=$p[1];
 
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?  $words[$point / 10] . " " . $words[$point = $point % 10]. " Paise" : '';
  $rettxt= $result . "Rupees  " . $points ;
return ucwords($rettxt);
}


function daysnumtowords($number){ 
 $no = ($number);
  // $point = round($number - $no, 2) * 100;
  $p = explode(".",$number);
	if($p[1]==0) {$point='';}else{$point=$p[1];}
 //$point=$p[1];
 
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?  $words[$point / 10] . " " . $words[$point = $point % 10]. " Paise" : '';
  $rettxt= $result . "" . $points ;
return ucwords($rettxt);}





?>