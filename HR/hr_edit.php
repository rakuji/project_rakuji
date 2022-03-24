<?php
require __DIR__ . '../../parts/connect_db.php';

$title = '修改員工資料';
$pageName = 'hr_edit';

$employee_id = isset($_GET['employee_id']) ? intval($_GET['employee_id']) : 0;

$sql = "SELECT * FROM employees WHERE employee_id=$employee_id";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: hr_list.php'); // 找不到資炓轉向列表頁
    exit;
}
?>
<?php include __DIR__ . '../../parts/html-head.php'; ?>

<?php include __DIR__ . '../../parts/banner.php'; ?>


<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include __DIR__ . '../../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <h2>首頁</h2>
            <style>
                form .mb-3 .form-text {
                    color: red;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">修改員工資料</h5>
                                <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                                    <input type="hidden" name="employee_id" value="<?= $row['employee_id'] ?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">* 姓名</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="<?= htmlentities($row['name']) ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlentities($row['email']) ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">手機</label>
                                        <input type="tel" class="form-control" id="mobile" name="phone_number" value="<?= htmlentities($row['phone_number']) ?>" pattern="09\d{2}-?\d{3}-?\d{3}">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hire_date" class="form-label">到職日</label>
                                        <input type="date" class="form-control" id="hire_date" name="hire_date" value="<?= $row['hire_date'] ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div>
                                        <label for="hire_date" class="form-label">職稱</label>
                                        <select class="form-select" aria-label="Default select example" name="job_id">
                                            <option selected>/選擇職稱/</option>
                                            <option value="1" <?= $row['job_id'] == "1" ? "selected" : ""?>>外場人員</option>
                                            <option value="2" <?= $row['job_id'] == "2" ? "selected" : ""?>>內場人員</option>
                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="job_id" class="form-label">職稱</label>
                                        <input type="text" class="form-control" id="job_id" name="job_id" value="<?= $row['job_id'] ?>">
                                        <div class="form-text"></div>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">薪資</label>
                                        <input type="number" class="form-control" id="salary" name="salary" value="<?= $row['salary'] ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div>
                                        <label for="hire_date" class="form-label">部門</label>
                                        <select class="form-select" aria-label="Default select example" name="department_id">
                                            <option selected>/選擇部門/</option>
                                            <option value="1" <?= $row['department_id'] == "1" ? "selected" : ""?>>外場</option> 
                                            <option value="2" <?= $row['department_id'] == "2" ? "selected" : ""?>>內場</option>
                                            <option value="3" <?= $row['department_id'] == "3" ? "selected" : ""?>>管理</option>
                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="department_id" class="form-label">部門代號</label>
                                        <input type="text" class="form-control" id="department_id" name="department_id" value="<?= $row['department_id'] ?>">
                                        <div class="form-text"></div>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="birthday" class="form-label">生日</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['birthday'] ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label">年齡</label>
                                        <input type="number" class="form-control" id="age" name="age" value="<?= $row['age'] ?>">
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="education" class="form-label">教育程度</label>
                                        <input type="text" class="form-control" id="education" name="education" value="<?= $row['education'] ?>">
                                        <div class="form-text"></div>
                                    </div>
                                   
                                    <div class="mb-3">
                                        <label for="address" class="form-label">通訊地址</label>
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="3"><?= $row['address'] ?></textarea>
                                        <div class="form-text"></div>
                                    </div>




                                    <button type="submit" class="btn btn-primary">修改</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>





            </div>

            <script>
                // const mobile = document.form1.mobile; // DOM element
                // const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

                // const name = document.form1.name;
                // const name_msg = name.closest('.mb-3').querySelector('.form-text');

                function checkForm() {
                    let isPass = true; // 有沒有通過檢查

                    // name_msg.innerText = '';  // 清空訊息
                    // mobile_msg.innerText = '';  // 清空訊息

                    // // TODO: 表單資料送出之前, 要做格式檢查

                    // if(name.value.length<2){
                    //     isPass = false;
                    //     name_msg.innerText = '請填寫正確的姓名'
                    // }

                    // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;new RegExp()
                    // if(mobile.value){
                    //     // 如果不是空字串就檢查格式
                    //     if(! mobile_re.test(mobile.value)){
                    //         mobile_msg.innerText = '請輸入正確的手機號碼';
                    //         isPass = false;
                    //     }
                    // }

                    if (isPass) {
                        const fd = new FormData(document.form1);

                        fetch('hr_edit-api.php', {
                                method: 'POST',
                                body: fd
                            }).then(r => r.json())
                            .then(text => {
                                console.log(text);
                                if (text.success) {
                                    alert('修改成功');
                                    location.href = 'hr_list.php';
                                } else {
                                    alert('修改失敗');
                                }

                            })


                    }


                }
            </script>
        </div>

    </div>
</div>



<?php include __DIR__ . '../../parts/script.php'; ?>

<?php include __DIR__ . '../../parts/html-foot.php'; ?>