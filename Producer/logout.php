<?php
session_start();

// Tüm oturum değişkenlerini temizle
session_unset();

session_destroy();

// Tarayıcı önbelleğini temizle 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 


header("location: ../index_producer.php");
exit;
?>


