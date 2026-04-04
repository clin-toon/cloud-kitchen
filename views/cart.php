<?php
session_start();
require_once "../config/db.php";

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first!";
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// Fetch cart items with menu details
$stmt = $conn->prepare("
    SELECT c.id as cart_id, c.quantity, m.name, m.price, m.image
    FROM cart c
    JOIN menu_items m ON c.item_id = m.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$BASE_URL = "/cloud_kitchen";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include "../components/modal.php"; ?>

<body class="bg-gray-100">

    <?php include "../components/navbar.php"; ?>

    <div class="mt-24 max-w-5xl mx-auto p-6">

        <h2 class="text-3xl font-bold mb-6">Your Cart 🛒</h2>

        <?php if ($result->num_rows > 0): ?>

            <div class="space-y-4">

                <?php while ($row = $result->fetch_assoc()):
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                    ?>

                    <!-- Cart Item -->
                    <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">

                        <div class="flex items-center space-x-4">
                            <img src="<?php echo $row['image']; ?>" class="w-20 h-20 object-cover rounded">

                            <div>
                                <h3 class="font-semibold text-lg">
                                    <?php echo $row['name']; ?>
                                </h3>
                                <p class="text-gray-500">Rs.
                                    <?php echo $row['price']; ?>
                                </p>
                                <p class="text-sm text-gray-600">Qty:
                                    <?php echo $row['quantity']; ?>
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-red-500 mb-2">
                                Rs.
                                <?php echo $subtotal; ?>
                            </p>

                            <!-- Remove Button -->
                            <form action="../controllers/removeFromCart.php" method="POST">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <button type="submit" name="remove" class="text-sm text-red-500 hover:underline">
                                    Remove
                                </button>
                            </form>
                        </div>

                    </div>

                <?php endwhile; ?>

            </div>

            <!-- Total Section -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow flex justify-between items-center">
                <h3 class="text-xl font-bold">Total</h3>
                <span class="text-2xl font-bold text-red-500">
                    Rs.
                    <?php echo $total; ?>
                </span>
            </div>

            <!-- Checkout Button -->
            <div class="mt-4 text-right">
                <a href="<?= $BASE_URL ?>/views/checkout.php">

                    <button class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">
                        Proceed to Checkout
                    </button>
                </a>
            </div>

        <?php else: ?>

            <!-- Empty State -->
            <div class="text-center mt-10">
                <p class="text-gray-500 text-lg">Your cart is empty 😢</p>
                <a href="menu.php" class="text-red-500 mt-2 inline-block">Go to Menu</a>
            </div>

        <?php endif; ?>

    </div>

</body>

</html>