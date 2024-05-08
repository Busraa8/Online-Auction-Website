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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_message'])) {
    $receiverID = $_POST['receiver_id'];
    $messageContent = $_POST['message_content'];

    // Mesajı veritabanına ekleme
    $sql_insert_message = "INSERT INTO messages (sender_id, receiver_id, message_content, sent_at) VALUES ('$userID', '$receiverID', '$messageContent', CURRENT_TIMESTAMP)";
    if ($conn->query($sql_insert_message) === TRUE) {
        // Yeniden yönlendirme yaparak formun tekrar gönderilmesini engelle
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        echo "Error: " . $sql_insert_message . "<br>" . $conn->error;
    }
}

// Önceki mesajları almak için sorgu
$sql_get_messages = "SELECT * FROM messages WHERE sender_id = '$userID' OR receiver_id = '$userID' ORDER BY sent_at ASC";
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
        .product-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: fit-content;
            margin-top: 140px;
        }
        .message-container {
            max-height: 400px; /* Maksimum yükseklik */
            overflow-y: auto; /* Dikey kaydırma çubuğu ekle */
            padding: 10px; /* Kenar boşluğu ekle */
            border: 1px solid #ccc; /* Kenar çizgisi ekle */
        }
        .message {
            margin-bottom: 20px;
            font-size: 16px;
            display: flex;
            justify-content: flex-start;
            width: 600px; /* Mesaj kutusunun genişliği */
        }
        .message.sent {
            justify-content: flex-end;
        }
        .message p {
            margin: 5px 10px;
        }
        .message textarea {
            width: calc(100% - 20px); /* Text alanının genişliğini ayarla */
            height: 100px; /* Mesaj giriş kutusunun yüksekliği */
            resize: vertical; /* Dikey yeniden boyutlandırmayı etkinleştir */
            margin-bottom: 10px; /* Aralığı artır */
            padding: 10px; /* Mesaj giriş kutusunun iç boşluğu */
        }
        /* Baloncuk stilleri */
        .sent .message-content {
            background-color: #DCF8C6;
            border-radius: 10px 10px 0 10px;
        }
        .received .message-content {
            background-color: #EAEAEA;
            border-radius: 10px 10px 10px 0;
        }
        .message-form {
            text-align: right; /* Mesaj gönder formunu sağa hizala */
        }
        .message-form input[type="submit"] {
            margin-top: 10px; /* Aralığı artır */
        }
        .message-content .time {
            text-align: right; /* Gönderim zamanını sağa hizala */
        }
    </style>
    <link rel="stylesheet" href="product.css">
</head>

<body> 
    <?php include 'header.php'; ?> 
    
    <div class="frame"> 
        <div class="product-container">
            <h1>Message</h1>
            <div class="message-container">
                <?php
                if ($result_get_messages->num_rows > 0) {
                    while($row = $result_get_messages->fetch_assoc()) {
                        $message_content = $row["message_content"];
                        $sent_at = $row["sent_at"];
                        $sender_id = $row["sender_id"];

                        // Mesaj gönderen ve alanı belirle
                        $class = ($sender_id == $userID) ? 'sent' : 'received';
                        
                        // Mesajı ekrana yazdır
                        echo "<div class='message $class'>";
                        echo "<div class='message-content'>";
                        echo "<p> $message_content</p>";
                        echo "<div class='time'>Sending Time: $sent_at</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Henüz mesaj yok.</p>";
                }
                ?>
            </div>
            <form method="post" class="message-form">
                <input type="hidden" name="receiver_id" value="2">
                <textarea name="message_content" placeholder="Enter your message" style="width: 100%;"></textarea><br>
                <input type="submit" name="send_message" value="Send Message">
            </form>
        </div>
    </div>
</body>
</html>







