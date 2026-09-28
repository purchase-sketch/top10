<?php
// api_upload.php
header('Content-Type: application/json');
require 'db.php';

// JSON payload receive karna
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['rows']) || empty($input['rows'])) {
    echo json_encode(["success" => false, "message" => "No data provided."]);
    exit;
}

$rows = $input['rows'];
$insertedCount = 0;

try {
    $pdo->beginTransaction();
    
    $sql = "INSERT INTO sales_stock (location_alias, section_name, department, sub_section_name, sub_section_2, major_category, article_name, price_range, sub_price_range, sub_major_category, brand_name, style_name, fabric, size_name, color_name, net_sls_qty, cbs_qty, report_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $pdo->prepare($sql);

    foreach ($rows as $row) {
        $stmt->execute([
            $row['location_alias'], $row['section_name'], $row['department'], 
            $row['sub_section_name'], $row['sub_section_2'], $row['major_category'], 
            $row['article_name'], $row['price_range'], $row['sub_price_range'], 
            $row['sub_major_category'], $row['brand_name'], $row['style_name'], 
            $row['fabric'], $row['size_name'], $row['color_name'], 
            $row['net_sls_qty'], $row['cbs_qty'], $row['report_date']
        ]);
        $insertedCount++;
    }
    
    $pdo->commit();
    echo json_encode(["success" => true, "message" => "Successfully inserted $insertedCount rows!"]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>