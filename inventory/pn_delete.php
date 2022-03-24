<?php
require __DIR__ . '/../parts/connect_db.php';
include __DIR__ . '/head_inv.php';

// $pn = isset($_GET['pn']) ? ($_GET['pn']) : '%';  // user在查詢畫面輸入的的品號
$pn_del = isset($_GET['pn_del']) ? $_GET['pn_del'] : ""; // user要刪除的品號
// echo $pn;
$sql = "DELETE FROM product WHERE product_id = '$pn_del'";
// echo $sql;
$stmt = $pdo->query($sql);

// echo $stmt->rowCount(); // 刪除幾筆

if(! empty($_SERVER['HTTP_REFERER'])){
    // 從哪裡來回哪裡去
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {
    header("Location: pn_list.php");
}

