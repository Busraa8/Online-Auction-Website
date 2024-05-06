<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $product_features = $_POST['product_features'];
    $deadline = $_POST['deadline'];
    $image_name = "";

    // Check if all required fields are filled
    if (!empty($product_name) && !empty($price) && !empty($deadline) && isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Handle image upload
        $target_dir = "../Consumer/img/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Try to move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_name = basename($_FILES["image"]["name"]);
            
            // Insert product into database
            $sql = "INSERT INTO products (product_name, price, product_features, deadline, image) 
                    VALUES ('$product_name', '$price', '$product_features', '$deadline', '$image_name')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to prevent form resubmission
                header("Location: add_product.php?success=true");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Please fill out all required fields.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 80%; 
            max-width: 600px; 
            padding: 20px; 
            background-color: #f9f9f9; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        form label {
            display: block; 
            margin-bottom: 10px; 
            font-weight: bold; 
        }

        form input[type="text"],
        form input[type="number"],
        form textarea,
        form input[type="date"] {
            width: 100%;
            padding: 8px; 
            margin-bottom: 10px; 
            box-sizing: border-box;  
        }

        form input[type="file"] {
            margin-bottom: 20px; 
        }

        form input[type="submit"] {
            padding: 10px 20px; 
            background-color: #4CAF50;
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        form input[type="submit"]:hover {
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Header</h1>
        <div class="user-icon">
            <img src="https://cdn-icons-png.freepik.com/512/1144/1144760.png" alt="User Icon"> 
        </div>
    </header>
    <div class="container">
        <aside>
            <h2>Sidebar</h2>
            <ul>
                <li><a href="producer_products.php">Products</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </aside>
        <main>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <h2>Add Product</h2> 
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required><br><br>
                
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" min="0" required><br><br>
                
                <label for="product_features">Product Features:</label>
                <textarea id="product_features" name="product_features"></textarea><br><br>
                
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" required><br><br>
                
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                
                <input type="submit" name="add_product" value="Add Product">
            </form>
        </main>
    </div>
</body>
</html>
