<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" min-h-screen flex items-center justify-center">

    <nav class="bg-white shadow-md fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-red-500">🍔 <a href="../index.php">Foodie</a></h1>


            <div class="space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="#" class="text-gray-700 hover:text-red-500">Menu</a>
                    <a href="#" class="text-gray-700 hover:text-red-500">Orders</a>
                    <a href="controllers/logout.php" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
                <?php else: ?>
                    <a href="./login.php" class="text-gray-700 hover:text-red-500">Login</a>
                    <a href="views/signup.php" class="bg-red-500 text-white px-4 py-2 rounded">Signup</a>
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl grid md:grid-cols-2 overflow-hidden">

        <!-- Left Side -->
        <div class="hidden md:flex flex-col justify-center items-center text-white p-8 
            bg-[url('https://images.unsplash.com/photo-1504674900247-0877df9cc836')] 
            bg-cover bg-center relative">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Content -->
            <div class="relative z-10 text-center">
                <h2 class="text-3xl font-bold mb-4">Join Foodie 🍔</h2>
                <p>Order your favorite meals anytime, anywhere.</p>
            </div>

        </div>

        <!-- Right Side Form -->
        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Create Account</h2>

            <form action="../controllers/authController.php" method="POST" class="space-y-4">

                <!-- Credentials -->
                <input type="text" name="username" placeholder="Username"
                    class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>

                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>

                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>

                <!-- Customer Info -->
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="first_name" placeholder="First Name" class="p-3 border rounded" required>
                    <input type="text" name="last_name" placeholder="Last Name" class="p-3 border rounded" required>
                </div>

                <input type="text" name="address" placeholder="Address" class="w-full p-3 border rounded" required>

                <input type="text" name="phone" placeholder="Phone Number" class="w-full p-3 border rounded" required>

                <button type="submit" name="signup"
                    class="w-full bg-red-500 text-white p-3 rounded font-semibold hover:bg-red-600 transition">
                    Sign Up
                </button>

                <p class="text-center text-sm">
                    Already have an account?
                    <a href="login.php" class="text-red-500 font-semibold">Login</a>
                </p>

            </form>
        </div>

    </div>

</body>

</html>