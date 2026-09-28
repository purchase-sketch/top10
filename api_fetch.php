<?php
// api_fetch.php
header('Content-Type: application/json');
require 'db.php';

$startDate = isset($_GET['start_date']) && !empty($_GET['start_date']) ? $_GET['start_date'] : null;
$endDate = isset($_GET['end_date']) && !empty($_GET['end_date']) ? $_GET['end_date'] : null;

try {
    // Calling PostgreSQL function (RPC equivalent in PHP)
    $sql = "SELECT * FROM get_pivot_summary(:start_date, :end_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':start_date' => $startDate,
        ':end_date' => $endDate
    ]);
    
    $data = $stmt->fetchAll();
    echo json_encode(["data" => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
