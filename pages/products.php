<?php
    // Create instance of ProductController Class
    $productController = new ProductController();
?>
<script>
    // Create JS function to contact product controller 
    const productSubmit = () => {
        // Retrieve form values 
        const name = document.querySelector('#name').value;
        const description = document.querySelector('#description').value;
        const price = document.querySelector('#price').value;
        
        if (name !== "" && description !== "" && price !== "") {
            // Prepare JSON file to send POST request of Adding the product
            const postData = {
                "action": "add_product",
                "name": name,
                "description": description,
                "price": price
            };
            // Use fetch to make the POST request
            fetch("<?=URL_PATH?>/process.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(postData),
            })
            .then(response => response.json())
            .then(data => {
                let status = data["status"];
                if (status == "success") {
                    let productHTMLData = data["html"]; 
                    document.querySelector('#name').value = "";
                    document.querySelector('#description').value = "";
                    document.querySelector('#price').value = "";
                    // Append product to the product container
                    document.querySelector(".productContainer").innerHTML += productHTMLData;

                    alert("Product Info has been added");
                }


                console.log(status);
                // location.reload();
            })
            .catch(error => console.error("Error during fetch: ", error));
        } else {
            alert("Missing Output!");
        }

        return;
    }
</script>
<div class="contentContainer">
    <div class="innerContent">
        <h1>Products Page</h1>
        <div>The Creation of a PHP script. The purpose of the script is to accept form input data, input it into  a database and send back a status response. </div>
        <br>
        <div class="productContainer">
            <? $productController->display_products(); ?>
        </div>
        <div class="formContainer">
            <h2>Add + Product</h2>
            <div>The script is to accept form data for a new product submission. The product data is: • Name - text • Description - text • Price - decimal number </div>
            <br>
            <form method="post">
                <div class="formGroup">
                    <label for="name">Name :</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="formGroup">
                    <label for="description">Description :</label>
                    <input type="text" id="description" name="description" required>
                </div>
                <div class="formGroup">
                    <label for="price">Price (USD) :</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="formGroup">
                    <button type="button" onclick="productSubmit()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>