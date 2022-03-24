<?php
$title = '新增食譜';
$pageName = 'recipes_add';
$systemName = "創意食譜系統";
$systemitem = "新增食譜";
?>

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
            <?php include __DIR__ . '/aside1.php'; ?></div>
        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- 麵包屑 -->
            <?php include __DIR__ . '/../parts/breadcrumb.php'; ?>
            <div class="row">
                <!-- 列表 -->
                <?php include __DIR__ . '/recipes_add_navar.php'; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">新增食譜</h5>
                                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

                                        <div class="readd">
                                            <label for="cr_name" class="form-label">料理名稱</label>
                                            <input type="text" class="form-control" id="cr_name" name="cr_name" required>
                                            <div class="form-text"></div>
                                        </div>

                                        <div class="readd">
                                            <label for="match_id" class="form-label">菜籃</label>
                                            <textarea class="form-control" id="match_id" name="match_id" cols="30" rows="3"></textarea>
                                            <div class="form-text"></div>
                                        </div>

                                        <div class="readd">
                                            <label for="photo_id" class="form-label">料理照片</label>
                                            <textarea class="form-control" id="photo_id" name="photo_id" cols="30" rows="3"></textarea>
                                            <div class="form-text"></div>
                                        </div>

                                        <div class="readd">
                                            <label for="cm_text" class="form-label">調理方法</label>
                                            <textarea class="form-control" id="cm_text" name="cm_text" cols="30" rows="3"></textarea>
                                            <div class="form-text"></div>
                                        </div>

                                        <div class="readd">
                                            <label for="member_id" class="form-label">會員系統ID</label>
                                            <textarea class="form-control" id="member_id" name="member_id" cols="30" rows="3"></textarea>
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

                    fetch('recipes-add-api.php', {
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