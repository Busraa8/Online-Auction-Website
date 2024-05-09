<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$sql = "SELECT about_us FROM company_info WHERE id = 1"; // id = 1 olan satırı seç
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aboutUsText = $row["about_us"];
} else {
    echo "Hata: Kayıt bulunamadı";
}

// Okunmamış mesajları say
if (isset($_SESSION['id'])) {
    $userID = $_SESSION['id'];
    $unread_messages_sql = "SELECT COUNT(*) AS unread_count FROM messages WHERE receiver_id = '$userID' AND `read` = 0";
    $unread_messages_result = $conn->query($unread_messages_sql);
    $unread_messages_row = $unread_messages_result->fetch_assoc();
    $unread_count = $unread_messages_row['unread_count'];
}

$conn->close();

if (isset($_POST['login'])) {
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];
    $encryptedPass = md5($userPassword);

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user_table WHERE email = '$userEmail' AND password = '$encryptedPass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row["role"];
        // Kullanıcının rolüne göre yönlendirme yapma
        if ($role == "consumer") {
            $firstName = $row["name"];
            $lastName = $row["surname"];
            // Kullanıcının adı ve soyadını session'a kaydetme
            $_SESSION['first_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;
            header("location: Consumer/homepage.php");
            exit; 
        } else {
            echo "Undefined user role";
        }
    } else {
    
        echo "Invalid email or password";
    }

    $conn->close();
}
?>

<head>
  <meta charset="UTF-8">  
  <link
    href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,600,700"
    rel="stylesheet"
  />
  <script
    src="https://kit.fontawesome.com/37b0ae8922.js"
    crossorigin="anonymous"
  ></script>

</head>
<link rel="stylesheet" href="product.css">
<div class="wrapper">
  <div class="Container">
        <div class="nav">
            <div class="logo">
                ONLINE AUCTION
            </div>
            <div class="menu">
                <ul class="navMenu">
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="#">About us</a></li>
    
                    <li><a href="contact.php">Contact<?php echo isset($unread_count) && $unread_count > 0 ? ' (' . $unread_count . ')' : ''; ?></a></li>
                    <li><a href="../index.php"><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
