<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Unauthorized");
}

if (isset($_POST['update_status'])) {

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();

    header("Location: ../views/admin/dashboard.php");
    exit;
}