<?php
require __DIR__ . '/../parts/connect_db.php';
$title = '編輯食譜';
$pageName = 'food-edit';

$systemName = "創意食譜系統";
$systemitem = "食材列表";
$systemthere = "編輯食材";

$nl_id = isset($_GET['nl_id']) ? intval($_GET['nl_id']) : 0;

$sql = "SELECT * FROM nutrition_label WHERE nl_id=$nl_id";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: food_list.php');  //找不到資料轉向列表頁
    exit;
}
?>

<?php include __DIR__ . '/html-head.php'; ?>


<style>
    form .readd .form-text {
        color: red;
    }
</style>

</style>
<!-- css -->
<?php include __DIR__ . "/html-head.php"; ?>
<?php include __DIR__ . "/banner.php"; ?>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '/aside4.php'; ?></div>
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
                                    <h5 class="card-title">編輯食材</h5>
                                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                                        <input type="hidden" name="nl_id" value="<?= $row['nl_id'] ?>">

                                        <div class="readd">
                                            <label for="fnl_name" class="form-label">食材名稱</label>
                                            <input type="text" class="form-control" id="fnl_name" name="fnl_name" required value="<?= htmlentities($row['fnl_name']) ?>">
                                            <div class="form-text"></div>

                                            <div class="readd">
                                                <label for="fnl_kcal" class="form-label">熱量(每100g)</label>
                                                <input type="text" class="form-control" id="fnl_kcal" name="fnl_kcal" value="<?= htmlentities($row['fnl_kcal']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_Fat" class="form-label">脂肪(每100g)</label>
                                                <input type="text" class="form-control" id="fnl_Fat" name="fnl_Fat" value="<?= htmlentities($row['fnl_Fat']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_protein" class="form-label">蛋白質(每100g)</label>
                                                <input type="text" class="form-control" id="fnl_protein" name="fnl_protein" value="<?= htmlentities($row['fnl_protein']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_carbohydrate" class="form-label">碳水化合物(每100g)</label>
                                                <input type="text" class="form-control" id="fnl_carbohydrate" name="fnl_carbohydrate" value="<?= htmlentities($row['fnl_carbohydrate']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_sodium" class="form-label">鈉(每100g有多少mg)</label>
                                                <input type="text" class="form-control" id="fnl_sodium" name="fnl_sodium" value="<?= htmlentities($row['fnl_sodium']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_Potassium" class="form-label">鉀(每100g有多少mg)</label>
                                                <input type="text" class="form-control" id="fnl_Potassium" name="fnl_Potassium" value="<?= htmlentities($row['fnl_Potassium']) ?>">
                                                <div class="form-text"></div>
                                            </div>

                                            <div class="readd">
                                                <label for="fnl_iron" class="form-label">鐵(每100g有多少mg)</label>
                                                <input type="text" class="form-control" id="fnl_iron" name="fnl_iron" value="<?= htmlentities($row['fnl_iron']) ?>">
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
    const mobile = document.form1.fnl_kcal; // DOM element
    const mobile_msg = fnl_kcal.closest('.readd').querySelector('.form-text');

    const name = document.form1.fnl_name;
    const name_msg = fnl_name.closest('.readd').querySelector('.form-text');

    function checkForm() {
        let isPass = true; // 有沒有通過檢查
        name_msg.innerText = ''; // 清空訊息
        mobile_msg.innerText = ''; // 清空訊息
        // TODO: 表單資料送出之前, 要做格式檢查
        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('food_edit-api.php', {
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