<?php
$title = '樂食町';
$pageName = 'hr_list';
$systemName = '員工管理系統';
$systemitem = '員工列表';
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
            <?php include __DIR__ . '../../parts/breadcrumb.php' ?>
            <?php include __DIR__ . '../../parts/hr-navbar.php'; ?>

            <?php
            $title = '員工列表';
            $pageName = 'HR-list';
            $perPage = 5; // 每一頁有幾筆
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
            if ($page < 1) {
                header('Location: hr_list.php?page=1');
                exit;
            }

            $hr = isset($_GET['hr']) ? ($_GET['hr']) : '%'; //查詢
            $t_sql = "SELECT COUNT(1) FROM employees WHERE `name` like '{$hr}'";
            // 取得總筆數
            $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
            $rows = []; // 預設沒有資料
            $totalPages = 0;
            if ($totalRows) {
                // 總頁數
                $totalPages = ceil($totalRows / $perPage);
                if ($page > $totalPages){
                    header("Location: hr-list.php?page=$totalPages");
                    exit;
                }
                $sql = sprintf("SELECT `employee_id`,`name`,`age`,`department_name`,`job_title`,`hire_date`,`salary`,`phone_number`,`email`,`birthday`,`education`,`address` FROM 
                (`employees`INNER JOIN`jobs` ON `employees`.`job_id` = `jobs`.`job_id`)
                INNER JOIN `departments` on `employees`.`department_id` = `departments`.`department_id` WHERE `name` like '%s' ORDER BY `employee_id` DESC LIMIT %s, %s",$hr, ($page - 1) * $perPage, $perPage);
                $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
            }
            ?>




            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">編號</th>
                                <th scope="col">姓名</th>
                                <th scope="col">年齡</th>
                                <th scope="col">部門</th>
                                <th scope="col">職稱</th>
                                <th scope="col">到職日期</th>
                                <th scope="col">薪資</th>
                                <th scope="col">電話</th>
                                <th scope="col">email</th>
                                <th scope="col">生日</th>
                                <th scope="col">教育程度</th>
                                <th scope="col">通訊地址</th>
                                <th scope="col">修改</th>
                                <th scope="col">刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($totalRows == 0) {
                                echo "<tr><td colspan='8'><b>查無此人!</b></td></tr>";
                            }
                            ?>
                            <?php foreach ($rows as $r) : ?>
                                <tr>
                                    <td><?= $r['employee_id'] ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['age'] ?></td>
                                    <td><?= $r['department_name'] ?></td>
                                    <td><?= $r['job_title'] ?></td>
                                    <td><?= $r['hire_date'] ?></td>
                                    <td><?= $r['salary'] ?></td>
                                    <td><?= $r['phone_number'] ?></td>
                                    <td><?= $r['email'] ?></td>
                                    <td><?= $r['birthday'] ?></td>
                                    <td><?= $r['education'] ?></td>
                                    <td><?= strip_tags($r['address']) ?></td>
                                    <td>
                                        <a href="hr_edit.php?employee_id=<?= $r['employee_id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td> <a href="javascript: del_it(<?= $r['employee_id'] ?>)">
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
                function del_it(employee_id) {
                    if (confirm(`確定要刪除編號為 ${employee_id} 的資料嗎?`)) {

                        location.href = 'hr_delete.php?employee_id=' + employee_id;
                    }

                }
            </script>

        </div>

    </div>
</div>



<?php include __DIR__ . '../../parts/script.php'; ?>

<?php include __DIR__ . '../../parts/html-foot.php'; ?>