<!-- components/admin-sidebar.php -->

<?php
// You can set active page like: $active = 'dashboard';
?>

<aside class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white flex flex-col shadow-lg">

    <!-- Logo / Title -->
    <div class="p-6 text-2xl font-bold border-b border-gray-700">
        🍔 Admin Panel
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-2">

        <a href="/admin/dashboard.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            📊 Dashboard
        </a>

        <a href="/admin/orders.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'orders') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            📦 Orders
        </a>

        <a href="/admin/menu.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'menu') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            🍽️ Menu Items
        </a>

        <a href="/admin/customers.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'customers') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            👥 Customers
        </a>

        <!-- Reports -->
        <div class="mt-6 text-gray-400 text-sm uppercase">Reports</div>

        <a href="/admin/reports-sales.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'sales') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            💰 Sales Report
        </a>

        <a href="/admin/reports-orders.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'order_analytics') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            📈 Order Analytics
        </a>

        <a href="/admin/reports-customers.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'customer_insights') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            🧑‍🤝‍🧑 Customer Insights
        </a>

        <a href="/admin/reports-top-items.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'top_items') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            🔥 Top Selling Items
        </a>

        <!-- Settings -->
        <div class="mt-6 text-gray-400 text-sm uppercase">Settings</div>

        <a href="/admin/settings.php"
            class="block px-4 py-2 rounded-lg transition <?php echo ($active == 'settings') ? 'bg-gray-700' : 'hover:bg-gray-700'; ?>">
            ⚙️ Settings
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-700">
        <a href="/logout.php" class="block px-4 py-2 bg-red-500 text-center rounded-lg hover:bg-red-600 transition">
            🚪 Logout
        </a>
    </div>
</aside>