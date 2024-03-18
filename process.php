<?php
    // Start or resume the session
    session_start();
    // Configuration
    $pre_dir_php = "../";
    // include "models/db_connect.php";
    include "controllers/product-controller.php";

    // Get the current date and time
    $currentDateTime = @date("Y-m-d H:i:s");
    // Assuming the URL is something like: http://example.com/api.php?userId=123&searchTerm=example
    $json_data = file_get_contents("php://input");
    // Decode the JSON data into an associative array
    $postData = json_decode($json_data, true);

    $action = $postData["action"];

    if ($action == "add_product") {
        // Access the individual values
        $name = $postData["name"];
        $description = $postData["description"];
        $price = $postData["price"];

        // Create instance of ProductController Class
        $productController = new ProductController();
        $productController->insert_product($name, $description, $price);

        $html = "<div class=\"product\" style=\"background-image: url(https://www.nudnong.com/static/images/example-image.png);\">
                    <div class=\"infoContainer\">
                        <div class=\"infoName\">
                            <strong>$name</strong>                
                        </div>
                        <div class=\"infoPrice\" style=\"font-weight: 500; margin-top: 5px; font-size: 18px;\">
                            $price $
                        </div>
                        <div class=\"infoDescription\" style=\"font-size: 14px;\">
                            $description
                        </div>
                    </div>
                </div>"; 

        $response = [
            "status" => "success",
            'html' => $html
        ];       
                        
        header('Content-Type: application/json');
        echo json_encode($response);
    } 
?>