<?php
session_start();

include 'config.php';

// Veritabanı bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$sql = "SELECT about_us FROM company_info WHERE id = 1"; // id = 1 olan satırı seç
$result = $conn->query($sql);

// Sonuçları kontrol etme
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $aboutUsText = $row["about_us"];
} else {
    echo "Hata: Kayıt bulunamadı";
}

// Veritabanı bağlantısını kapatma
$conn->close();

if (isset($_POST['login'])) {
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];
    $encryptedPass = md5($userPassword);

    // Veritabanı bağlantısı oluşturma
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol etme
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user_table WHERE email = '$userEmail' AND password = '$encryptedPass'";
    $result = $conn->query($sql);

    // Sonuçları kontrol etme
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
            exit; // Bu satırı ekleyerek işlem sonlandırılır
        } else {
            echo "Undefined user role";
        }
    } else {
        // Kullanıcı bulunamadı veya hatalı giriş
        echo "Invalid email or password";
    }

    // Veritabanı bağlantısını kapatma
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
<link rel="stylesheet" href="homepage.css">
<div class="wrapper">
  <div class="Container">
        <div class="nav">
            <div class="logo">
                ONLINE AUCTION
            </div>
            <div class="menu">
                <ul class="navMenu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Locations</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="../login.php"><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></a></li>
                </ul>
            </div>
        </div>
        <div class="header">
            <h1>Welcome to Online Auction</h1>
            <button type="button" onclick="window.location.href='products.php'">All Products</button>
        </div>
    </div>
</div>

<div class="wrapper2">
  <div class="Container">
        <div class="header">
          <h2>ABOUT US<br><br></h2>
          <h2><?php echo $aboutUsText; ?></h2>
        </div>
   
        </div>
</div>

<div class="container">
  <div id="one" class="section">
  </div>
  <div id="two" class="section">
  </div>
  <div id="three" class="section">
    <div class="header">
<div class="row">
  <div class="col-sm-4"> <span> <div class="rhombus"></div></span>
    </div>
  </div>
</div>
</div>
</div>

<div class="wrappercontact">
  <div class="Container">
    <div class="header">
      <h2 > Address <br><br><br>
        Phone:00-000-000-0000&nbsp - &nbsp Fax:11-111-111-1111 &nbsp - &nbsp
        Email:info@.com</h2>

        <div class="icon">
       
          <ul id="contact">
            <li ><a href="https://tr-tr.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="https://www.instagram.com/?hl=tr" target="_blank"><i class="fab fa-instagram-square"></i></a></li>
            <li><a href="https://twitter.com/?lang=tr" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://tr.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="https://mail.google.com/mail/u/0/?view=cm&source=mailto&to=busrasargeyik@gmail.com&fs=1&tf=1" target="_blank"><i class="fas fa-envelope"></i></a></li>
            
          </ul>
        </div>

    </div>
   
  </div>
</div>
