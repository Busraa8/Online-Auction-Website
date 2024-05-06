<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header and Sidebar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <script>
        // JavaScript 
        function openProductDetails(productId) {
            window.location.href = 'product_details_producer.php?product_id=' + productId;
        }
    </script>
    <style>
        
        tbody tr:hover {
            cursor: pointer;
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
                <li><a href="settings.php">Settings </a></li>
            </ul>
        </aside>
        <main>
            <h2>Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php'; 
                    $sql = "SELECT product_id, product_name, price FROM products"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Veritabanından gelen her bir satır için tabloyu oluştur
                        while($row = $result->fetch_assoc()) {
                            // Her satırın tamamına tıklama işlevini ekleyerek ürün detaylarını aç
                            echo "<tr onclick='openProductDetails(" . $row["product_id"] . ")'><td>" . $row["product_id"]. "</td><td>" . $row["product_name"] . "</td><td>" . $row["price"]. "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Veritabanında hiç ürün bulunamadı.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

