<?php

try{
    $db = new PDO("mysql:host=localhost; dbname=quiz; charset=utf8", 'root', '');
    //echo"veritabanı baglantisi basarili";
}
catch(Exception $e){
    echo "".$e->getMessage()."";
 }

?>