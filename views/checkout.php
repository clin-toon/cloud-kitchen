<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first!";
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// fetch cart items
$stmt = $conn->prepare("
    SELECT c.id, c.quantity, m.name, m.price
    FROM cart c
    JOIN menu_items m ON c.item_id = m.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <?php include "../components/navbar.php"; ?>

    <div class="mt-24 max-w-4xl mx-auto p-6">

        <h2 class="text-3xl font-bold mb-6">Checkout 🧾</h2>

        <div class="bg-white p-6 rounded shadow">

            <!-- Order Summary -->
            <h3 class="text-xl font-semibold mb-4">Order Summary</h3>

            <div class="space-y-3">
                <?php while ($row = $result->fetch_assoc()):
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                    ?>
                    <div class="flex justify-between">
                        <span><?php echo $row['name']; ?> (x<?php echo $row['quantity']; ?>)</span>
                        <span>Rs. <?php echo $subtotal; ?></span>
                    </div>
                <?php endwhile; ?>
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-xl font-bold">
                <span>Total</span>
                <span class="text-red-500">Rs. <?php echo $total; ?></span>
            </div>

            <!-- Customer Info -->
            <form action="../controllers/checkoutController.php" method="POST" class="mt-6 space-y-4">

                <input type="text" name="address"
                    placeholder="Please paste your exact location (Google Maps link) for accurate delivery"
                    class="w-full p-3 border rounded" required>

                <input type="text" name="phone" placeholder="Phone Number" class="w-full p-3 border rounded" required>

                <button type="submit" name="place_order"
                    class="w-full bg-red-500 text-white p-3 rounded hover:bg-red-600">
                    Place Order 🚀
                </button>

            </form>

        </div>

    </div>

</body>

</html>