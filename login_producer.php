<?php
session_start();

if (isset($_POST['login'])) {
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];
    $encryptedPass = md5($userPassword); 
    include 'Producer/connection.php';
    $sql = "SELECT * FROM user_table WHERE email = '$userEmail' AND password = '$encryptedPass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bulundu ise
        $row = $result->fetch_assoc();
        $role = $row["role"];
        $id = $row["id"];
        $_SESSION["userid"] = $id; // Kullanıcı kimliğini sakla
        // Kullanıcının rolüne göre yönlendirme yapma
        if ($role == "producer") {
            header("location: Producer/producer_products.php"); 
        } else {
            echo "Undefined user role";
        }
    } else {
        
        echo "Invalid email or password";
    }

    $conn->close();
}
?>
