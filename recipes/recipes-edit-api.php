<?PHP
require __DIR__ . '/../parts/connect_db.php';


//輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'insertId' => 0,
    'rowCount' => 0,
];



if (empty($_POST['cr_id']) or empty($_POST['cr_name'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['postData'] = $_POST; //讓前端做資料查看，資料是否一致
//TODO : 欄位檢查

$sql = "UPDATE `creative_recipes` SET
 `cr_name`=?,
 `match_id`=?,
 `photo_id`=?,
 `cm_text`=?,
 `member_id`=?
 WHERE `cr_id`=? ";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $_POST['cr_name'],
    $_POST['match_id'] ?? '',
    $_POST['photo_id'] ?? '',
    $_POST['cm_text'] ?? '',
    $_POST['member_id'] ?? '',
    $_POST['cr_id'],

]);
$output['insertId'] = $pdo->lastInsertId(); //取得最近加入資料的PK
$output['rowCount'] = $stmt->rowCount(); //新增資料的筆數
if ($stmt->rowCount()) {
    $output['error'] = '';
    $output['success'] = 'true';
} else {
    $output['error'] = '資料沒有編輯成功';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
