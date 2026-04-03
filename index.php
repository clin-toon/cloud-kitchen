<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Food App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- 🔥 Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-red-500">🍔 <a href="../../index.php">Foodie</a></h1>


            <div class="space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="#" class="text-gray-700 hover:text-red-500">Menu</a>
                    <a href="#" class="text-gray-700 hover:text-red-500">Orders</a>
                    <a href="controllers/logout.php" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
                <?php else: ?>
                    <a href="views/login.php" class="text-gray-700 hover:text-red-500">Login</a>
                    <a href="views/signup.php" class="bg-red-500 text-white px-4 py-2 rounded">Signup</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <!-- 🔥 Hero Section -->
    <section class="pt-24 pb-16 bg-gradient-to-r from-red-500 to-orange-400 text-white">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Delicious Food Delivered To Your Door 🚀
                </h1>
                <p class="mb-6 text-lg">
                    Order your favorite meals from top restaurants in minutes.
                </p>

                <a href="#" class="bg-white text-red-500 px-6 py-3 rounded font-semibold hover:bg-gray-100">
                    Order Now
                </a>
            </div>

            <div>
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836"
                    class="rounded-xl shadow-lg w-full object-cover h-80">
            </div>

        </div>
    </section>

    <!-- 🔥 Categories -->
    <section class="py-12 max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Popular Categories</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white p-4 rounded shadow hover:shadow-lg cursor-pointer text-center">
                🍕 Pizza
            </div>
            <div class="bg-white p-4 rounded shadow hover:shadow-lg text-center">
                🍔 Burgers
            </div>
            <div class="bg-white p-4 rounded shadow hover:shadow-lg text-center">
                🍜 Asian
            </div>
            <div class="bg-white p-4 rounded shadow hover:shadow-lg text-center">
                🥗 Healthy
            </div>
        </div>
    </section>

    <!-- 🔥 Food Cards -->
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">

            <h2 class="text-2xl font-bold mb-6">Featured Foods</h2>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Cheese Burger</h3>
                        <p class="text-gray-600 text-sm">Juicy grilled burger with cheese</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-red-500 font-bold">$5.99</span>
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Healthy Salad</h3>
                        <p class="text-gray-600 text-sm">Fresh organic vegetables</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-red-500 font-bold">$4.99</span>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">Pizza</h3>
                        <p class="text-gray-600 text-sm">Cheesy delight loaded with toppings</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-red-500 font-bold">$7.99</span>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Add
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 🔥 CTA -->
    <section class="py-16 text-center bg-red-500 text-white">
        <h2 class="text-3xl font-bold mb-4">Hungry? Order Now 🍽️</h2>
        <p class="mb-6">Fast delivery at your doorstep</p>
        <a href="#" class="bg-white text-red-500 px-6 py-3 rounded font-semibold">
            Explore Menu
        </a>
    </section>

    <!-- 🔥 Footer -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© 2026 Foodie. All rights reserved.</p>
    </footer>

</body>

</html>