<?php 
session_start();
include('config.php');
error_reporting(0);

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
            exit; 
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


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">



<!--Bootstrap -->
<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="style_product.css" type="text/css">

</head>

<body>
<?php include 'header.php'; ?> 

<section class="section-padding gray-bg">
  <div class="container">
    <div class="row"> 
    
      
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewantique">

        <?php
$sql = "SELECT products.product_name, products.product_id, products.price, products.deadline, products.image
        FROM products";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {  
?>
<div class="col-list-3">
    <div class="recent-antique-list">
        <div class="antique-info-box"> 
                <a href="product_details.php?vhid=<?php echo htmlentities($result->product_id); ?>">
                <img src="img/images/<?php echo htmlentities($result->image);?>" class="img-responsive" alt="image">
            </a>
            <ul>
                <li><i class="fa fa-usd" aria-hidden="true"></i><?php echo htmlentities($result->price);?></li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->deadline);?></li>
            </ul>
        </div>
        <div class="antique-title-m">
        <h6><a href="product_details.php?vhid=<?php echo htmlentities($result->product_id); ?>"><?php echo htmlentities($result->product_name);?></a></h6>
            <span class="price">$<?php echo htmlentities($result->price);?> /Day</span> 
        </div>
        <div class="inventory_info_m">
            
        </div>
    </div>
</div>
<?php 
    }
}
?>

       
      </div>
    </div>
  </div>
</section>

</body>
</html>