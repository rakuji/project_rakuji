<?php
//連結資料庫
require __DIR__ . '/../parts/connect_db.php';

//指定PK
$mid = isset($_GET['MID']) ? intval($_GET['MID']): 0;

// 刪除
$sql = "DELETE FROM `member` WHERE MID= $mid";

$stmt = $pdo->query($sql);

echo $stmt->rowCount(); //刪除幾筆
// rowCount(幾筆資料)
// echo $stmt->rowCount(); // 刪除幾筆
if(! empty($_SERVER['HTTP_REFERER'])){
    //從哪來從哪回去
    header('Location: '. $_SERVER['HTTP_REFERER']);
    
} else {
header('Location: member-list2.php');
//轉到列表頁
}