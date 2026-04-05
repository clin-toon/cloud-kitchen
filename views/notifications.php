<?php
session_start();
require_once "../config/db.php";

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("
    SELECT * FROM notifications 
    WHERE user_id = ?
    ORDER BY created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// mark all as read
$stmt = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <?php include "../components/navbar.php"; ?>

    <h2 class="text-2xl font-bold mb-4">Notifications 🔔</h2>

    <div class="space-y-3">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="bg-white p-4 shadow rounded">
                <p>
                    <?= $row['message'] ?>
                </p>
                <small class="text-gray-500">
                    <?= $row['created_at'] ?>
                </small>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>