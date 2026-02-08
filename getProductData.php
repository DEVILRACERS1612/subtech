<?php
header('Content-Type: application/json');
include 'config/config.inc.php'; // mysqli connection as $conn

$productData = [];
/*$sql = "
SELECT 
  c.id AS cat_id, c.cat_name AS cat_name, c.url_name AS cat_slug,
  s.id AS sub_id, s.subcat_name AS sub_name, s.url_name AS sub_slug,
  t.id AS type_id, t.cat_name AS type_name, t.url_name AS type_slug
FROM mi_product p
JOIN mi_category c ON p.cat_id = c.id
JOIN mi_subcategory s ON p.subcat_id = s.id
JOIN mi_ptype t ON p.ptype = t.id
WHERE p.mi_status = 'Yes' and p.web_status='Yes'
GROUP BY c.id, s.id, t.id
ORDER BY c.cat_name, s.subcat_name, t.cat_name
";*/

$sql = "
SELECT DISTINCT
  c.id AS cat_id,
  c.cat_name AS cat_name,
  c.url_name AS cat_slug,
  s.id AS sub_id,
  s.subcat_name AS sub_name,
  s.url_name AS sub_slug,
  t.id AS type_id,
  t.cat_name AS type_name,
  t.url_name AS type_slug
FROM mi_product p
INNER JOIN mi_wproduct wp on wp.urlname=p.url_name
INNER JOIN mi_category c ON p.cat_id = c.id
INNER JOIN mi_subcategory s ON p.subcat_id = s.id
INNER JOIN mi_ptype t ON p.ptype = t.id
WHERE p.mi_status = 'Yes'
  AND c.mi_status = 'Yes'
  AND s.mi_status = 'Yes'
  AND t.mi_status = 'Yes'
ORDER BY c.cat_name, s.subcat_name, t.cat_name;
";


$result = $db->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cat = [
            'name' => $row['cat_name'],
            'slug' => $row['cat_slug']
        ];
        $sub = [
            'name' => $row['sub_name'],
            'slug' => $row['sub_slug']
        ];
        $type = [
            'name' => $row['type_name'],
            'slug' => $row['type_slug']
        ];

        // Build hierarchy with slugs
        $catKey = $cat['name'];
        $subKey = $sub['name'];

        if (!isset($productData[$catKey])) {
            $productData[$catKey] = ['slug' => $cat['slug'], 'subcategories' => []];
        }

        if (!isset($productData[$catKey]['subcategories'][$subKey])) {
            $productData[$catKey]['subcategories'][$subKey] = ['slug' => $sub['slug'], 'types' => []];
        }

        $productData[$catKey]['subcategories'][$subKey]['types'][] = [
            'name' => $type['name'],
            'slug' => $type['slug']
        ];
    }
}

echo json_encode($productData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>