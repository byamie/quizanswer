<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Oturumu başlat
session_start();

// Veritabanı bağlantısını sağlayalım
require 'baglan.php';

// Kullanıcı giriş yapmış mı diye kontrol edelim
if (!isset($_SESSION['user_id'])) {
    // Eğer kullanıcı giriş yapmamışsa, bir hata mesajı gösterip başka bir sayfaya yönlendirelim
    $_SESSION['error'] = "Önce giriş yapmalısınız.";
    header("Location: login.php");
    exit(); // Kodun burada sonlanmasını sağlayalım
}

// Formdan gelen cevabı al
$cevap = strtolower($_POST['turkish_translation']);
$kelime_id = $_POST['id'];

// Kelimenin doğru Türkçe çevirisini almak için sorgu yap
$query = "SELECT turkish_translation FROM kelime WHERE id = :id";
$statement = $db->prepare($query);
$statement->execute(['id' => $kelime_id]);
$result = $statement->fetch();
$dogru_cevap = strtolower($result['turkish_translation']);

// Kullanıcının cevabı ile doğru cevabı karşılaştır
if ($cevap == $dogru_cevap) {
    // Doğru cevap durumunda kelimenin doğru cevap sayısını bir artır
    $query = "UPDATE kelime SET doğru_cevap_sayisi = doğru_cevap_sayisi + 1 WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->execute(['id' => $kelime_id]);

    // Kullanıcının bu kelimeyi daha önce bildiği kontrol edelim
    $query = "SELECT COUNT(*) as count FROM bilinen_sorular WHERE user_id = :user_id AND id = :id";
    $statement = $db->prepare($query);
    $statement->execute(['user_id' => $_SESSION['user_id'], 'id' => $kelime_id]);
    $result = $statement->fetch();

    if ($result['count'] == 0) {
        // Kullanıcı bu kelimeyi ilk kez doğru bildiyse, bilinen_sorular tablosuna ekleyelim
        $cevap_time = date('Y-m-d H:i:s');
        $query = "INSERT INTO bilinen_sorular (user_id, id, dogru_cevap, dogru_cevap_tarihi) VALUES (:user_id, :id, :dogru_cevap, :dogru_cevap_tarihi)";
        $statement = $db->prepare($query);
        $statement->execute(['user_id' => $_SESSION['user_id'], 'id' => $kelime_id, 'dogru_cevap' => $cevap, 'dogru_cevap_tarihi' => $cevap_time]);
    } else {
        // Kullanıcının bu kelimeyi daha önce bildi ise, doğru cevap sayısını kontrol edelim
        $query = "SELECT COUNT(*) as count FROM bilinen_sorular WHERE user_id = :user_id AND id = :id AND dogru_cevap_tarihi >= DATE_SUB(NOW(), INTERVAL 6 DAY)";
        $statement = $db->prepare($query);
        $statement->execute(['user_id' => $_SESSION['user_id'], 'id' => $kelime_id]);
        $result = $statement->fetch();

        if ($result['count'] >= 6) {
            // Kullanıcı 6 gün üst üste doğru bildiyse, kelimeyi tamamlanmış_kelimeler tablosuna ekleyelim ve bilinen_sorular tablosundan kaldıralım
            $query = "INSERT INTO tamamlanmis_kelimeler (user_id, id) VALUES (:user_id, :id)";
            $statement = $db->prepare($query);
            $statement->execute(['user_id' => $_SESSION['user_id'], 'id' => $kelime_id]);

            // Kullanıcının bu kelimeyi bilinen_sorular tablosundan kaldıralım
            $query = "DELETE FROM bilinen_sorular WHERE user_id = :user_id AND id = :id";
            $statement = $db->prepare($query);
            $statement->execute(['user_id' => $_SESSION['user_id'], 'id' => $kelime_id]);
        }
    }

    echo "<p style='color:green;'>Doğru cevap!</p>";
} else {
    echo "<p style='color:red;'>Yanlış cevap!</p>";
}
?>
