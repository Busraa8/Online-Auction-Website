<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header and Sidebar</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .product-details {
            border: 2px solid #ccc;
            padding: 20px;
            text-align: center;
        }
        .product-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
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
            <div class="container">
                <div class="product-details">
                    <?php
                    include 'connection.php';

                    $product_id = $_GET['product_id'];

                    $sql = "SELECT products.*, user_table.name, user_table.surname 
                            FROM products 
                            LEFT JOIN user_table ON products.userID = user_table.id 
                            WHERE product_id = $product_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Veritabanından gelen her bir satır için ürün bilgileri
                        while($row = $result->fetch_assoc()) {
                            echo "<h2>" . $row["product_name"] . "</h2>";
                            // Resmin yolu
                            $image_path = "../Consumer/img/images/" . $row["image"];
                            echo "<img src='" . $image_path . "' alt='Product Image'>";
                            echo "<p>Price: " . $row["price"] . "</p>";
                            echo "<p>Features: " . $row["product_features"] . "</p>";
                            echo "<p>Deadline: " . $row["deadline"] . "</p>";

                            // Son teklifi veren kullanıcının adı ve soyadı
                            if (!empty($row["name"]) && !empty($row["surname"])) {
                                echo "<p>Last Bidder: " . $row["name"] . " " . $row["surname"] . "</p>";
                            } else {
                                echo "<p>Last Bidder: No Bids</p>";
                            }

                            // Ürünü silme butonu
                            echo "<form action='delete_product.php' method='POST'>";
                            echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
                            echo "<input type='submit' class='delete-button' name='delete_product' value='Delete Product'>";
                            echo "</form>";
                        }
                    } else {
                        echo "Product not found.";
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


