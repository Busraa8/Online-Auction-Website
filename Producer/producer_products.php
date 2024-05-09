<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
        .user-icon {
            position: relative;
            display: inline-block;
        }
        .logout-text {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
            padding: 5px;
            z-index: 1;
            font-weight: bold;
        }
        .user-icon:hover .logout-text {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <h1>Online Auction Website</h1>
        <div class="user-icon">
            <img src="https://cdn-icons-png.freepik.com/512/1144/1144760.png" alt="User Icon">
            <!-- Çıkış yap metni -->
            <div class="logout-text">
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container">
        <aside>
            <h2>Menu</h2>
            <ul>
                <li><a href="producer_products.php">Products</a></li><br>
                <li><a href="users.php">Users</a></li><br>
                <li><a href="add_product.php">Add Product</a></li><br>
                <li><a href="settings.php">Settings </a></li><br>
                <li><a href="company_info.php">Homepage Settings</a></li><br>
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
                        <th>Deadline</th>
                        <th>Offerer ID</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php
include 'connection.php'; 

$sql = "SELECT p.product_id, p.product_name, p.price, p.deadline, p.userID, u.email 
        FROM products p 
        LEFT JOIN user_table u ON p.userID = u.id"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        // Her satırın tamamına tıklama işlevini ekleyerek ürün detaylarını aç
        $deadline = $row["deadline"];
        $expired = (strtotime($deadline) < time()) ? true : false;//Tarih geçmiş ise
        $color = ($expired) ? 'color: red;' : '';
        echo "<tr onclick='openProductDetails(" . $row["product_id"] . ")'><td>" . $row["product_id"]. "</td><td>" . $row["product_name"] . "</td><td>" . $row["price"]. "</td><td style='" . $color . "'>" . $row["deadline"]. "</td><td>" . $row["userID"]. "</td><td>" . $row["email"]. "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>Veritabanında hiç ürün bulunamadı.</td></tr>";
}
$conn->close();
?>



                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

