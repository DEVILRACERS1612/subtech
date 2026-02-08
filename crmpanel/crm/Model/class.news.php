<?php
class NEWS{

    private $conn;
    private $table_name = "nt_news";
	private $cat1_table = "nt_cat";
	private $cat2_table = "nt_subcat";
	private $cat3_table = "nt_ocat";
	private $tag_table = "nt_tags";
 
    // object properties
   public $ntitle;
    public $title;
	public $dop;
	public $top;
	public $cat1;
	public $subcat1;
	
	public $urlname;
	public $news;
	public $tags;
	public $ndes;
	public $nkeywords;
	public $cat;
	public $ocat;
	public $subcat;
	public $image=NULL;
   
	
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->dop=$this->dop;
		$this->top=$this->top;
		$this->title=$this->conn->filterVar($this->title);
		$this->cat1=$this->conn->filterVar($this->cat1);
		$this->subcat1=$this->conn->filterVar($this->subcat1);
		
		$this->urlname=$this->conn->filterVar($this->urlname);
		$this->news=$this->conn->filterVar($this->news);
		$this->tags=$this->conn->filterVar($this->tags);
		$this->ndes=$this->conn->filterVar($this->ndes);
		$this->nkeywords=$this->conn->filterVar($this->nkeywords);
		$this->ntitle=$this->conn->filterVar($this->ntitle);
		
		$this->image=$this->image;
		$this->cat=$this->cat;
        $this->subcat=$this->subcat;
        $this->ocat=$this->ocat;
        
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where title='".$this->title."' or urlname='".$this->urlname."' and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where title='".$this->title."' and urlname='".$this->urlname."' and id<>'".$this->edit_id."' and nt_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function newstitle($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and nt_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['title'];
	}
	
    // Insert Item
    public function insert(){
 
	   //write query
	   
        $query = "INSERT INTO ".$this->table_name."(`id`, `dop`,`top`,`cat`,`subcat`,`title`, `urlname`, `news`,`ntitle`,`ndes`,`nkeywords`, `nt_status`) VALUES ('0','".$this->dop."','".$this->top."','".$this->cat1."','".($this->subcat1)."', '".$this->title."','".$this->urlname."','".$this->news."','".$this->ntitle."','".$this->ndes."','".$this->nkeywords."','Yes')";
		$ok=$this->conn->inserted_id($query);	
		
		$this->updatecat1($ok);
		$this->updatecat2($ok);
		$this->updatecat3($ok);
		$this->updatetag($ok);
		
		
        if($ok){
			$this->updateimg($ok);
			
			$from='info@bhagwanbabu.com';
			$subject=$this->title;
			$message='<h3>A New post <a href="http://www.bhagwanbabu.com/post/'.$this->urlname.'" target="_blank"><b>'.$this->title.'</b></a> is published at <a href="http://www.bhagwanbabu.com/" target="_blank">bhagwanbabu.com</a></h3> <br><p> click <a href="http://www.bhagwanbabu.com/post/'.$this->urlname.'" target="_blank"><b> here </b></a> to Read Full Blog.</p> <br><br> Thank You, <br> bhagwanbabu.com Team';
			
			$headers = "MIME-Version: 1.0\n" ;
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
			$headers .= "X-Priority: 1 (Highest)\n";
			$headers .= "X-MSMail-Priority: High\n";
			$headers .= "Importance: High\n";
			$headers .= "From: <".$from."> bhagwanbabu.com\r\n"; 
			
			$sub=$this->conn->exeQuery("select * from nt_subscribe where nt_status='Yes'");
			while($subrow=$sub->fetch_assoc())
			{
				$to=$subrow['email'];
				mail($to, $subject, $message,$headers);
			}
			$to='bhagwanbabu81@gmail.com';
			//mail($to, $subject, $message,$headers);
            return true;
        }else{
            return false;
        }
    }
	public function updatecat1($id)
	{
		$n=explode(",",$this->cat);
		$nc=count($n);
		$this->conn->exeQuery("delete from ".$this->cat1_table." where news_id='".$id."' and nt_status='Yes'");
		$sql="insert into ".$this->cat1_table."(`id`, `news_id`, `cat_id`, `nt_status`) VALUES ";
		for($i=0;$i<$nc;$i++)
		{
			if($n[$i]!='')
			{
				$sql.="('0','".$id."','".$n[$i]."','Yes'),";
			}
		}
		$sql=rtrim($sql,",");
		$ok=$this->conn->exeQuery($sql);
		if($ok){
			 return true;
        }else{
            return false;
        }
	}
	public function updatecat2($id)
	{
		$n=explode(",",$this->subcat);
		$nc=count($n);
		$this->conn->exeQuery("delete from ".$this->cat2_table." where news_id='".$id."' and nt_status='Yes'");
		$sql="insert into ".$this->cat2_table."(`id`, `news_id`, `scat_id`, `nt_status`) VALUES ";
		for($i=0;$i<$nc;$i++)
		{
			if($n[$i]!='')
			{
				$sql.="('0','".$id."','".$n[$i]."','Yes'),";
			}
		}
		//echo $sql;
		$sql=rtrim($sql,",");
		$ok=$this->conn->exeQuery($sql);
		if($ok){
			 return true;
        }else{
            return false;
        }
	}
	public function updatecat3($id)
	{
		$n=explode(",",$this->ocat);
		$nc=count($n);
		//echo "delete from ".$this->cat3_table." where news_id='".$id."' and nt_status='Yes'";
		$this->conn->exeQuery("delete from ".$this->cat3_table." where news_id='".$id."' and nt_status='Yes'");
		$sql="insert into ".$this->cat3_table."(`id`, `news_id`, `ocat_id`, `nt_status`) VALUES ";
		for($i=0;$i<$nc;$i++)
		{
			if($n[$i]!='')
			{
				$sql.="('0','".$id."','".$n[$i]."','Yes'),";
			}
		}
		$sql=rtrim($sql,",");
		$ok=$this->conn->exeQuery($sql);
		if($ok){
			 return true;
        }else{
            return false;
        }
	}
	public function updatetag($id)
	{
		$n=explode(",",$this->tags);
		$nc=count($n);
		$this->conn->exeQuery("delete from ".$this->tag_table." where news_id='".$id."' and nt_status='Yes'");
		$sql="insert into ".$this->tag_table."(`id`, `news_id`, `tags`, `nt_status`) VALUES ";
		for($i=0;$i<$nc;$i++)
		{
			if($n[$i]!='')
			{
				$sql.="('0','".$id."','".str_replace(' ', '-', trim($n[$i]))."','Yes'),";
			}
		}
		$sql=rtrim($sql,",");
		$ok=$this->conn->exeQuery($sql);
		if($ok){
			 return true;
        }else{
            return false;
        }
	}
	public function updateimg($id){
		
        if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   if($extension=='jpg' or $extension=='JPG' or $extension=='png' or $extension=='PNG' or $extension='gif')
		   {
				$imagename=$id.".";
				$filename=$imagename.$extension;
				move_uploaded_file($this->image["tmp_name"], "../../images/newsimg/".$filename);
				$query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
				if($this->conn->exeQuery($query)){
					
					return true;
				}else{
					return false;
				}  
		   }else{
			   return false;
		   }
		  
	   }else{
		   return true;
	   }
      
	   //write query
        
    }
	 public function update(){
      
       $this->edit_id=$this->conn->filterVar($this->edit_id);
      
	   //write query
	   
        $query = "update ".$this->table_name." set `cat`='".$this->cat1."',`subcat`='".$this->subcat1."',`title`='".$this->title."',`urlname`='".$this->urlname."',`news`='".$this->news."',`ntitle`='".$this->ntitle."',`ndes`='".$this->ndes."',`nkeywords`='".$this->nkeywords."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			
			$this->updatecat1($this->edit_id);
			$this->updatecat2($this->edit_id);
			$this->updatecat3($this->edit_id);
			$this->updatetag($this->edit_id);
			
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objnews= new NEWS($db);
?>