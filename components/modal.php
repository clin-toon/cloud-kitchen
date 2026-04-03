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
<?php endif; ?>