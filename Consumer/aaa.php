<?php 
session_start();
include('Consumer/config.php');
error_reporting(0);


?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<!--Bootstrap -->
<link rel="stylesheet" href="bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="style_product.css" type="text/css">

</head>
<section class="section-pading gray-bg">
<link rel="stylesheet" href="product.css">
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
                    <li><a href="login.html"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>

<body>


<!-- Resent Cat-->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="row"> 
    
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

        <?php
$sql = "SELECT products.product_name, products.price, products.deadline, products.image
        FROM products";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {  
?>
<div class="col-list-3">
    <div class="recent-car-list">
        <div class="car-info-box"> 
            <a href="homepage.php?vhid=<?php echo htmlentities($result->id);?>">
                <img src="img/images/<?php echo htmlentities($result->image);?>" class="img-responsive" alt="image">
            </a>
            <ul>
                <li><i class="fa fa-usd" aria-hidden="true"></i><?php echo htmlentities($result->price);?></li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->deadline);?></li>
            </ul>
        </div>
        <div class="car-title-m">
            <h6><a href="homepage.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->product_name);?></a></h6>
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

<!-- /Resent Cat --> 

</body>
</html>