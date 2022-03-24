<?php include __DIR__ . '/../parts/connect_db.php'; ?>

<?php
$title = '品號維護';
include __DIR__ . '/../parts/html-head.php'; ?>

<?php include __DIR__ . '/../parts/banner.php'; ?>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php
            $pageName = '';
            include __DIR__ . '/../parts/aside.php'; ?>
        </div>

        <!-- 主要內容區 -->
        <div class="col-12 col-md-10">
            <!-- <h2>首頁</h2> -->
            <?php
            $systemName = '庫存管理系統';
            $systemitem = '品號維護';
            include __DIR__ . '/../parts/breadcrumb.php'; ?>

            <!-- 分頁的內容:開始 -->
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">新增品號資料</h5>
                                <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                                    <div class="mb-3">
                                        <label for="p_id" class="form-label">* 品號</label>
                                        <input type="text" class="form-control" name="p_id" required>
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_name" class="form-label">* 名稱</label>
                                        <input type="text" class="form-control" id="p_name" name="p_name" required >
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_desc" class="form-label">敘述</label>
                                        <textarea class="form-control" id="p_desc" name="p_desc" rows="3"></textarea>
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_price" class="form-label">單價</label>
                                        <input type="tel" class="form-control" id="p_price" name="p_price" >
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="p_cal" class="form-label">熱量</label>
                                        <input type="text" class="form-control" id="p_cal" name="p_cal" >
                                        <div class="form-text"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="period" class="form-label">供應時段</label>
                                        <select class="form-select" aria-label="Default select example" name="period" id="period">
                                            <option value="1" >不分時段</option>
                                            <option value="2" >午餐</option>
                                            <option value="3" >晚餐</option>
                                            <option value="4" >午晚餐</option>
                                        </select>
                                        <div class="form-text"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">新增</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- 分頁的內容:結束 -->
        </div>
    </div>
</div>

<?php include __DIR__ . '/../parts/script.php'; ?>
<script>
    const p_id = document.form1.p_id;
    const p_id_msg = p_id.closest('.mb-3').querySelector('.form-text');
    const p_name = document.form1.p_name;
    const p_name_msg = p_name.closest('.mb-3').querySelector('.form-text');
    const p_price = document.form1.p_price;
    const p_price_msg = p_price.closest('.mb-3').querySelector('.form-text');
    const p_cal = document.form1.p_cal;
    const p_cal_msg = p_cal.closest('.mb-3').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        p_id_msg.innerText = '';  // 清空訊息
        p_name_msg.innerText = '';  // 清空訊息
        p_price_msg.innerText = '';  // 清空訊息
        p_cal_msg.innerText = '';  // 清空訊息

        // TODO: 表單資料送出之前, 要做格式檢查

        if(p_id.value.length != 6){
            isPass = false;
            p_id_msg.innerText = '請填寫正確的6碼品號';
        }
        
        if(p_name.value.length<2){
            isPass = false;
            p_name_msg.innerText = '請填寫正確的品號名稱';
        }

        if(isNaN(p_price.value)){
            isPass = false;
            p_price_msg.innerText = '請填寫正確的單價整數值';
        }

        if(isNaN(p_cal.value)){
            isPass = false;
            p_cal_msg.innerText = '請填寫正確的熱量整數值';
        }
        // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()
        // if(mobile.value){
        //     // 如果不是空字串就檢查格式
        //     if(! mobile_re.test(mobile.value)){
        //         mobile_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('pn_add_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    location.href = 'pn_list.php?pn=' + document.form1.p_id.value;
                } else {
                    alert('新增失敗');
                }
            })
        }
    }
</script>

<?php include __DIR__ . '/../parts/html-foot.php'; ?>