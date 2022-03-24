<?php
require __DIR__ . '../../parts/connect_db.php';

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

if (empty($_POST['employee_id']) or empty($_POST['name'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


// TODO: 欄位檢查


$sql = "UPDATE `employees` SET
    `name`=?,
     `email`=?,
      `phone_number`=?,
       `hire_date`=?,
       `job_id`=?,
       `salary`=?,
       `department_id`=?,
       `birthday`=?,
       `age`=?,
       `education`=?,
       `address`=? 
       WHERE `employee_id`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['email'] ?? '',
    $_POST['phone_number'] ?? '',
    $_POST['hire_date'] ?? '',
    $_POST['job_id'] ?? '',
    $_POST['salary'] ?? '',
    $_POST['department_id'] ?? '',
    $_POST['birthday'] ?? '',
    $_POST['age'] ?? '',
    $_POST['education'] ?? '',
    $_POST['address'] ?? '',
    $_POST['employee_id']
]);

$output['insertId'] = $pdo->lastInsertId(); // 取得最近加入資料的 PK
$output['rowCount'] = $stmt->rowCount(); // 新增資料的筆數
if ($stmt->rowCount()) {
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
