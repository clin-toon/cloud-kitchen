<?php
session_start();
require_once "../config/db.php";

// SIGNUP
// SIGNUP
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if email or username exists
    $check = $conn->prepare("SELECT id FROM credentials WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "Email or Username already exists!";
        exit;
    }

    // START TRANSACTION 🔥
    $conn->begin_transaction();

    try {

        // insert into credentials
        $stmt1 = $conn->prepare("INSERT INTO credentials (username, email, password) VALUES (?, ?, ?)");
        $stmt1->bind_param("sss", $username, $email, $hashedPassword);
        $stmt1->execute();

        $credential_id = $stmt1->insert_id;

        // insert into customers
        $stmt2 = $conn->prepare("INSERT INTO customers (credential_id, first_name, last_name, address, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issss", $credential_id, $first_name, $last_name, $address, $phone);
        $stmt2->execute();

        // COMMIT
        $conn->commit();

        echo "Signup successful!";
        // header("Location: ../views/login.php");

    } catch (Exception $e) {

        // ROLLBACK if error
        $conn->rollback();
        echo "Signup failed!";
    }
}


// Login logic 
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // verify password
        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }

    } else {
        echo "User not found!";
    }
}