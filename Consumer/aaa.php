<?php
session_start();

include 'config.php';

// Veritabanı bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}

$userID = $_SESSION['id']; 

// Eğer sayfaya POST ile bir mesaj gönderildiyse
if (isset($_POST['send_message'])) {
    $receiverID = $_POST['receiver_id'];
    $messageContent = $_POST['message_content'];

    // Mesajı veritabanına ekleme
    $sql_insert_message = "INSERT INTO messages (sender_id, receiver_id, message_content, sent_at) VALUES ('$userID', '$receiverID', '$messageContent', CURRENT_TIMESTAMP)";
    if ($conn->query($sql_insert_message) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql_insert_message . "<br>" . $conn->error;
    }
}

// Önceki mesajları almak için sorgu
$sql_get_messages = "SELECT * FROM messages WHERE sender_id = '$userID' OR receiver_id = '$userID' ORDER BY sent_at DESC";
$result_get_messages = $conn->query($sql_get_messages);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <style>
        .frame {
            margin: 100px auto 0; 
            width: fit-content; 
        }
        .message-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: fit-content;
            margin-top: 140px;
        }
        .message {
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="product.css">
</head>

<body> 
    <?php include 'header.php'; ?> 
    
    <div class="frame"> 
        <div class="message-container">
            <h1>Mesajlaşma</h1>
            <form method="post">
                <textarea name="message_content" placeholder="Mesajınızı girin"></textarea><br>
                <input type="submit" name="send_message" value="Mesaj Gönder">
            </form>
            <h2>Önceki Mesajlar</h2>
            <?php
            if ($result_get_messages->num_rows > 0) {
                while($row = $result_get_messages->fetch_assoc()) {
                    $message_content = $row["message_content"];
                    $sent_at = $row["sent_at"];

                    // Mesajı ekrana yazdır
                    echo "<div class='message'>";
                    echo "<p>Mesaj: $message_content</p>";
                    echo "<p>Gönderim Zamanı: $sent_at</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>Henüz mesaj yok.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php

?>

