<?php
// db.php
$host = getenv('DB_HOST') ?: 'aws-0-region.pooler.supabase.com'; // Apna host daalein
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'postgres';
$user = getenv('DB_USER') ?: 'postgres.xxx'; // Apna user daalein
$password = getenv('DB_PASS') ?: 'your_password'; // Apna password daalein

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die(json_encode(["error" => "Database Connection Failed: " . $e->getMessage()]));
}
?>
