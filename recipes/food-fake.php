<?php
require __DIR__ . '/../parts/connect_db.php';
$pageName = 'food_add';
$sql = "INSERT INTO `nutrition_label`(`fnl_name`, `fnl_photo`,`fnl_kcal`,`fnl_Fat`,`fnl_protein`,`fnl_carbohydrate`,`fnl_sodium`,`fnl_Potassium`,`fnl_iron`) VALUES (?, ? , ? , ? , ? , ? , ? , ? , ? )";

//避免SQL injection
$stmt = $pdo->prepare($sql);

$stmt->execute([
    '測試',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',
    '5',

]);

echo $pdo->lastInsertId();  //取得最新新增資料的PK
