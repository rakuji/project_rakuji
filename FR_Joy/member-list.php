<?php

require __DIR__.'/parts/connect_db.php';
$title = '會員名單';
$pageName = 'member';
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: member-list.php?page=1');
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
        header("Location: member-list.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM member ORDER BY mid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </a>
                    </li>
                    <?php for($i=$page-5; $i<=$page+5; $i++): 
                        if($i>=1 and $i<=$totalPages):
                        ?>
                    <li class="page-item <?= $page==$i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endif; endfor; ?>
                    <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">
                        <i class="fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fas fa-trash-alt"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">create_date</th>
                        <th scope="col">pic</th>
                        <th scope="col">Name</th>
                        <th scope="col">identity</th>
                        <th scope="col">sex</th>
                        <th scope="col">vocation</th>
                        <th scope="col">birthday</th>
                        <th scope="col">city</th>
                        <th scope="col">Address</th>
                        <th scope="col">marry</th>
                        <th scope="col">child</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">password</th>
                        <th scope="col">
                            <i class="fas fa-edit"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <!-- 假連結 刪除的另一種方式 -->
                                <a href="#">
                                <i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td><?= $r['mid'] ?></td>
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
                           
                            <!-- 第二種跳脫 strip_tags — 从字符串中去除 HTML 和 PHP 标记 -->
                            <!-- <td><?= strip_tags($r['mid']) ?></td> -->
                            <td>
                                <!--  新增功能:修改 -->
                                <a href="#"><i class="fas fa-edit"></i></a>
    
                            </td>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/script.php'; ?>
 <!-- 假連結 刪除的另一種方式 -->
<script>
    function delect_it(mid){
        if(confirm(`確定要刪除編號為 ${mid} 的資料嗎?`)){
            
            location.href = 'mem_delect.php?=mid' + mid;
        }

    }

</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>
