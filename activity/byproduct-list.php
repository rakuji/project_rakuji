<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/banner.php'; ?>

<?php
require __DIR__ . '/../parts/connect_db.php';
$systemName = '活動管理系統';
$systemitem = '副產品專區';
$pageName = 'byproduct-list';


$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: byproduct-list.php?page=1');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM product";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: byproduct-list.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM product ORDER BY product_id  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}
?>







<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>


<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '/../parts/aside.php'; ?>
        </div>


        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">

            <div class="col">
                <?php include __DIR__ . '/../parts/html-head.php'; ?>
                <?php include __DIR__ . '/../parts/breadcrumb.php'; ?>

            </div>

             
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th scope="col">餐點/商品品號</th>
                        <th scope="col">餐點/商品名稱</th>
                        <th scope="col">餐點/商品敘述</th>
                        <th scope="col">餐點/商品單價</th>
                        <th scope="col">供應時段編號</th>
                        <th scope="col">單位編號</th>
                        <th scope="col">餐點/商品照片</th>

   
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>

                            <td><?= $r['product_id'] ?></td>
                            <td><?= $r['product_name'] ?></td>
                            <td><?= $r['product_desc'] ?></td>
                            <td><?= $r['product_price'] ?></td>
                            <td><?= $r['period_id'] ?></td>
                            <td><?= $r['unit_id'] ?></td>
                            <td><?= $r['product_image'] ?></td>

                        
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>




</script>
<?php include __DIR__ . '/../parts/script.php'; ?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>