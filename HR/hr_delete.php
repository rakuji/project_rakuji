<?php
require __DIR__ . '../../parts/connect_db.php';

$employee_id  = isset($_GET['employee_id']) ? intval($_GET['employee_id']) : 0;

$sql = "DELETE FROM `employees` WHERE employee_id=$employee_id ";

$stmt = $pdo->query($sql);

// echo $stmt->rowCount(); // 刪除幾筆
if(! empty($_SERVER['HTTP_REFERER'])){
    // 從哪裡來回哪裡去
    header('Location:  hr_list.php');
} else {
    header('Location: hr_list.php');
}

?>