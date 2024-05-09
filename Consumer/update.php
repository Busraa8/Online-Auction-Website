<?php
session_start();

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Okunmamış mesajları güncelle
if (isset($_SESSION['id'])) {
  $userID = $_SESSION['id'];
  $update_messages_sql = "UPDATE messages SET `read` = 1 WHERE receiver_id = '$userID' AND `read` = 0";
  if ($conn->query($update_messages_sql) === TRUE) {
    echo "Mesajlar güncellendi.";
  } else {
    echo "Hata: " . $update_messages_sql . "<br>" . $conn->error;
  }
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>

