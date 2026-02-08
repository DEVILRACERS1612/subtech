<?php  
include 'config/config.inc.php';
// Products + masters ko ek hi JSON me bhej dete hain
$data = [
    "categories" => [],
    "types" => [],
    "type2" => [],
    "variants" => [],
    "ratings" => [],
    "products" => []
];

// Category master
$res = $db->exeQuery("SELECT id, subcat_name FROM mi_subcategory where mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["categories"][] = $row;
}

// Type master
$res = $db->exeQuery("SELECT id, cat_name FROM mi_ptype where mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["types"][] = $row;
}

// Type2 master
$res = $db->exeQuery("SELECT id, cat_name FROM mi_ptype2 where mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["type2"][] = $row;
}

// Variant master
$res = $db->exeQuery("SELECT id, cat_name FROM mi_varient where mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["variants"][] = $row;
}

// Rating master
$res = $db->exeQuery("SELECT id, cat_name FROM mi_rating where mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["ratings"][] = $row;
}

// Products (mapping with rating_id)
$res = $db->exeQuery("SELECT p.id, p.pname, p.model, s.id as subcat_id,s.subcat_name as subcat_name, pt.id as ptype_id, pt.cat_name as ptype_name, pt2.id as ptype2_id, pt2.cat_name as ptype2_name, v.id as variant_id, v.cat_name as variant_name, r.id as rating_id, r.cat_name as rating_name FROM mi_product p join mi_subcategory s on s.id=p.subcat_id join mi_ptype pt on pt.id=p.ptype join mi_ptype2 as pt2 on pt2.id=p.ptype2 join mi_varient v on v.id=p.varient join mi_rating r on r.id=p.rating where p.mi_status='Yes'");
while($row = $res->fetch_assoc()) {
    $data["products"][] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);