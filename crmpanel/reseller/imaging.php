 <?php   
 error_reporting(0);   
 $change="";   
 $abc="";   
 define ("MAX_SIZE","8000");  
 function getExtension($str) {  
 $i = strrpos($str,".");  
 if (!$i) { return ""; }  
 $l = strlen($str) - $i;  
 $ext = substr($str,$i+1,$l);  
 return $ext; 
 } 
 
 function imagesaving($file,$tmpfile,$imgpath,$thpath)
 {
	 $image =$file;//$_FILES["file"]["name"]; 
	 $uploadedfile = $tmpfile;//$_FILES['file']['tmp_name'];  
	 
	 if ($image) 
	 {  
	 $filename = stripslashes($file);  
	 $extension = getExtension($filename); 
	 $extension = strtolower($extension);  
	 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))  
	 {  
	 $change='<div class="msgdiv">Unknown Image extension </div> ';  
	 $errors=1;      
	 }  
				
	else  
	{ 
	  $size=filesize($tmpfile); 
	  if ($size > MAX_SIZE*1024) 
	  {  
	  $change='<div class="msgdiv">You have exceeded the size limit!</div> ';  
	  $errors=1; 
	  }  
	  if($extension=="jpg" || $extension=="jpeg" ) 
	  {  
	  $uploadedfile = $tmpfile;  
	  $src = imagecreatefromjpeg($uploadedfile);  
	  } 
	  else if($extension=="png")  
	  
	  {  
	  $uploadedfile = $tmpfile;  $src = imagecreatefrompng($uploadedfile); 
	  }  
	  else 
	  {
	  $src = imagecreatefromgif($uploadedfile);  
	  }  
	  echo $scr;  
	  list($width,$height)=getimagesize($uploadedfile);

	$newwidth=800;  
	$newheight=($height/$width)*$newwidth;  
	 $tmp=imagecreatetruecolor($newwidth,$newheight);  
	 $newwidth1=350; 
	 $newheight1=400;//($height/$width)*$newwidth1;  
	 $tmp1=imagecreatetruecolor($newwidth1,$newheight1);  
	 imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);  
	 imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);  
	 $filename = $imgpath.".".$extension;  
	 $filename1 = $thpath.".".$extension;  
	 imagejpeg($tmp,$filename,100);  
	 imagejpeg($tmp1,$filename1,100);  
	 imagedestroy($src); 
	 imagedestroy($tmp); 
	 imagedestroy($tmp1);  }}
 }
 
/* $errors=0;  
 if($_SERVER["REQUEST_METHOD"] == "POST")  
 {  
	$image =$_FILES["file"]["name"]; 
	$uploadedfile = $_FILES['file']['tmp_name'];  
	$path='images/big';
	$tmpath='images/small';
	imagesaving($image,$uploadedfile,$path,$tmpath );
 
 
 } */
?> 
 
 
