<?php
session_start();

include 'connection.php';

$aboutUs = $_POST['about_us'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Verileri güncelleme sorgusunu hazırla
$sql = "UPDATE company_info SET ";
if(!empty($aboutUs)) {
    $sql .= "about_us = '$aboutUs', ";
}
if(!empty($address)) {
    $sql .= "address = '$address', ";
}
if(!empty($phone)) {
    $sql .= "phone = '$phone', ";
}
if(!empty($fax)) {
    $sql .= "fax = '$fax', ";
}
if(!empty($email)) {
    $sql .= "email = '$email', ";
}
if(!empty($facebook)) {
    $sql .= "facebook = '$facebook', ";
}
if(!empty($instagram)) {
    $sql .= "instagram = '$instagram', ";
}
if(!empty($linkedin)) {
    $sql .= "linkedin = '$linkedin', ";
}

$sql = rtrim($sql, ', ');

$sql .= " WHERE id = 1";

if ($conn->query($sql) === TRUE) {
   
    header("Location: company_info.php");
    exit();
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
