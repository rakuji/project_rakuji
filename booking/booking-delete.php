<?php
require __DIR__ . '/../parts/connect_db.php';

$sid = isset($_GET['id']) ? intval($_GET['id']) : 0 ;

$sql = "DELETE FROM `booking` WHERE id=$sid" ;

$stmt = $pdo -> query($sql);

// echo $stmt -> rowCount(); //刪除幾筆

if(! empty($_SERVER['HTTP_REFERER'])){
    // 從哪裡來回哪裡去
    header('Location: '. $_SERVER['HTTP_REFERER']);
}else {
    header('Location: booking-list.php');
}

