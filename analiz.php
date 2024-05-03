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

// Kullanıcının toplam kelime sayısını al
$query_toplam_kelime_sayisi = "SELECT COUNT(*) AS toplam_kelime_sayisi FROM kelime WHERE user_id = :user_id OR user_id = 1";
$statement_toplam_kelime_sayisi = $db->prepare($query_toplam_kelime_sayisi);
$statement_toplam_kelime_sayisi->execute(['user_id' => $user_id]);
$result_toplam_kelime_sayisi = $statement_toplam_kelime_sayisi->fetch();
$toplam_kelime_sayisi = $result_toplam_kelime_sayisi['toplam_kelime_sayisi'];

// Kullanıcının bildiği kelime sayısını al
$query_bildigi_kelime_sayisi = "SELECT COUNT(*) AS bildigi_kelime_sayisi FROM bilinen_sorular WHERE user_id = :user_id";
$statement_bildigi_kelime_sayisi = $db->prepare($query_bildigi_kelime_sayisi);
$statement_bildigi_kelime_sayisi->execute(['user_id' => $user_id]);
$result_bildigi_kelime_sayisi = $statement_bildigi_kelime_sayisi->fetch();
$bildigi_kelime_sayisi = $result_bildigi_kelime_sayisi['bildigi_kelime_sayisi'];

// Chart.js için kullanılacak verileri hazırla
$labels = ["Toplam Kelime Sayısı", "Bildiği Kelime Sayısı"];
$data = [$toplam_kelime_sayisi, $bildigi_kelime_sayisi];

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Kelime Bilgisi</title>
    <!-- Chart.js kütüphanesi -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Kullanıcı Kelime Bilgisi</h2>
    <!-- Grafik için canvas elementi -->
    <canvas id="myChart"></canvas>

    <script>
        // Grafik verileri
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;

        // Grafik oluşturma
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kelime Sayısı',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
