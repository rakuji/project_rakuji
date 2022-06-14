<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '食譜查詢';
$pageName = 'food_list';
$perPage = 10;   //每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看的頁碼

if ($page < 1) {
    header('Location: food_list.php?page=1');
    exit;
}


$r_sql = "SELECT COUNT(1) FROM nutrition_label"; //食材用量


//取得總筆數
$totalRows = $pdo->query($r_sql)->fetch(PDO::FETCH_NUM)[0];
$systemName = `${$pageName}`;
$systemitem = "食材列表";

$rows = []; //預設沒有資料

$totalpages = 0;

if ($totalRows) {
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: food_list.php?page=$totalPages");
        exit;
    }
    $sql =  sprintf("SELECT * FROM nutrition_label LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    //總頁數
    $rows = $pdo->query($sql)->fetchAll(); //拿到分頁資料

}
?>



<?php include __DIR__ . '/html-head.php'; ?>


<style>
    form .readd .form-text {
        color: red;
    }
</style>

<!-- css -->
<?php include __DIR__ . "/html-head.php"; ?>
<?php include __DIR__ . "/banner.php"; ?>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '/aside2.php'; ?></div>
        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- 麵包屑 -->
            <?php include __DIR__ . '/../parts/breadcrumb.php'; ?>
            <!-- 列表 -->

            <div class="col">
                <div class="container">


                </div>
                <div class="row">
                    <div class="d-flex flex-row-reverse">
                        <form class="d-flex mb-3">
                            <input class="form-control me-2" id="myInput" type="search" placeholder="請輸入關鍵字" aria-label="Search">
                            <button class="btn btn-outline-danger search" type="button">Search</button>
                        </form>
                    </div>

                    <!-- 列表 -->
                    <?php include __DIR__ . '/recipes_list_navar.php'; ?>
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">食材名稱</th>
                                    <th scope="col">熱量(每100g)</th>
                                    <th scope="col">脂肪(每100g)</th>
                                    <th scope="col">蛋白質(每100g)</th>
                                    <th scope="col">碳水化合物(每100g)</th>
                                    <th scope="col">鈉(每100g有多少mg)</th>
                                    <th scope="col">鉀(每100g有多少mg)</th>
                                    <th scope="col">鐵(每100g有多少mg)</th>
                                    <th scope="col" name="del-top">刪除</th>
                                    <th scope="col">編輯</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?PHP foreach ($rows as $r) : ?>
                                    <tr class="fw-bold">

                                        <td><?= $r['nl_id'] ?></td>
                                        <td><?= $r['fnl_name'] ?></td>
                                        <td><?= $r['fnl_kcal'] ?></td>
                                        <td><?= $r['fnl_Fat'] ?></td>
                                        <td><?= $r['fnl_protein'] ?></td>
                                        <td><?= $r['fnl_carbohydrate'] ?></td>
                                        <td><?= $r['fnl_sodium'] ?></td>
                                        <td><?= $r['fnl_Potassium'] ?></td>
                                        <td><?= $r['fnl_iron'] ?></td>
                                        <td>
                                            <a href="javascript: del_it(<?= $r['nl_id'] ?>)">
                                                <i class="h3 fa-solid fa-trash-can"></i>
                                        </td>
                                        <td>
                                            <a href="food_edit.php?nl_id=<?= $r['nl_id'] ?>"><i class="h3  fa-solid fa-pen"></i>
                                        </td>

                                    </tr>
                                <?PHP endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 頁籤 -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item  <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a></li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a></li>
                </ul>
            </nav>

        </div>
    </div>
</div>

<script>
    function del_it(nl_id) {
        if (confirm(`確定要刪除編號為 ${nl_id} 的資料嗎?`)) {
            location.href = 'recipes-delete.php?nl_id=' + nl_id;
        }
    }
</script>
<?php include __DIR__ . '/script.php'; ?>