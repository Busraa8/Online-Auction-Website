<?php
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    include 'connection.php';

    // Kullanıcıyı silmek için SQL sorgusunu hazırla ve çalıştır
    $sql = "DELETE FROM user_table WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla silindi.";
    } else {
        echo "Kullanıcı silinirken hata oluştu: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Geçersiz istek.";
}

header("Location: users.php"); 
exit();
?>
