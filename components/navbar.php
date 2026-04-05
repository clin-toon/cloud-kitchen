<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/db.php";

$BASE_URL = "/cloud_kitchen";
// Default cart count
$cartCount = 0;

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];

    $stmt = $conn->prepare("SELECT SUM(quantity) as total FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result1 = $stmt->get_result()->fetch_assoc();

    $cartCount = $result1['total'] ?? 0;
}
?>

<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        <!-- Logo -->
        <h1 class="text-2xl font-bold text-red-500">
            🍔 <a href="<?= $BASE_URL ?>/index.php">Foodie</a>
        </h1>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">

            <!-- Menu -->
            <a href="<?= $BASE_URL ?>/views/menu.php" class="text-gray-700 hover:text-red-500">
                Menu
            </a>

            <?php if (isset($_SESSION['user'])):

                ?>


                <!-- Orders -->
                <a href="#" class="text-gray-700 hover:text-red-500">
                    Orders
                </a>

                <!-- Cart -->
                <a href="<?= $BASE_URL ?>/views/cart.php" class="relative">
                    🛒

                    <?php if ($cartCount > 0): ?>
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>

                <a href="<?= $BASE_URL ?>/views/notifications.php" class="relative">
                    🔔
                    <span id="notifCount"
                        class="hidden absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                    </span>
                </a>

                <!-- Logout -->
                <a href="<?= $BASE_URL ?>/controllers/logout.php"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </a>

            <?php else: ?>

                <a href="<?= $BASE_URL ?>/views/login.php" class="text-gray-700 hover:text-red-500">
                    Login
                </a>

                <a href="<?= $BASE_URL ?>/views/signup.php"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Signup
                </a>

            <?php endif; ?>

        </div>

    </div>
</nav>

<script>
    function fetchNotifications() {
        fetch("<?= $BASE_URL ?>/api/getNotifications.php")
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById("notifCount");

                if (data.count > 0) {
                    badge.innerText = data.count;
                    badge.classList.remove("hidden");
                } else {
                    badge.classList.add("hidden");
                }
            })
            .catch(err => console.log(err));
    }

    // run every 5 seconds
    setInterval(fetchNotifications, 5000);

    // run once on load
    fetchNotifications();
</script>