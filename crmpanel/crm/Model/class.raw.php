<?php
class RAW{

    private $conn;
    private $table_name = "am_rawmaterial";
 
    // object properties
   
    public $cat;
	public $color;
	public $uom;
	public $rname;
	public $price;
	public $op_qty;
	public $image=NULL;
    public $description;
    public $edit_id;
    
    public function __construct($db){
        $this->conn = $db;
		$this->cat=$this->conn->filterVar($this->cat);
		$this->color=$this->conn->filterVar($this->color);
		$this->uom=$this->conn->filterVar($this->uom);
		$this->rname=$this->conn->filterVar($this->rname);
		$this->price=$this->conn->filterVar($this->price);
		$this->op_qty=$this->conn->filterVar($this->op_qty);
		$this->image=$this->image;
        $this->description=$this->conn->filterVar($this->description);
    }
	public function find_id()
	{
		if(empty($this->edit_id))
		{
			if($this->conn->num_rows("select * from ".$this->table_name." where cat_id='".$this->cat."' and color='".$this->color."' and rname='".$this->rname."' and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}else if(!empty($this->edit_id)){
			if($this->conn->num_rows("select * from ".$this->table_name." where cat_id='".$this->cat."' and color='".$this->color."' and rname='".$this->rname."' and id<>'".$this->edit_id."' and am_status='Yes'") )
			{
				return true;
			}else{
				return false;
			}
		}
	}
	public function rawname($id)
	{
		$query="select * from ".$this->table_name." where id='".$id."' and am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		$row=$qr->fetch_assoc();
		return $row['rname']."-".$row['description'];
	}
	/// Raw List
	public function rawlist($id='')
	{
		$str='<option value="">--Select--</option>';
		global $objcat;global $objcolor;
		$query="select * from ".$this->table_name." where am_status='Yes'";
		$qr=$this->conn->exeQuery($query);
		while($row=$qr->fetch_assoc())
		{
			if($id==$row['id'])
			{
				$str.='<option value="'.$row['id'].'" selected>'.$row['rname'].'</option>';
			}else{
			$str.='<option value="'.$row['id'].'">'.$row['rname'].' {'.$objcat->catname($row['cat_id']).'} ['.$objcolor->colorname($row['color']).']</option>';
			}
		}
		
		return $str;
	}
    // Insert Item
    public function insert(){
 
	   //write query
        $query = "INSERT INTO ".$this->table_name."(`id`, `cat_id`, `color`, `rname`, `uom`, `price`, `op_qty`,`description`, `am_status`) VALUES ('0', '".$this->cat."','".$this->color."','".$this->rname."','".$this->uom."','".$this->price."','".$this->op_qty."','".$this->description."','Yes')";
		$ok=$this->conn->inserted_id($query);		
        if($ok){
			$this->updateimg($ok);
            return true;
        }else{
            return false;
        }
    }
	 public function updateimg($id){
       if($this->image["name"]!=''){
		   
		   $exp = explode(".", $this->image["name"]);
		   $extension = end($exp);
		   $imagename=$id.".";
			$filename=$imagename.$extension;
			move_uploaded_file($this->image["tmp_name"], "../images/rawmat/".$filename);
		   $query = "update ".$this->table_name." set `image`='".$filename."' where id='".$id."'";
			if($this->conn->exeQuery($query)){
				return true;
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
        $query = "update ".$this->table_name." set `cat_id`='".$this->cat."',`color`='".$this->color."',`rname`='".$this->rname."',`uom`='".$this->uom."',`price`='".$this->price."',`op_qty`='".$this->op_qty."', `description`='".$this->description."' where id='".$this->edit_id."'";
				
        if($this->conn->exeQuery($query)){
			$this->updateimg($this->edit_id);
            return true;
        }else{
            return false;
        }
    }
	
	
	
}
$objraw= new RAW($db);
?>