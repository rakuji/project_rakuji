<?php
require __DIR__ . '/parts/connect_db.php';

?>

<?php
require __DIR__ . '/parts/connect_db.php';
//需指定筆數，所以要連資料庫

$mid = isset($_GET['MID']) ? intval($_GET['MID']) : 1;

$sql = "SELECT * FROM member WHERE MID=$mid";
// var_dump($mid); 
// print_r($sql);
$row = $pdo->query($sql)->fetch(); //執行sql拿到物件

print_r($row);
// var_dump($row); //格式錯誤會給你null

?>


   