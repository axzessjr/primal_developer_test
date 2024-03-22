<?php
    // Define static cache file version variable
    $cache_version = "1.004";
    /* START: Main Variables and Functions */
    define("URL_PATH","https://www.nudnong.com");
    define("STATIC_PATH","https://www.nudnong.com/static");
    define("URL_CSS",STATIC_PATH."/css");
    define("URL_IMAGE",STATIC_PATH."/images");
    /* END: Main Variables and Functions */
    
    // Define Page variable from GET request
    $requested_page = isset($_GET["page_name"]) ? $_GET["page_name"] : "";
    if ($requested_page == "") {
        // Set default landing page incase no specified page request
        $requested_page = "earthquake";
    }
    // Import page router controller
    include "controllers/page-router.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Test</title>
    <?php
        // Load specific scripts when necessary
        if ($requested_page == "earthquake") { ?>
            <!-- Load the Google Maps JavaScript API -->
            <script src="<?=URL_PATH?>/static/js/geo-map-request.js?v=<?=$cache_version?>"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key={MY_API_KEYS}&callback=initMap"></script>
        <? } else { ?>
            <!-- Load JS Script for products -->
            <script src="<?=URL_PATH?>/static/js/product.js?v=<?=$cache_version?>"></script>
            <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans:400,500,700|Google+Sans+Text:400&amp;lang=en">
        <? }
    ?>
    <script src="https://kit.fontawesome.com/28a480d5a0.js" crossorigin="anonymous"></script>
    <!-- Load Static files and Assets -->
    <script src="<?=URL_PATH?>/static/js/main.js?v=<?=$cache_version?>"></script>
    <link rel="stylesheet" href="<?=URL_CSS?>/main.css?v=<?=$cache_version?>">
</head>
<body>
    <div class="bodyContainer">
    <?php
        // Call Page Route function
        view_page ($requested_page);
    ?>
    </div>
</body>
</html>