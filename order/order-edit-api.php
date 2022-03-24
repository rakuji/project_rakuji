<?php
require '../parts/connect_db.php';

header('Content-Type: application/json');

// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,

];

$output['postData'] = $_POST; // 讓前端做資料查看，資料是否一致


if (empty($_POST['id']) or empty ($_POST['member_id'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


// TODO: 欄位檢查

$sql = "UPDATE `order` SET
        `member_id` = ?,
        `meal_method` = ?,
        `address` = ?,
        `total` = ?,
        `deliverfee` = ?,
        `grandtotal` = ?,
        `paytype` = ?,
        `status` = ?
        WHERE `id` =?";

$stmt = $pdo -> prepare($sql);

$stmt -> execute([
    $_POST['member_id'] ?? '',
    $_POST['meal_method'] ?? '',
    $_POST['address'] ?? '',
    $_POST['total'] ?? '',
    $_POST['deliverfee'] ?? '',
    $_POST['grandtotal'] ?? '',
    $_POST['paytype'] ?? '',
    $_POST['status'] ?? '',
    $_POST['id'],
]);

$output['rowCount'] = $stmt -> rowCount(); // 修改資料的筆數

if($stmt -> rowCount()){
    $output['error'] = '';
    $output['success'] = true ;
}else{
    $output['error'] = '資料沒有修改' ;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);

