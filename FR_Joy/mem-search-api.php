<?php
$sql = 'SELECT * FROM member WHERE MID = $mid';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sn', '1');
$stmt->execute();

// 取得單筆資料
$stmt->fetch(PDO::FETCH_ASSOC);

// 取得多筆資料
$stmt->fetchAll(PDO::FETCH_ASSOC);
