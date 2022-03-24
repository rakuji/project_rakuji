<?php include __DIR__ . '/../parts/html-head.php'; ?>
<?php include __DIR__ . '/../parts/banner.php'; ?>

<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '最新消息列表';
$systemName = '活動管理系統';
$systemitem = '最新消息';
$pageName = 'news-list';
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: news-list.php?page=1');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM latest_news";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: news-list.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM latest_news ORDER BY sid  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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
                <?php include __DIR__ . '/../parts/news-navbar.php'; ?>

            </div>




            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">標題</th>
                        <th scope="col">照片亂碼名</th>
                        <th scope="col">照片</th>
                        <th scope="col">開始時間</th>
                        <th scope="col">結束時間</th>
                        <th scope="col">內容</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>

                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['img_id'] ?></td>
                            <td><img src="../imgs/<?= $r['img_id'] ?>"  alt="" width="120px"></td>
                            <td><?= $r['timestart'] ?></td>
                            <td><?= $r['timeend'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td>
                                <a href="news-edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <td>

                                <!-- <a href="news-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm(`確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?`)"> -->
                                <a href="javascript: del_it(<?= $r['sid'] ?>)">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            </td>
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

        </div>
    </div>
</div>
<script>
    function del_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {

            location.href = 'news-delete.php?sid=' + sid;
        }

    }
    // Q1.刪除後遞補順序
    //Q2.照片放的方式
</script>
<?php include __DIR__ . '/../parts/script.php'; ?>
<?php include __DIR__ . '/../parts/html-foot.php'; ?>