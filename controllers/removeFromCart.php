<?php
session_start();
require_once "../config/db.php";

if (isset($_POST['remove'])) {

    $cart_id = (int) $_POST['cart_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();

    $_SESSION['success'] = "Item removed from cart";

    header("Location: ../views/cart.php");
    exit;
}