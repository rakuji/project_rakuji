<?php
require __DIR__ . '/../parts/connect_db.php';
$pageName = 'recipes_add';
$sql = "INSERT INTO `creative_recipes`(`name`, `match_id`, `photo`, `cm_text`, `member_id`, `created_at`) VALUES (?, ? , ? , ? , ? , NOW())";

//避免SQL injection
$stmt = $pdo->prepare($sql);

$stmt->execute([
    '蛋炒飯',
    '5',
    'http://123456789',
    '倒入寬油',
    '9',
]);

echo $pdo->lastInsertId();  //取得最新新增資料的PK
