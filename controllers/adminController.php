<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Unauthorized");
}

if (isset($_POST['update_status'])) {

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // update order
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();

    // 🔥 GET USER ID OF THAT ORDER
    $userQuery = $conn->prepare("SELECT customer_id FROM orders WHERE id = ?");
    $userQuery->bind_param("i", $order_id);
    $userQuery->execute();
    $result = $userQuery->get_result()->fetch_assoc();

    $user_id = $result['customer_id'];

    // 🔥 CREATE MESSAGE
    $message = "Your order #$order_id has been $status";

    // 🔥 INSERT NOTIFICATION
    $notifStmt = $conn->prepare("
        INSERT INTO notifications (user_id, message)
        VALUES (?, ?)
    ");
    $notifStmt->bind_param("is", $user_id, $message);
    $notifStmt->execute();

    header("Location: ../views/admin/dashboard.php");
    exit;

}

