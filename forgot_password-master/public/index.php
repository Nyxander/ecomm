<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SRMS Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="assets/js/init-alpine.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">

<div class="flex items-center min-h-screen p-6">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/login-office.jpeg" alt="Office" />
                <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="assets/img/login-office-dark.jpeg" alt="Office" />
            </div>

            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full" x-data="{ activeTab: 1 }">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Login</h1>

                    <!-- Tabs Navigation -->
                    <div class="flex mb-4 border-b border-gray-200">
                        <button
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border-b-2 border-transparent hover:border-purple-600"
                                :class="{'border-purple-600': activeTab === 1}"
                                @click="activeTab = 1"
                        >
                            Login as Admin
                        </button>
                        <button
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 border-b-2 border-transparent hover:border-green-600"
                                :class="{'border-green-600': activeTab === 2}"
                                @click="activeTab = 2"
                        >
                            Login as User
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div x-show="activeTab === 1" x-transition x-cloak>
                        <form action="validate/login_inc.php" method="post">
                            <h2 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Login as Admin</h2>

                            <!-- Display any error message -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="mb-4 text-sm text-red-600">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email / Username</span>
                                <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Enter your username"
                                        name="uName"
                                />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Enter your password"
                                        name="password"
                                        type="password"
                                />
                            </label>

                            <button
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                    name="submitAdmin"
                                    type="submit"
                            >
                                Log in as Admin
                            </button>
                        </form>
                    </div>

                    <div x-show="activeTab === 2" x-transition x-cloak>
                        <form action="validate/login_inc.php" method="post">
                            <h2 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Login as User</h2>

                            <!-- Display any error message -->
                            <?php if (isset($_SESSION['error'])): ?>
                                <div class="mb-4 text-sm text-red-600">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email / Username</span>
                                <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Enter your username"
                                        name="uName"
                                />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Enter your password"
                                        name="password"
                                        type="password"
                                />
                            </label>

                            <button
                                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" name="submitUser"
                                    type="submit"
                            >
                                Log in as User
                            </button>
                        </form>
                    </div>

                    <hr class="my-8" />

                    <p class="mt-4" x-show="activeTab === 2" x-transition>
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="pages/forgot-password.php">
                            Forgot your password?
                        </a>
                    </p>
                    <p class="mt-1" x-show="activeTab === 2" x-transition>
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="create-account.php">
                            Create account
                        </a>
                    </p>
                    <p class="mt-4" x-show="activeTab === 1" x-transition>
                        <br>
                    </p>
                    <p class="mt-1" x-show="activeTab === 1" x-transition>
                       <br>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
