<?PHP
require __DIR__ . '/../parts/connect_db.php';

//食譜
$cr_id = isset($_GET['cr_id']) ? intval($_GET['cr_id']) : 0;

$c_sql = "DELETE FROM `creative_recipes` WHERE cr_id=$cr_id";

$c_stmt = $pdo->query($c_sql);

echo $c_stmt->rowCount(); //刪除幾筆
if (!empty($_SERVER['HTTP_REFERER'])) {
    //從那裏來回那裏去
    header('Location:' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: recipes_list.php');
};


//食材
$nl_id = isset($_GET['nl_id']) ? intval($_GET['nl_id']) : 0;

$n_sql = "DELETE FROM `nutrition_label` WHERE nl_id=$nl_id";

$n_stmt = $pdo->query($n_sql);

echo $n_stmt->rowCount(); //刪除幾筆
if (!empty($_SERVER['HTTP_REFERER'])) {
    //從那裏來回那裏去
    header('Location:' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: food_list.php');
};