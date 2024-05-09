<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
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
                <li><a href="settings.php">Settings</a></li><br>
                <li><a href="company_info.php">Homepage Settings</a></li><br>
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
                        <th>Unread Messages</th> <!-- New column for unread message count -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php'; // Database connection
                    $sql = "SELECT id, name, surname, email FROM user_table WHERE id != 2"; // Exclude user with ID 2
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Query to count unread messages sent by this user
                            $unread_messages_sql = "SELECT COUNT(*) AS unread_count FROM messages WHERE sender_id = " . $row["id"] . " AND receiver_id = 2 AND `read` = 0";
                            $unread_messages_result = $conn->query($unread_messages_sql);
                            $unread_messages_row = $unread_messages_result->fetch_assoc();
                            $unread_count = $unread_messages_row['unread_count'];

                            echo "<tr onclick='contactProducer(" . $row["id"] . ")'>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["surname"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>
                                        <form action='delete_user.php' method='post'> 
                                            <input type='hidden' name='user_id' value='" . $row["id"] . "'> 
                                            <button type='submit'>Delete</button> 
                                        </form>
                                    </td>
                                    <td>"; // Start of new column
                            if ($unread_count > 0) {
                                // Display an indicator for unread messages
                                echo "<span style='color: red;'>Unread messages: " . $unread_count . "</span>";
                            } else {
                                echo "No unread messages";
                            }
                            echo "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found in the database.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>

    <!-- JavaScript kodunu buraya ekleyin -->
    <script>
    // JavaScript 
    function contactProducer(userId) {
        // AJAX kullanarak sunucuya istek yaparak okunmamış mesajları güncelle
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Sayfa yenileme
                window.location.href = 'contact_producer.php?user_id=' + userId;
            }
        };
        // AJAX isteğini gönder
        xhttp.open("GET", "update_messages.php?user_id=" + userId, true);
        xhttp.send();
    }
</script>


</body>
</html>
