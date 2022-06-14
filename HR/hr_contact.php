<?php
$title = '樂食町';
$pageName = 'home';
$systemName = '員工管理系統';
$systemitem = '用餐回饋單';
?>

<?php include __DIR__ . '../../parts/html-head.php'; ?>
<?php include __DIR__ . '../../parts/banner.php'; ?>
<?php require __DIR__ . '../../parts/connect_db.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '../../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <h2></h2>
            <?php include __DIR__ . '../../parts/breadcrumb.php' ?>
            

            <?php
            $title = '用餐回饋單';
            $pageName = 'HR-contact';
            $perPage = 5; // 每一頁有幾筆
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
            if ($page < 1) {
                header('Location: hr_contact.php?page=1');
                exit;
            }

            $t_sql = "SELECT COUNT(1) FROM contact";
            // 取得總筆數
            $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
            $rows = []; // 預設沒有資料
            $totalPages = 0;
            if ($totalRows) {
                // 總頁數
                $totalPages = ceil($totalRows / $perPage);
                if ($page > $totalPages) {
                    header("Location: hr_contact.php?page=$totalPages");
                    exit;
                }

                $sql = sprintf("SELECT `id`,`name`,`email`,`select1`,`subject`,`message` FROM 
                `contact` ORDER BY `id` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
                $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
            }
            ?>




            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">姓名</th>
                                <th scope="col">email</th>
                                <th scope="col">選項</th>
                                <th scope="col">主旨</th>
                                <th scope="col">留言</th>
                                <th scope="col">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r) : ?>
                                <tr>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['email'] ?></td>
                                    <td><?= $r['select1'] ?></td>
                                    <td><?= $r['subject'] ?></td>
                                    <td><?= $r['message'] ?></td>
                                    <td> <a href="javascript: del_it(<?= $r['id'] ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>

                    </table>
                </div>
                <!-- 分頁 -->
<div class="container">
    <div class="row">
        <div class="col">
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
        </div>

        <script>
            function del_it(id) {
                if (confirm(`確定要刪除編號為 ${id} 的資料嗎?`)) {

                    location.href = 'hr_contact_delete.php?id=' + id;
                }

            }
        </script>

    </div>

</div>
</div>




    <?php include __DIR__ . '../../parts/script.php'; ?>

    <?php include __DIR__ . '../../parts/html-foot.php'; ?>