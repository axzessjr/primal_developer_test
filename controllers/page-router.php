<?php
// Function to render HTML content for each requested page
function view_page($page) {
    // Define the path to the requested page
    $file_path = "pages/{$page}.php";
    // Include any Controller
    if ($page == "products") {
        global $pdo;
        include "controllers/product-controller.php";
    }
    // Include the header
    include "pages/shared/header.php";
    // Check if the requested page exists
    if (file_exists($file_path)) {
        // Include the body content for the requested page
        include $file_path;
    } else {
        // Display this error page when requested page is not found 
        include "pages/shared/page-not-found.php";
    }
    // Include the footer
    include "pages/shared/footer.php";
}
?>