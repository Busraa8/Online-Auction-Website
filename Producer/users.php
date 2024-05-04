<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
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
                <li><a href="#">Link 4</a></li>
            </ul>
        </aside>
        <main>
            <h2>User Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php'; // Veritabanı bağlantısı
                    $sql = "SELECT id, name, surname, email FROM user_table"; // User tablosundan verileri seç
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Veritabanından gelen her bir satır için tabloyu oluştur
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td>" . $row["surname"]. "</td><td>" . $row["email"]. "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Veritabanında hiç kullanıcı bulunamadı.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

