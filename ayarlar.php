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

// Formdan gelen veriyi işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $goruntulenecek_kelime_sayisi = $_POST['goruntulenecek_kelime_sayisi'];

    // SQL sorgusu ile kullanıcının belirlediği kelime sayısını güncelle
    $query = "UPDATE kullanici SET goruntulenecek_kelime_sayisi = :goruntulenecek_kelime_sayisi WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->execute([
        'goruntulenecek_kelime_sayisi' => $goruntulenecek_kelime_sayisi,
        'user_id' => $_SESSION['user_id']
    ]);

    // Kullanıcıyı başka bir sayfaya yönlendir
    header("Location: index2.php");
    exit();
}

// Kullanıcının mevcut ayarlarını al
$query = "SELECT goruntulenecek_kelime_sayisi FROM kullanici WHERE user_id = :user_id";
$statement = $db->prepare($query);
$statement->execute(['user_id' => $_SESSION['user_id']]);
$result = $statement->fetch();
$mevcut_goruntulenecek_kelime_sayisi = $result['goruntulenecek_kelime_sayisi'];

// Kullanıcının doğru cevapladığı soruların sayısını al
$query = "SELECT COUNT(*) AS dogru_cevap FROM bilinen_sorular WHERE user_id = :user_id";
$statement = $db->prepare($query);
$statement->execute(['user_id' => $_SESSION['user_id']]);
$result = $statement->fetch();
$dogru_cevaplanan_kelime_sayisi = $result['dogru_cevap'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayarlar</title>
</head>
<body>
    <h2>Ayarlar</h2>
    <form action="ayarlar.php" method="POST">
        <label for="goruntulenecek_kelime_sayisi">Görüntülenecek Kelime Sayısı:</label><br>
        <input type="number" id="goruntulenecek_kelime_sayisi" name="goruntulenecek_kelime_sayisi" value="<?php echo $mevcut_goruntulenecek_kelime_sayisi; ?>" required><br><br>
        
        <label>Doğru Cevapladığınız Kelime Sayısı: <?php echo $dogru_cevaplanan_kelime_sayisi; ?></label><br><br>

        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
