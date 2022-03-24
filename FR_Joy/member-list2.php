<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '樂食町';
$pageName = 'home';
$systemName = '會員管理系統';
$systemitem = '會員名單';
?>

<?php include __DIR__ . '/../parts/html-head.php'; ?>

<?php include __DIR__ . '/../parts/banner.php'; ?>


<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '/../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <?php include __DIR__ . '/../parts/breadcrumb.php'; ?>
            <?php include __DIR__ . '/parts/navbar.php'; ?>
            <?php
            $perPage = 5; // 每一頁有幾筆
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
            if ($page < 1) {
                header('Location: member-list2.php?page=1');
                exit;
            }

            $mem = isset($_GET['mem']) ? ($_GET['mem']) : '%';  // user在查詢框打的序號

           
            $t_sql = "SELECT COUNT(1) FROM member WHERE MID like'${mem}'";
            // 取得總筆數
            // $t_sql = "SELECT COUNT(*) FROM member like '${mem}'";
            //總筆數2
            $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
            $rows = []; // 預設沒有資料
            $totalPages = 0;
            if ($totalRows) {
                // 總頁數
                $totalPages = ceil($totalRows / $perPage);
                if ($page > $totalPages) {
                    header("Location: member-list2.php?page=$totalPages");
                    exit;
                }

                // //sql1
                // $sql1 = sprintf("SELECT * FROM member ORDER BY MID DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
                //sql2
                $sql2 = sprintf("SELECT * FROM member WHERE MID LIKE '%s' ORDER BY MID DESC LIMIT %s, %s", $mem, ($page - 1) * $perPage, $perPage);

                $rows = $pdo->query($sql2)->fetchAll(); // 拿到分頁資料
                // echo  $page ;
            }

            ?>
            <div class="container">
            

                <!-- search -->
                <!-- <form method="$_GET" action="member-list2.php">
                    <div class="row">

                        <div class=" d-flex mb-3 ">
                            <div class="form-outline">
                                <input type="text" class="form-control" type="search" id="form1" name="mem" placeholder="search..." aria-label="Search" required >

                            </div>
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> -->
                <!-- search -->
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-row-reverse">
                            <form class="d-flex mb-3" method="$_GET" action="member-list2.php">
                                <input class="form-control me-2" name="mem" type="text" placeholder="search..." aria-label="Search" required>
                                <button class="btn btn-primary search" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- search 2-->

                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <i class="fas fa-trash-alt"></i>
                                    </th>
                                    <th scope="col">MID</th>
                                    <th scope="col">創建時間</th>
                                    <th scope="col">大頭貼</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">身分證</th>
                                    <th scope="col">性別</th>
                                    <th scope="col">職業</th>
                                    <th scope="col">出生年月日</th>
                                    <th scope="col">居住城市</th>
                                    <th scope="col">地址</th>
                                    <th scope="col">婚姻</th>
                                    <th scope="col">子嗣</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">手機</th>
                                    <th scope="col">密碼</th>
                                    <th scope="col">
                                        <i class="fas fa-edit"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $r) : ?>
                                    <tr>
                                        <!--  功能:刪除 -->
                                        <td>
                                            <!--  第一種:刪除 -->
                                            <!-- <a href="javascript: del_it(<?= $r['MID'] ?>)">-->

                                            <!--  第二種:刪除 -->
                                            <a href="mem-delete.php?MID=<?= $r['MID'] ?>" onclick="return confirm(`確定要刪除編號為 <?= $r['MID'] ?>的資料嗎?`)">
                                                <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td><?= $r['MID'] ?></td>
                                        <td><?= $r['Mcreate_date'] ?></td>
                                        <td><?= $r['Mpic'] ?></td>
                                        <td><?= $r['Mname'] ?></td>
                                        <td><?= $r['Midentity'] ?></td>
                                        <td><?= $r['Msex'] ?></td>
                                        <td><?= $r['Mvocation'] ?></td>
                                        <td><?= $r['Mbirthday'] ?></td>
                                        <td><?= $r['Mcity'] ?></td>
                                        <td><?= $r['Maddress'] ?></td>
                                        <td><?= $r['Mmarry'] ?></td>
                                        <td><?= $r['Mchild'] ?></td>
                                        <td><?= $r['Memail'] ?></td>
                                        <td><?= $r['Mphone'] ?></td>
                                        <td><?= $r['Mpassword'] ?></td>


                                        <td>
                                            <!--  功能:修改 -->
                                            <a href="mem-edit2.php?MID=<?= $r['MID'] ?>"><i class="fas fa-edit"></i>
                                            </a>
                                        </td>

                                    <?php endforeach ?>



                            </tbody>
                        </table>
                        <!-- 頁碼 -->
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
                        <!-- 頁碼結尾 -->
                    </div>
                </div>

            </div>
            <!-- 內容區結尾 -->
        </div>


    </div>
</div>



<?php include __DIR__ . '/../parts/script.php'; ?>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>