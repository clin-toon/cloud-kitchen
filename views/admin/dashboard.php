<?php
session_start();
require_once "../../config/db.php";
require_once "../../middlewares/adminMiddleware.php";

// fetch all orders
$query = "
   SELECT 
    o.id,
    c.first_name,
    c.last_name,
    o.total_amount,
    o.status,
    o.created_at
FROM orders o
JOIN customers c 
    ON o.customer_id = c.credential_id
ORDER BY o.created_at DESC;
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <?php
    $active = 'dashboard';
    include "../../components/adminNavBar.php";
    ?>

    <!-- Main Content -->
    <div class="ml-64 min-h-screen p-6">

        <h1 class="text-3xl font-bold mb-6">Admin Dashboard 📊</h1>

        <div class="bg-white shadow rounded p-4 overflow-x-auto">

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-2">Order ID</th>
                        <th class="p-2">User</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-t hover:bg-gray-50">

                            <td class="p-2">#<?php echo $row['id']; ?></td>

                            <td class="p-2">
                                <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                            </td>

                            <td class="p-2">Rs. <?php echo $row['total_amount']; ?></td>

                            <td class="p-2">
                                <span class="px-2 py-1 rounded text-white text-sm
                                <?php
                                if ($row['status'] == 'pending')
                                    echo 'bg-yellow-500';
                                elseif ($row['status'] == 'preparing')
                                    echo 'bg-blue-500';
                                elseif ($row['status'] == 'delivered')
                                    echo 'bg-green-500';
                                else
                                    echo 'bg-red-500';
                                ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>

                            <td class="p-2 space-x-2">

                                <!-- View -->
                                <a href="orderDetails.php?id=<?php echo $row['id']; ?>"
                                    class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">
                                    View
                                </a>

                                <!-- Update -->
                                <form action="../../controllers/adminController.php" method="POST" class="inline">

                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

                                    <select name="status" class="border p-1 rounded">
                                        <option value="pending">Pending</option>
                                        <option value="preparing">Preparing</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>

                                    <button type="submit" name="update_status"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Update
                                    </button>

                                </form>

                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>

        </div>

    </div>

</body>

</html>