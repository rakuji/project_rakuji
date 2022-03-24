<?php
require __DIR__ . '/../parts/connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0 ;

$sql = "DELETE FROM `latest_news` WHERE sid=$sid ";

$stmt =$pdo ->query($sql);

 echo $stmt ->rowCount(); //刪除幾筆


 //原頁面刪除後仍在該頁
 if($_SERVER['HTTP_REFERER']){
     header('Location: '.$_SERVER['HTTP_REFERER']);
 } else {
     header('Location : news-list.php');
    }