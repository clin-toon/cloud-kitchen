<?php
session_start();
require_once "../config/db.php";

// SIGNUP
if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if email exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists!";
        exit;
    }

    // insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Signup successful!";
    } else {
        echo "Error occurred!";
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