<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '編輯食譜';
$pageName = 'recipes-edit';
$systemName = "創意食譜系統";
$systemitem = "食譜列表";
$systemthere = "編輯食譜";

$cr_id = isset($_GET['cr_id']) ? intval($_GET['cr_id']) : 0;

$sql = "SELECT * FROM creative_recipes WHERE cr_id=$cr_id";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: recipes_inquire.php');  //找不到資料轉向列表頁
    exit;
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
            <?php include __DIR__ . '/aside3.php'; ?></div>
        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- 麵包屑 -->
            <?php include __DIR__ . '/breadcrumb_02.php'; ?>
            <!-- 列表 -->

            <div class="col">
                <div class="container">

                    <div class="row">
                        <?php include __DIR__ . '/recipes_list_navar.php'; ?>
                        <div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">編輯食譜</h5>
                                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                                        <input type="hidden" name="cr_id" value="<?= $row['cr_id'] ?>">

                                        <div class="readd">
                                            <label for="cr_name" class="form-label">料理名稱</label>
                                            <input type="text" class="form-control" id="cr_name" name="cr_name" required value="<?= htmlentities($row['cr_name']) ?>">
                                            <div class="form-text"></div>

                                            <div class="readd">
                                                <label for="match_id" class="form-label">食材搭配ID</label>
                                                <textarea class="form-control" id="match_id" name="match_id" cols="30" rows="3"><?= $row['match_id'] ?></textarea>
                                                <div class="form-text"></div>
                                            </div>
                                            <div class="readd">
                                                <label for="photo_id" class="form-label">料理照片</label>
                                                <textarea class="form-control" id="photo_id" name="photo_id" cols="30" rows="3"><?= $row['photo_id'] ?></textarea>
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="cm_text" class="form-label">調理方法</label>
                                                <textarea class="form-control" id="cm_text" name="cm_text" cols="30" rows="3"><?= $row['cm_text'] ?></textarea>
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="member_id" class="form-label">會員系統ID</label>
                                                <textarea class="form-control" id="member_id" name="member_id" cols="30" rows="3"><?= $row['member_id'] ?></textarea>
                                                <div class="form-text"></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">編輯</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const mobile = document.form1.member_id; // DOM element
    const mobile_msg = member_id.closest('.readd').querySelector('.form-text');

    const name = document.form1.cr_name;
    const name_msg = cr_name.closest('.readd').querySelector('.form-text');

    function checkForm() {
        let isPass = true; // 有沒有通過檢查
        name_msg.innerText = ''; // 清空訊息
        mobile_msg.innerText = ''; // 清空訊息
        // TODO: 表單資料送出之前, 要做格式檢查
        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('recipes-edit-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('編輯成功');
                        // location.href = 'ab-list.php';
                    } else {
                        alert('編輯失敗');
                    }
                })
        }
    }
</script>
<?php include __DIR__ . '/script.php'; ?>