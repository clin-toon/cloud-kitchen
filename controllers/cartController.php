<?php
session_start();
require_once "../config/db.php";


if (isset($_POST['add_to_cart'])) {

    /*
    Checking if the user is logged in or not to update the cart. 
    If not logged in then redirecting user to log in.
    If logged in then user is able to proceed further 
    */
    if (!isset($_SESSION['user'])) {
        $_SESSION['error'] = "Please log in first!";
        header("Location: ../views/menu.php");
        exit;
    }

    // Validating the user input 

    $user_id = $_SESSION['user']['id'];
    $item_id = isset($_POST['item_id']) ? (int) $_POST['item_id'] : 0;
    $qty = isset($_POST['qty']) ? (int) $_POST['qty'] : 1;

    if ($item_id <= 0 || $qty <= 0) {
        $_SESSION['error'] = "Invalid request!";
        header("Location: ../views/menu.php");
        exit;
    }

    try {

        // Checking if the customer has already added the item in the  cart
        $check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND item_id = ?");
        $check->bind_param("ii", $user_id, $item_id);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {

            // 🔁 Update quantity
            $row = $result->fetch_assoc();
            $newQty = $row['quantity'] + $qty;

            $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $update->bind_param("ii", $newQty, $row['id']);
            $update->execute();

        } else {

            // Inserting new item if the item does not exists 
            $insert = $conn->prepare("INSERT INTO cart (user_id, item_id, quantity) VALUES (?, ?, ?)");
            $insert->bind_param("iii", $user_id, $item_id, $qty);
            $insert->execute();
        }

        $_SESSION['success'] = "Item added to cart ";

    } catch (Exception $e) {
        $_SESSION['error'] = "Something went wrong!";
    }

    // 🔄 Redirect back to menu
    header("Location: ../views/menu.php");
    exit;
}