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

// Formdan gelen verileri işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $kelime = $_POST['kelime'];
    $turkish_translation = $_POST['turkish_translation'];
    $example_sentences = $_POST['example_sentences'];
    
    // Dosya yüklendi mi kontrol et
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
        $temp_name = $_FILES['image_upload']['tmp_name'];
        $name = $_FILES['image_upload']['name'];
        $image_path = 'uploads/' . $name; // Resimlerin yükleneceği klasörün adını ve resmin adını belirle
        move_uploaded_file($temp_name, $image_path);
    } else {
        $image_path = ''; // Dosya yüklenmediyse boş bir değer ata
    }
    
    // Kullanıcı kimliğini al
    $user_id = $_SESSION['user_id'];

    // Veritabanına kelimeyi ekleme sorgusu
    $query = "INSERT INTO kelime (user_id, kelime, turkish_translation, example_sentences, image_path)
              VALUES (:user_id, :kelime, :turkish_translation, :example_sentences, :image_path)";
    $statement = $db->prepare($query);
    $statement->execute([
        'user_id' => $user_id,
        'kelime' => $kelime,
        'turkish_translation' => $turkish_translation,
        'example_sentences' => $example_sentences,
        'image_path' => $image_path
    ]);

    // Başarı mesajı göster
    $_SESSION['success'] = "Kelime başarıyla eklendi!";
    header("Location: index2.php"); // Kullanıcıyı başka bir sayfaya yönlendir
    exit(); // Kodun burada sonlanmasını sağla
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelime Ekleme Formu</title>
</head>
<body>
    <h2>Kelime Ekleme Formu</h2>
    <form action="ekle.php" method="POST" enctype="multipart/form-data">
        <label for="kelime">Kelime:</label><br>
        <input type="text" id="kelime" name="kelime" required><br><br>
        
        <label for="turkish_translation">Türkçe Çevirisi:</label><br>
        <input type="text" id="turkish_translation" name="turkish_translation" required><br><br>
        
        <label for="example_sentences">Örnek Cümleler:</label><br>
        <textarea id="example_sentences" name="example_sentences" rows="4" cols="50" required></textarea><br><br>
        
        <label for="image_upload">Resim:</label><br>
        <input type="file" id="image_upload" name="image_upload" accept="image/*"><br><br>
        
        <input type="submit" value="Kelimeyi Ekle">
    </form>
</body>
</html>
