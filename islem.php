<?php   

require 'baglan.php';
if(isset($_POST['register'])){
    //echo"doğru yer";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    if(!$username){
        echo 'lütfen kullanıcı adını giriniz';
    }elseif (!$pass || !$pass2){
        echo 'lütfen şifre giriniz';
} elseif ($pass != $pass2){
    echo 'girdiğiniz parolalar birbiriyle uyuşmuyor';
}else{
    $sorgu = $db->prepare('INSERT INTO kullanici SET username = ?, email = ?, userpassword = ? '  );
    $ekle = $sorgu ->execute([
        $username,$email,$pass
    ]);
    if($ekle){
        echo 'kayit basariyla gercekleşti yönlendiriliyorsunuz';
        header('refresh:2; index2.php');
}else{
    echo 'bir hata oluştu';
}
}

}

?>