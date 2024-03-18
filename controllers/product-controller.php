<?php
// Include the database connection
include "models/db_connect.php";

class ProductController { 
    // Function to display product data
    public function display_products() { 
        // Access the $pdo object from db_connect.php
        global $pdo; 
        // Fetch product data from the database
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count > 0) {
            // Loop through results and display in HTML
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $row['product_name'];
                $description = $row['product_description'];
                $price = $row['product_price']; ?>
              
                <div class="product" style="background-image: url(<?=URL_IMAGE?>/example-image.png);">
                    <div class="infoContainer">
                        <div class="infoName">
                            <strong><?=$name?></strong>                
                        </div>
                        <div class="infoPrice" style="font-weight: 500; margin-top: 5px; font-size: 18px;">
                            <?=$price?> $
                        </div>
                        <div class="infoDescription" style="font-size: 14px;">
                            <?=$description?>
                        </div>
                    </div>
                </div> <?
            }
        }
    }
    // Function to insert new product data
    public function insert_product($product_name, $product_description, $product_price) {
        // Access the $pdo object from db_connect.php
        global $pdo; 
        // Insert product data into the database
        $stmt = $pdo->prepare("INSERT INTO products (product_name, product_description, product_price) 
                               VALUES ('{$product_name}','{$product_description}',{$product_price})");
        $stmt->execute();
    }
}

?>