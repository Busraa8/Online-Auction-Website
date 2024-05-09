<?php
// update_messages.php dosyası
include 'connection.php';

// Eğer user_id parametresi gelmişse, göndereni bu user_id'ye sahip olan ve alıcısı 2 olan mesajların okunmuş olarak işaretlenmesini sağla
if (isset($_GET['user_id'])) {
    $senderID = $_GET['user_id'];

    // Mesajları güncelle
    $sql_update_messages = "UPDATE messages SET `read` = 1 WHERE sender_id = '$senderID' AND receiver_id = 2 AND `read` = 0";
    if ($conn->query($sql_update_messages) === TRUE) {
        echo "Mesajlar güncellendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
} else {
    echo "Kullanıcı ID'si belirtilmedi.";
}

$conn->close();
?>

