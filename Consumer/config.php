<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_auction_website";

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // PDO hata modunu ayarla
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
}
?>

