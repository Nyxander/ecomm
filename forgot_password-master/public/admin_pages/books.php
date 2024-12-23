<?php
session_start();

if (!isset( $_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}

require '../validate/conn.php';

$sessionId =  $_SESSION['admin_id'];


$sql = "SELECT * FROM staff WHERE staff.userId = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("Database error.");
} else {
    mysqli_stmt_bind_param($stmt, "i", $sessionId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Successfully fetched user data
        // Store user data in variables
        $username = htmlspecialchars($row['uName']);
        $email = htmlspecialchars($row['mail']);
        $profilePhoto = htmlspecialchars($row['profile_picture']);


    } else {
        // If user not found, redirect to login page
        header("Location: ../index.php");
        exit();
    }
}
?>

<?php if (isset($_SESSION['error'])): ?>
    <div id="error-message" style="color: red;"><?= $_SESSION['error']; ?></div>
    <?php unset($_SESSION['error']); ?> <!-- Clear error after displaying -->
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div id="success-message" style="color: green;"><?= $_SESSION['success']; ?></div>
    <?php unset($_SESSION['success']); ?> <!-- Clear success after displaying -->
<?php endif; ?>

<script>
    window.onload = function() {
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            var successMessage = document.getElementById('success-message');

            // Hide error message if it exists
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }

            // Hide success message if it exists
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    };
</script>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SRMS Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <title>Book Keeper Dashboard</title>

</head>
<body>
<div class="flex h-screen bg-gray-50 dark:bg-gray-900"
     :class="{ 'overflow-hidden': isSideMenuOpen}" >

    <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800
        md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a
                class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                href="#"
            >
                Book Keepers
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3">

                    <a class="inline-flex items-center w-full text-sm
              font-semibold transition-colors duration-150
              hover:text-gray-800 dark:hover:text-gray-200"
                       href="../dashboard/dashboard.php">
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor" >
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            ></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3">
                    <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        href="../admin_pages/orders.html"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                            ></path>
                        </svg>
                        <span class="ml-4">Orders</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        href="../admin_pages/books.php"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                            ></path>
                        </svg>
                        <span class="ml-4">Books</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        href="../admin_pages/customers.php"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                            ></path>
                            <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        <span class="ml-4">Customers</span>
                    </a>
                </li>



            </ul>

        </div>

    </aside>

    <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>

</div>
</body>
</html>
