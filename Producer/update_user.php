<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_user'])) {
    $id = 2;

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Güncelleme sorgusu
    $sql = "UPDATE user_table SET name='$name', surname='$surname', email='$email', phone='$phone', password='$password' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User information updated successfully";
    } else {
        echo "Error updating user information: " . $conn->error;
    }
} else {
    echo "Form submission failed";
}

$conn->close();
?>
