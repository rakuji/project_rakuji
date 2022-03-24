<?php
require __DIR__ . '/../parts/connect_db.php';

header('Content-Type: application/json');
// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,
];

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

if(empty($_POST['p_id']) or empty($_POST['p_name'])){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 欄位檢查

$sql = "INSERT INTO `product` (`product_id`,`product_name`,`product_desc`,`product_price`,`product_cal`,`period_id` ) VALUES
        (?,?,?,?,?,?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['p_id'],
    $_POST['p_name'],
    $_POST['p_desc'] ?? '',
    $_POST['p_price'] ?? 0,
    $_POST['p_cal'] ?? 0,
    $_POST['period'] ?? 1
]);


$output['rowCount'] = $stmt->rowCount(); // 修改資料的筆數
if($stmt->rowCount()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料新增失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

