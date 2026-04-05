<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    echo json_encode(['count' => 0]);
    exit;
}

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM notifications 
    WHERE user_id = ? AND is_read = 0
");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result()->fetch_assoc();

echo json_encode([
    'count' => $result['total']
]);