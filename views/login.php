<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <form action="../controllers/authController.php" method="POST" class="bg-white p-6 rounded shadow w-80">
        <h2 class="text-xl mb-4">Login</h2>

        <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border" required>
        <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border" required>

        <button type="submit" name="login" class="w-full bg-green-500 text-white p-2">Login</button>
    </form>

</body>

</html>