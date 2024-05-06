<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

  
    $sql = "DELETE FROM products WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        // Ürün başarıyla silindi, kullanıcıyı başka bir sayfaya yönlendir
        header("Location: producer_products.php");
        exit();
    } else {
        
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
