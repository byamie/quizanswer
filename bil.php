<?php
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

// Kullanıcının user_id'sini al
$user_id = $_SESSION['user_id']; // Oturumda saklanan kullanıcı user_id bilgisini kullanın

// Kullanıcının belirlediği kelime sayısını al
$query = "SELECT goruntulenecek_kelime_sayisi FROM kullanici WHERE user_id = :user_id";
$statement = $db->prepare($query);
$statement->execute(['user_id' => $user_id]);
$result = $statement->fetch();
$goruntulenecek_kelime_sayisi = $result['goruntulenecek_kelime_sayisi'];

// Kullanıcının kelimelerini al
$query = "SELECT * FROM kelime WHERE user_id = :user_id OR user_id = 1 LIMIT :limit";
$statement = $db->prepare($query);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':limit', $goruntulenecek_kelime_sayisi, PDO::PARAM_INT);
$statement->execute();
$kelimeler = $statement->fetchAll();

// Kullanıcının kelimelerini listele
echo "<h2>Kelimeleriniz:</h2>";
foreach ($kelimeler as $kelime) {
    echo "<p><strong>Kelime:</strong> " . $kelime['kelime'] . "</p>";
    // Örnek cümleler alanı
    echo "<p><strong>Örnek Cümleler:</strong> " . $kelime['example_sentences'] . "</p>";
    // Türkçe çeviri alanı
    echo "<form action='cevap.php' method='POST'>";
    echo "<input type='hidden' name='id' value='" . $kelime['id'] . "'>";
    echo "<label for='turkish_translation'>Türkçe Çevirisi:</label><br>";
    echo "<input type='text' id='turkish_translation' name='turkish_translation' required><br><br>";
    echo "<input type='submit' value='Cevabı Gönder'>";
    echo "</form>";

    // Kullanıcının cevabı ile veritabanındaki Türkçe çeviriyi karşılaştır
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cevap = $_POST['turkish_translation'];
        $dogru_cevap = $kelime['turkish_translation'];
        if ($cevap == $dogru_cevap) {
            echo "<p style='color:green;'>Doğru cevap!</p>";
        } else {
            echo "<p style='color:red;'>Yanlış cevap!</p>";
        }
    }
    echo "<hr>";
}
?>
