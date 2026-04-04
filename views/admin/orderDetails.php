<?php
session_start();
require_once "../../config/db.php";

$order_id = $_GET['id'];

$query = "
    SELECT oi.*, m.name 
    FROM order_items oi
    JOIN menu_items m ON oi.item_id = m.id
    WHERE oi.order_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6">

    <h2 class="text-2xl font-bold mb-4">Order #
        <?php echo $order_id; ?>
    </h2>

    <div class="bg-white p-4 shadow rounded">

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="flex justify-between border-b py-2">
                <span>
                    <?php echo $row['name']; ?> (x
                    <?php echo $row['quantity']; ?>)
                </span>
                <span>Rs.
                    <?php echo $row['price']; ?>
                </span>
            </div>
        <?php endwhile; ?>

    </div>

</body>

</html>