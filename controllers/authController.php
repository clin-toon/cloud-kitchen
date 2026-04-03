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
        $_SESSION['signup'] = "Sign up error! Email or username already exists. ";
        header("Location: ../views/signup.php");
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

        $_SESSION['signup'] = "Sign up successfull";
        header("Location: ../views/signup.php");


    } catch (Exception $e) {

        // ROLLBACK if error
        $conn->rollback();
        echo "Signup failed!";
        header("Location: ../views/login.php");
    }
}




// Logic for login
if (isset($_POST['login'])) {

    $input = trim($_POST['username']); // can be email or username
    $password = $_POST['password'];

    if (empty($input) || empty($password)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../views/login.php");
        exit;
    }

    // Fethcing the user information with join to check wherther email or username exists or not
    $stmt = $conn->prepare("
        SELECT 
            c.id AS credential_id,
            c.username,
            c.email,
            c.password,
            cu.first_name,
            cu.last_name,
            cu.address,
            cu.phone
        FROM credentials c
        JOIN customers cu ON c.id = cu.credential_id
        WHERE c.email = ? OR c.username = ?
        LIMIT 1
    ");

    // Using paramterized statments to prevent SQL injection

    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = "Invalid credentials! ";
        header("Location: ../views/login.php");
        exit;
    }

    $user = $result->fetch_assoc();

    // Verify the provided password with the existing password in the database 
    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Invalid credentials!";
        header("Location: ../views/login.php");
        exit;
    }

    // Session Security 
    session_regenerate_id(true);

    // Store user data
    $_SESSION['user'] = [
        'id' => $user['credential_id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name'],
        'address' => $user['address'],
        'phone' => $user['phone']
    ];

    $_SESSION['success'] = "Hi, " . $user['first_name'];

    // Redirect
    header("Location: ../index.php");
    exit;
}