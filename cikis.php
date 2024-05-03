<?php
session_start(); // Oturumu başlat

// Oturum kontrolleri
if (isset($_SESSION['user_id'])) {
    // Kullanıcı oturumu varsa, oturumu sonlandır
    session_unset(); // Tüm oturum değişkenlerini temizle
    session_destroy(); // Oturumu sonlandır
}

// Kullanıcıyı login.php sayfasına yönlendir
header("Location: login.php");
exit(); // Kodun burada sonlanmasını sağla
?>
