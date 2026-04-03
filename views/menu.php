<?php
session_start();
require_once "../config/db.php";

// fetch food items
$result = $conn->query("SELECT * FROM menu_items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu Page - Ghar ko khana </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>

    <!-- Overlay -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <!-- Modal Box -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-80 text-center animate-fade-in">

            <?php if (isset($_SESSION['success'])): ?>
                <h2 class="text-green-500 text-xl font-bold mb-2">Success 🎉</h2>
                <p class="text-gray-600">
                    <?php echo $_SESSION['success']; ?>
                </p>
                <?php unset($_SESSION['success']); endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <h2 class="text-red-500 text-xl font-bold mb-2">Error ⚠️</h2>
                <p class="text-gray-600">
                    <?php echo $_SESSION['error']; ?>
                </p>
                <?php unset($_SESSION['error']); endif; ?>

            <button onclick="closeModal()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Close
            </button>

        </div>
    </div>

<?php endif; ?>

<body class="bg-gray-100">

    <!-- Navbar -->
    <?php include "../components/navbar.php"; ?>

    <!-- Menu Grid -->
    <div class="max-w-6xl mx-auto p-6 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-10">

        <?php
        while ($row = $result->fetch_assoc()): ?>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                <!-- Image -->
                <img src="<?php echo $row['image']; ?>" class="w-full h-40 object-cover">
                <!-- Content -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold">
                        <?php echo $row['name']; ?>
                    </h3>
                    <p class="text-gray-500 text-sm mb-2">
                        <?php echo substr($row['description'], 0, 60); ?>...
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-red-500 font-bold text-lg">
                            Rs.
                            <?php echo $row['price']; ?>
                        </span>

                        <form action="../controllers/cartController.php" method="POST">
                            <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="add_to_cart"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Add
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        <?php endwhile; ?>

    </div>

    <script>
        function closeModal() {
            document.getElementById("modalOverlay").style.display = "none";
        }

        // Auto close after 2.5 sec 🔥
        setTimeout(() => {
            const modal = document.getElementById("modalOverlay");
            if (modal) modal.style.display = "none";
        }, 2500);
    </script>

</body>

</html>