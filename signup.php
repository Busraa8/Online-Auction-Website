<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Alanların boş olup olmadığını kontrol et
    if(empty($name) || empty($surname) || empty($email) || empty($phone) || empty($password)) {
        echo "Lütfen tüm alanları doldurun";
    } else {
        // Şifreyi MD5 ile hashle
        $hashed_password = md5($password);

        // Rolü varsayılan olarak belirle
        $role = "consumer";

        include 'Consumer/config.php';

        // Veritabanı bağlantısı
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        // SQL sorgusu oluşturma
        $sql = "INSERT INTO user_table (name, surname, email, phone, password, role)
                VALUES ('$name', '$surname', '$email', '$phone', '$hashed_password', '$role')"; // MD5 ile hashlenmiş şifre ve rol eklendi

        if ($conn->query($sql) === TRUE) {
            echo "Kullanıcı başarıyla kaydedildi";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Consumer/signup.css">
</head>
<body>
    <div id="container">
        <div id="left">
            <h1 id="welcome">Welcome</h1>
        </div>
        <div id="right">
            <h1 id="login">Sign Up</h1><br>
            <form method="post" action="">
                <input type="text" name="name" id="name" class="client-info">
                <label for="text">Name</label>
                <input type="text" name="surname" id="surname" class="client-info"> 
                <label for="text">Surname</label> 
                <input type="email" name="email" id="email" class="client-info">
                <label for="email">Email</label>
                <input type="text" name="phone" id="phone" class="client-info"> 
                <label for="text">Phone</label>
                <input type="password" name="password" id="password" class="client-info">
                <label for="password">Password</label>
                <input type="submit" id="submit" class="client-info" value="Sign Up">
            </form>
            <!-- Giriş butonunu ayrı bir formda oluştur -->
            <form action="index.php" method="get">
                <button type="submit" class="social" id="forgot">Login</button>
            </form>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>

