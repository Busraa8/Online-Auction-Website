<?php 
session_start();
include('config.php');
error_reporting(0);

// Eğer submit düğmesi tıklandıysa
if(isset($_POST['submit'])) {
    $useremail=$_SESSION['login'];
    $status=0;
    $vhid=$_GET['vhid'];
}

// Eğer fiyat güncelleme düğmesi tıklandıysa
if(isset($_POST['update_price'])) {
    $vhid = intval($_GET['vhid']); // vhid'yi al

    // Hata modunu ayarla
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sorguyu hazırla ve çalıştır
    $sql = "SELECT * FROM products WHERE product_id=:vhid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vhid', $vhid, PDO::PARAM_INT);
    $query->execute();

    // Sorgu sonuçlarını al
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Yeni fiyatı al
    $new_price = $_POST['new_price'];

    // Kontrol et: Yeni fiyatın mevcut fiyattan düşük olup olmadığını kontrol et
    if ($new_price < $result['price']) {
        $error_message = "Yeni fiyat mevcut fiyattan küçük olamaz.";
    } else {
        // Kullanıcı ID'sini al
        $user_id = $_SESSION['id'];

        // Yeni fiyatı güncelle ve userID'yi güncelle
        $update_sql = "UPDATE products SET price = :new_price, userID = :user_id WHERE product_id = :vhid";
        $update_query = $dbh->prepare($update_sql);
        $update_query->bindParam(':new_price', $new_price, PDO::PARAM_STR);
        $update_query->bindParam(':vhid', $vhid, PDO::PARAM_INT);
        $update_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($update_query->execute()) {
            $success_message = "Fiyat başarıyla güncellendi.";
        } else {
            $error_message = "Fiyat güncelleme işlemi sırasında bir hata oluştu.";
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <style>
        .frame {
            margin: 100px auto 0; 
            width: fit-content; 
        }

        .product-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: fit-content;
            margin-top: 140px;
        }

        .product-details {
            font-family: "Abel", sans-serif;
            font-size: 16px;
            color: #000;
        }

        .product-details p {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .price-update-container {
            margin-top: 20px;
        }

        .price-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .social {
    background-color: #fff;
    display: block;
    margin: 10px auto;
    width: 70%;
    height: 50px;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    text-decoration-line: none;
    transition-duration: 200ms;
    box-shadow: var(--box-shadow);
    text-shadow: var(--box-shadow);
  }
  #forgot {
    border: solid var(--forgot-color) 1px;
    color: var(--forgot-color);
  }
  #forgot:hover {
    background-color: var(--forgot-color);
    color: green;
  }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        body {
            margin-bottom: 100px;
        }
    </style>
    <link rel="stylesheet" href="product.css">
</head>

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
            <div class="product-container">
                <div class="image-frame"> 
                    <img src="img/images/<?php echo htmlentities($result['image']); ?>" class="img-responsive" alt="image">
                </div>
                <div class="product-details">
                    <p> <?php echo htmlentities($result['product_name']); ?></p>
                    <p> <?php echo htmlentities($result['price']); ?> $</p>
                    <p><?php echo htmlentities($result['deadline']); ?></p>
                    <p><?php echo htmlentities($result['product_features']); ?></p>
                    <!-- Price update form -->
                    <div class="price-update-container">
                        <form action="" method="post">
                            <input type="number" name="new_price" class="price-input" placeholder="Enter the new price" required>
                            <button type="submit" name="update_price" class="social" id="forgot">Update Price</button>
                        </form>
                        <?php 
                            if(isset($error_message)) {
                                echo '<div class="error-message">' . $error_message . '</div>';
                            } elseif(isset($success_message)) {
                                echo '<div class="success-message">' . $success_message . '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php 
            if(!empty($result['Vimage1'])) { ?>
                <div><img src="img/images/<?php echo htmlentities($result['image']); ?>"  alt="image" width="900" height="560"></div>
        <?php 
            } 
        } ?>
    </div>
</body>
</html>

