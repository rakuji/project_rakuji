<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/banner.php'; ?>

<?php
require __DIR__ . '/../parts/connect_db.php';
$systemName = '活動管理系統';
$systemitem = '特殊節日及壽星';
$pageName = 'specialdates-list';

$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: specialdates-list.php?page=1');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM member";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: specialdates-list.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM member ORDER BY mid  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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

                        <th scope="col">會員編碼</th>
                        <th scope="col">會員名稱</th>
                        <th scope="col">會員性別</th>
                        <th scope="col">有無子嗣</th>
                        <th scope="col">電子郵件</th>
                        <th scope="col">手機號碼</th>
   
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>

                            <td><?= $r['MID'] ?></td>
                            <td><?= $r['Mname'] ?></td>
                            <td><?= $r['Msex'] ?></td>
                            <td><?= $r['Mchild'] ?></td>
                            <td><?= $r['Memail'] ?></td>
                            <td><?= $r['Mphone'] ?></td>
                        
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