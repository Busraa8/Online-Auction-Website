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
                <li><a href="settings.php">Settings</a></li>
                <li><a href="company_info.php">Homepage Settings</a></li>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php'; // Veritabanı bağlantısı
                    $sql = "SELECT id, name, surname, email FROM user_table"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Veritabanından gelen her bir satır için tabloyu oluştur
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"] . "</td><td>" . $row["surname"]. "</td><td>" . $row["email"]. "</td><td>
                            <form action='delete_user.php' method='post'> <!-- Form oluşturuldu -->
                                <input type='hidden' name='user_id' value='" . $row["id"] . "'> <!-- Kullanıcı ID'si gizli bir alan olarak eklenir -->
                                <button type='submit'>Delete</button> <!-- Silme butonu -->
                            </form>
                            </td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Veritabanında hiç kullanıcı bulunamadı.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

