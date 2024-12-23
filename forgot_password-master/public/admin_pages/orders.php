<?php
//session_start();
//
//if (!isset( $_SESSION['admin_id'])) {
//    header("Location: ../index.php");
//    exit();
//}
//
//require '../validate/conn.php';
//
//$sessionId =  $_SESSION['admin_id'];
//
//
//$sql = "SELECT * FROM staff WHERE staff.userId = ?";
//$stmt = mysqli_stmt_init($conn);
//if (!mysqli_stmt_prepare($stmt, $sql)) {
//    die("Database error.");
//} else {
//    mysqli_stmt_bind_param($stmt, "i", $sessionId);
//    mysqli_stmt_execute($stmt);
//    $result = mysqli_stmt_get_result($stmt);
//
//    if ($row = mysqli_fetch_assoc($result)) {
//        // Successfully fetched user data
//        // Store user data in variables
//        $username = htmlspecialchars($row['uName']);
//        $email = htmlspecialchars($row['mail']);
//        $profilePhoto = htmlspecialchars($row['profile_picture']);
//
//
//    } else {
//        // If user not found, redirect to login page
//        header("Location: ../index.php");
//        exit();
//    }
//
//}
//?>

<?php

require '../validate/conn.php';

$query = "SELECT order_id, name, email, total_price, payment_method, created_at FROM orders";
$result = $conn->query($query);

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

            if (errorMessage) {
                errorMessage.style.display = 'none';
            }

            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 2000);
    };
</script>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>

    <title>Orders</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            background-color: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>

</head>
<body>
<div class="flex bg-gray-50 dark:bg-gray-900 pb-16"
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
                        href="../admin_pages/orders.php"
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

    <div class="flex flex-col flex-1">

        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
            <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                <button
                        class="p-1 -ml-1 mr-5 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu"
                        aria-label="Menu"
                >
                    <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                    >
                        <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
                <ul class="flex items-center flex-shrink-0 space-x-6">
                    <!-- Theme toggler -->
                    <li class="flex">
                        <button
                                class="rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleTheme"
                                aria-label="Toggle color mode"
                        >
                            <template x-if="!dark">
                                <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                >
                                    <path
                                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                    ></path>
                                </svg>
                            </template>
                            <template x-if="dark">
                                <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </template>
                        </button>
                    </li>
                    <!-- Notifications menu -->
                    <li class="relative">
                        <button
                                class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleNotificationsMenu"
                                @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications"
                                aria-haspopup="true"
                        >
                            <svg
                                    class="w-5 h-5"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                            >
                                <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                                ></path>
                            </svg>
                            <!-- Notification badge -->
                            <span
                                    aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                            ></span>
                        </button>
                        <template x-if="isNotificationsMenuOpen">
                            <ul
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu"
                                    @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                                    aria-label="submenu"
                            >
                                <li class="flex">
                                    <a
                                            class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#"
                                    >
                                        <span>Messages</span>
                                        <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                                        >
                          13
                        </span>
                                    </a>
                                </li>
                                <li class="flex">
                                    <a
                                            class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#"
                                    >
                                        <span>Sales</span>
                                        <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                                        >
                          2
                        </span>
                                    </a>
                                </li>
                                <li class="flex">
                                    <a
                                            class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#"
                                    >
                                        <span>Alerts</span>
                                    </a>
                                </li>
                            </ul>
                        </template>
                    </li>
                </ul>
            </div>
        </header>


        <main class="h-full pb-16 overflow-y-auto">

            <h2  class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 ml-6"
            >Orders</h2>

            <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                <br>

                <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Order ID</th>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Name</th>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Email</th>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Total Price</th>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Payment Method</th>
                        <th class="border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-600 px-4 py-2">Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['order_id']; ?></td>
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['name']; ?></td>
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['email']; ?></td>
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['total_price'] . " $"; ?></td>
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['payment_method']; ?></td>
                            <td class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-4 py-2"><?php echo $order['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>

    </div>

</div>
</body>
</html>