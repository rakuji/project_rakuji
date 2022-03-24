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



if (empty($_POST['nl_id']) or empty($_POST['fnl_name'])) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['postData'] = $_POST; //讓前端做資料查看，資料是否一致
//TODO : 欄位檢查

$sql = "UPDATE `nutrition_label` SET
 `fnl_name`=?,
 `fnl_kcal`=?,
 `fnl_Fat`=?,
 `fnl_protein`=?,
 `fnl_carbohydrate`=?,
 `fnl_sodium`=?,
 `fnl_Potassium`=?,
 `fnl_iron`=?
 WHERE `nl_id`=? ";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $_POST['fnl_name'],
    $_POST['fnl_kcal'] ?? '',
    $_POST['fnl_Fat'] ?? '',
    $_POST['fnl_protein'] ?? '',
    $_POST['fnl_carbohydrate'] ?? '',
    $_POST['fnl_sodium'] ?? '',
    $_POST['fnl_Potassium'] ?? '',
    $_POST['fnl_iron'] ?? '',
    $_POST['nl_id'],

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
