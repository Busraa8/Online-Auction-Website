
<?php
session_start();
include 'connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}

$userID = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $receiverID = $_POST['receiver_id'];
    $messageContent = $_POST['message_content'];

    // Insert message into the database
    $sql_insert_message = "INSERT INTO messages (sender_id, receiver_id, message_content, sent_at) 
                           VALUES ('2', '$receiverID', '$messageContent', CURRENT_TIMESTAMP)";
    if ($conn->query($sql_insert_message) === TRUE) {
        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        echo "Error: " . $sql_insert_message . "<br>" . $conn->error;
    }
}

// Retrieve messages for the current user
if (isset($_GET['user_id'])) {
    $receiverID = $_GET['user_id'];

    // Select messages for the current user and mark them as read
    $sql_get_messages = "SELECT * FROM messages WHERE (sender_id = '2' AND receiver_id = '$receiverID') OR (sender_id = '$receiverID' AND receiver_id = '2') ORDER BY sent_at ASC";
    $result_get_messages = $conn->query($sql_get_messages);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .frame {
        margin: 100px auto 0; 
        width: fit-content; 
    }
    .product-container {
        border: 1px solid #ccc;
        padding: 20px;
        width: fit-content;
        margin-top: -100px;
    }
    .message-container {
        max-height: 350px; 
        overflow-y: auto; 
        padding: 10px; 
        border: 1px solid #ccc; 
    }
    .message {
        margin-bottom: 20px;
        font-size: 14px;
        display: flex;
        justify-content: flex-start;
        width: 600px; 
    }
    .message.sent {
        justify-content: flex-end;
    }
    .message p {
        margin: 5px 10px;
        font-size: 14px; 
    }
    .message textarea {
        width: calc(100% - 20px); 
        height: 100px; 
        resize: vertical; 
        margin-bottom: 10px; 
        padding: 10px;
    }
    /* Baloncuk */
    .sent .message-content {
        background-color: #DCF8C6;
        border-radius: 10px 10px 0 10px;
    }
    .received .message-content {
        background-color: #EAEAEA;
        border-radius: 10px 10px 10px 0;
    }
    .message-form {
        text-align: right; 
    }
    .message-form input[type="submit"] {
        margin-top: 10px; 
    }
    .message-content .time {
        text-align: right; 
        font-size: 12px; 
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
        <h1>HeadOnline Auction Websiteer</h1>
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
            <div class="frame"> 
                <div class="product-container">
                    <h1>Message</h1>
                    <div class="message-container">
                        <?php if ($result_get_messages->num_rows > 0) : ?>
                            <?php while($row = $result_get_messages->fetch_assoc()) : ?>
                                <?php
                                    $message_content = $row["message_content"];
                                    $sent_at = $row["sent_at"];
                                    $sender_id = $row["sender_id"];
                                    $class = ($sender_id == '2') ? 'sent' : 'received';
                                ?>
                                <div class="message <?php echo $class; ?>">
                                    <div class="message-content">
                                        <p><?php echo $message_content; ?></p>
                                        <div class="time">Sending Time: <?php echo $sent_at; ?></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No messages yet.</p>
                        <?php endif; ?>
                    </div>
                    <form method="post" class="message-form">
                        <input type="hidden" name="receiver_id" value="<?php echo $_GET['user_id']; ?>">
                        <textarea name="message_content" placeholder="Enter your message" style="width: 100%;"></textarea><br>
                        <input type="submit" name="send_message" value="Send Message">
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
