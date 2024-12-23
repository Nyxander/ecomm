<!DOCTYPE>

<?php
$con = mysqli_connect("localhost", "root", "your_password", "ecom");

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());  // Show a detailed error message if the connection fails
}

if(isset($_POST['insert_post'])){
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);
    $product_author = mysqli_real_escape_string($con, $_POST['author']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);

    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    if (!file_exists('assets/img')) {
        mkdir('assets/img', 0777, true);
    }

    // Sanitize file name to avoid issues with special characters
    $product_image = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $product_image);  // Replace special characters

    if (move_uploaded_file($product_image_tmp, "../assets/img/$product_image")) {
        // Prepare the SQL query to insert product data into the database
        $insert_product = "INSERT INTO `Books`(`author`, `keywords`, `title`, `price`, `image`, `description`, `category`) 
                           VALUES ('$product_author','$product_keywords','$product_title','$product_price','$product_image','$product_desc','$product_cat')";

        $insert_pro = mysqli_query($con, $insert_product);

        if($insert_pro){
            echo "Product has been inserted!";
            echo "<script>window.open('inbooks.php','_self')</script>";
        } else {
            echo "Error: " . mysqli_error($con);  // Show specific error if the query fails
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserting Product</title>
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({ selector: 'textarea' });
    </script>
    <!-- Tailwind CSS or other link if you are using it -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100 font-sans">

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
            <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
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
        </header

        <main class="h-full pb-10 overflow-y-auto">
            <div class="flex justify-center py-12">
                <form action="inbooks.php" method="post" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-8">
                    <h2 class="text-center text-3xl font-bold text-gray-700 mb-8">Insert New Product</h2>

                    <!-- Author -->
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700">Author:</label>
                        <input type="text" id="author" name="author" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Product Keywords -->
                    <div class="mb-4">
                        <label for="product_keywords" class="block text-gray-700">Product Keywords:</label>
                        <input type="text" id="product_keywords" name="product_keywords" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Product Title -->
                    <div class="mb-4">
                        <label for="product_title" class="block text-gray-700">Product Title:</label>
                        <input type="text" id="product_title" name="product_title" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="product_price" class="block text-gray-700">Product Price:</label>
                        <input type="text" id="product_price" name="product_price" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Product Image -->
                    <div class="mb-4">
                        <label for="product_image" class="block text-gray-700">Product Image:</label>
                        <input type="file" id="product_image" name="product_image" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="product_desc" class="block text-gray-700">Product Description:</label>
                        <textarea id="product_desc" name="product_desc" cols="20" rows="10" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="product_cat" class="block text-gray-700">Product Category:</label>
                        <select id="product_cat" name="product_cat" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Select a Category</option>
                            <?php
                            // Make sure the connection to the database is established
                            $con = mysqli_connect("localhost", "root", "your_password", "ecom");
                            if (!$con) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $get_cats = "SELECT * FROM category";
                            $run_cats = mysqli_query($con, $get_cats);

                            if (!$run_cats) {
                                die("Query failed: " . mysqli_error($con));
                            }

                            while ($row_cats = mysqli_fetch_array($run_cats)) {
                                $cat_title = $row_cats['name'];  // Ensure 'name' is the correct column name
                                echo "<option value='$cat_title'>$cat_title</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <input type="submit" name="insert_post" value="Insert Product Now" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>




</body>
</html>
