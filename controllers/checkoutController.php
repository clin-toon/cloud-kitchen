<?php
session_start();
require_once "../config/db.php";

if (isset($_POST['place_order'])) {

    if (!isset($_SESSION['user'])) {
        $_SESSION['error'] = "Please login first!";
        header("Location: ../views/login.php");
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Fetch cart items
    $stmt = $conn->prepare("
        SELECT c.item_id, c.quantity, m.price
        FROM cart c
        JOIN menu_items m ON c.item_id = m.id
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $cartItems = $stmt->get_result();

    if ($cartItems->num_rows === 0) {
        $_SESSION['error'] = "Cart is empty!";
        header("Location: ../views/cart.php");
        exit;
    }

    $conn->begin_transaction();

    try {

        $total = 0;

        // Calculate total
        $items = [];
        while ($row = $cartItems->fetch_assoc()) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            $items[] = $row;
        }

        // Insert order
        $orderStmt = $conn->prepare("INSERT INTO orders (customer_id, total_amount, address, phone) VALUES (?, ?, ?, ?)
");

        $orderStmt->bind_param("idss", $user_id, $total, $address, $phone);
        $orderStmt->execute();

        $order_id = $orderStmt->insert_id;

        // Insert order items
        $itemStmt = $conn->prepare("
            INSERT INTO order_items (order_id, item_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ");

        foreach ($items as $item) {
            $itemStmt->bind_param(
                "iiid",
                $order_id,
                $item['item_id'],
                $item['quantity'],
                $item['price']
            );
            $itemStmt->execute();
        }

        // Clear cart
        $clearCart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clearCart->bind_param("i", $user_id);
        $clearCart->execute();

        $conn->commit();

        $_SESSION['success'] = "Order placed successfully! ";

        header("Location: ../views/menu.php");
        exit;

    } catch (Exception $e) {
        echo $e;

        $conn->rollback();
        $_SESSION['error'] = "Order failed! $e";
        header("Location: ../views/cart.php");
        exit;
    }
}