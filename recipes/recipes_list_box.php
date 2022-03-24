<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '食譜查詢';
$pageName = 'recipes_list';
$perPage = 1;   //每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看的頁碼

if ($page < 1) {
    header('Location: recipes_list.php?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM creative_recipes"; //食譜
$r_sql = "SELECT COUNT(1) FROM recipes_match"; //食材用量
$n_sql = "SELECT COUNT(1) FROM nutrition_label"; //營養標示
$member_sql = "SELECT COUNT(1) FROM member"; //會員系統

//取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$systemName = 123;
$systemitem = 456;

$rows = []; //預設沒有資料

$totalpages = 0;

if ($totalRows) {
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: ab-list.php?page=$totalPages");
        exit;
    }
    $sql =  sprintf("SELECT * FROM creative_recipes LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    //總頁數
    $rows = $pdo->query($sql)->fetchAll(); //拿到分頁資料

}
?>

</style>


<?php include __DIR__ . "/html-head.php"; ?>
<div class="container-fluid">


    <!-- 左側選單欄 -->
    <!-- 主要內容區 -->
    <div class="container">







            <div class="col">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">料理名稱</th>
                            <th scope="col">料理照片</th>
                            <th scope="col">菜籃</th>
                            <th scope="col">調理方法</th>
                            <th scope="col">食譜所有人</th>
                            <th scope="col">建立時間</th>
                            <th scope="col">編輯</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?PHP foreach ($rows as $r) : ?>
                            <tr class="fw-bold">
                                <td><?= $r['cr_id'] ?></td>
                                <td><?= $r['cr_name'] ?></a> </td>
                                <td><img src="<?= $r['photo_id'] ?>" height="100px" width="150px" alt="<?= $r['cr_name'] ?>"></td>
                                <td><?= $r['match_id'] ?></td>
                                <td><?= $r['cm_text'] ?></td>
                                <td><?= $r['member_id'] ?></td>
                                <td><?= $r['created_at'] ?></td>
                                <td>
                                    <a href="recipes-edit.php?cr_id=<?= $r['cr_id'] ?>"><i class="h3  fa-solid fa-pen"></i>
                                </td>

                            </tr>
                        <?PHP endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>






</div>












<?php include __DIR__ . "/script.php"; ?>