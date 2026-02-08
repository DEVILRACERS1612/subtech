<?php
header('Content-Type: application/json');
include 'config/config.inc.php'; // mysqli connection as $conn

$data = [];

$cat_sql = "SELECT id, cat_name, url_name FROM mi_solcat WHERE mi_status='Yes' ORDER BY cat_name ASC";
$cat_result = $db->query($cat_sql);

while ($cat = $cat_result->fetch_assoc()) {
    $cat_id = $cat['id'];
    $data[$cat['cat_name']] = [];

    $sub_sql = "SELECT subcat_name, url_name FROM mi_solsubcat WHERE cat_id='$cat_id' AND mi_status='Yes' ORDER BY subcat_name ASC";
    $sub_result = $db->query($sub_sql);

    while ($sub = $sub_result->fetch_assoc()) {
        $data[$cat['cat_name']][] = [
            'name' => $sub['subcat_name'],
            'slug' => $sub['url_name'],
            'cat_slug' => $cat['url_name'] // ✅ Added
        ];
    }
}

echo json_encode($data);