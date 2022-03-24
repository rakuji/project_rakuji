<?php
$title = '新增食譜';
$pageName = 'food_add';

$systemName = "創意食譜系統";
$systemitem = "新增食材";
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
            <div class="row">
                <!-- 列表 -->
                <?php include __DIR__ . '/recipes_add_navar.php'; ?>
                <div class="col">
                    <div class="container">
                    </div>
                    <div class="row">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">新增食材</h5>
                                            <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

                                                <div class="readd">
                                                    <label for="fnl_name" class="form-label">食材名稱</label>
                                                    <input type="text" class="form-control" id="fnl_name" name="fnl_name" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_kcal" class="form-label">熱量(每100g)</label>
                                                    <input type="text" class="form-control" id="fnl_kcal" name="fnl_kcal" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_Fat" class="form-label">脂肪(每100g)</label>
                                                    <input type="text" class="form-control" id="fnl_Fat" name="fnl_Fat" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_protein" class="form-label">蛋白質(每100g)</label>
                                                    <input type="text" class="form-control" id="fnl_protein" name="fnl_protein" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_carbohydrate" class="form-label">碳水化合物(每100g)</label>
                                                    <input type="text" class="form-control" id="fnl_carbohydrate" name="fnl_carbohydrate" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_sodium" class="form-label">鈉(每100g有多少mg)</label>
                                                    <input type="text" class="form-control" id="fnl_sodium" name="fnl_sodium" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_Potassium" class="form-label">鉀(每100g有多少mg)</label>
                                                    <input type="text" class="form-control" id="fnl_Potassium" name="fnl_Potassium" required>
                                                    <div class="form-text"></div>
                                                </div>

                                                <div class="readd">
                                                    <label for="fnl_iron" class="form-label">鐵(每100g有多少mg)</label>
                                                    <input type="text" class="form-control" id="fnl_iron" name="fnl_iron" required>
                                                    <div class="form-text"></div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">新增</button>

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

                fetch('food_add-api.php', {
                        method: 'POST',
                        body: fd
                    }).then(r => r.json())
                    .then(obj => {
                        console.log(obj);
                        if (obj.success) {
                            alert('新增成功');
                            // location.href = 'ab-list.php';
                        } else {
                            alert('新增失敗');
                        }
                    })
            }
        }
    </script>
    <?php include __DIR__ . '/script.php'; ?>