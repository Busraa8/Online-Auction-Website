<?php 
session_start();
include('config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
</head>

<style>
    .frame {
        display: flex; /* Flexbox kullanarak içeriği yatay ve dikey olarak ortala */
        justify-content: center; /* yatay olarak ortala */
        align-items: center; /*dikey olarak ortala */
        height: 80vh; /* Ekran yüksekliği kadar alan kapla */
    }

    .frame img {
        max-width: 100%; /* Resmin genişliğini ayarla */
        max-height: 100%; /* Resmin yüksekliğini ayarla */
        margin-top: 100px; 
    }

   
</style>

<body> 
<?php include 'header.php'; ?> 
  <div class="frame"> 
    <?php 
    $vhid = intval($_GET['vhid']);

    // Hata modunu ayarla
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM products WHERE product_id=:vhid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vhid', $vhid, PDO::PARAM_INT);
    $query->execute();

    // Sorgu sonuçlarını al
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Eğer sonuç varsa detayları görüntüle
    if ($result) {
        ?>
        <div class="image-frame"> 
            <img src="img/images/<?php echo htmlentities($result['image']); ?>" class="img-responsive" alt="image">
        </div>
       <?php if(!empty($result['Vimage1'])) { ?>
        <div><img src="img/images/<?php echo htmlentities($result['image']); ?>"  alt="image" width="900" height="560"></div>
        <?php } ?>
      <?php
    }
    ?>
  </div>
</body>

</html>
