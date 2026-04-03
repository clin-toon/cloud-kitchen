<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-red-500 to-orange-400 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl grid md:grid-cols-2 overflow-hidden">

        <!-- Left Side -->
        <div class="hidden md:flex flex-col justify-center items-center bg-red-500 text-white p-8">
            <h2 class="text-3xl font-bold mb-4">Join Foodie 🍔</h2>
            <p class="text-center">Order your favorite meals anytime, anywhere.</p>
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