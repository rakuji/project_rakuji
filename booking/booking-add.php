<?php
$title = '新增訂位';
$systemName = '訂位管理系統';
$systemitem = '新增訂位';
$pageName = 'booking-add';
?>

<?php include '../parts/html-head.php'; ?>

<?php include '../parts/banner.php'; ?>



<style>
    #booking_date {
        position: relative;
    }

    #booking_date::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 0;
        padding-left: calc(100% - 40px);
        padding-right: 10px;
    }

    form {
        width: 50%;
    }

    h2 {
        color: peru;
    }

    .card{
        background-color:floralwhite ;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <!-- 左側選單欄 -->
        <div class="col-12 col-md-2">
            <?php include '../parts/aside.php'; ?>
        </div>


        <div class="col-12 col-md-10">

            <?php include '../parts/breadcrumb.php'; ?>

            <!-- 新增訂位區 -->

            <div class="card">
                <div class="card-body">
                    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">

                        <h2 class="card-title mb-4">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>新增訂位</span>
                        </h2>

                        <div class="mb-3">
                            <label for="member_id" class="form-label">會員編號</label>
                            <input type="number" class="form-control" id="member_id" name="member_id" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="booking_date" class="form-label">用餐日期</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="people_adult" class="form-label">人數(大人)</label>

                            <select class="form-select" aria-label="Default select example" id="people_adult" name="people_adult" required>
                                <option selected>請選擇人數</option>
                                <option value="1">1位大人</option>
                                <option value="2">2位大人</option>
                                <option value="3">3位大人</option>
                                <option value="4">4位大人</option>
                                <option value="5">5位大人</option>
                                <option value="6">6位大人</option>
                                <option value="7">7位大人</option>
                                <option value="8">8位大人</option>
                                <option value="9">9位大人</option>
                                <option value="10">10位大人</option>
                            </select>


                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="people_kid" class="form-label">人數(小孩)</label>

                            <select class="form-select" aria-label="Default select example" id="people_kid" name="people_kid" required>
                                <option selected>請選擇人數</option>
                                <option value="0">0位小孩</option>
                                <option value="1">1位小孩</option>
                                <option value="2">2位小孩</option>
                                <option value="3">3位小孩</option>
                                <option value="4">4位小孩</option>
                                <option value="5">5位小孩</option>
                                <option value="6">6位小孩</option>
                                <option value="7">7位小孩</option>
                                <option value="8">8位小孩</option>
                                <option value="9">9位小孩</option>
                                <option value="10">10位小孩</option>
                            </select>

                            <div class="form-text"></div>
                        </div>


                        <div class="mb-3">
                            <label for="meal_time" class="form-label">用餐時段</label>
                            <select class="form-select" aria-label="Default select example" id="meal_time" name="meal_time" require>
                                <option value="中午">中午</option>
                                <option value="晚上">晚上</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="booking_time" class="form-label">用餐時間</label>
                            <select class="form-select" aria-label="Default select example" id="booking_time" name="booking_time" require>
                                <!-- 中午時段用餐時間 -->
                                <option class="booking_time_noon select_default_noon" value="10:30">10:30</option>
                                <option class="booking_time_noon" value="11:00">11:00</option>
                                <option class="booking_time_noon" value="11:30">11:30</option>
                                <option class="booking_time_noon" value="12:00">12:00</option>
                                <option class="booking_time_noon" value="12:30">12:30</option>
                                <option class="booking_time_noon" value="13:00">13:00</option>
                                <option class="booking_time_noon" value="13:30">13:30</option>
                                <option class="booking_time_noon" value="14:00">14:00</option>

                                <!-- 晚上時段用餐時間 -->
                                <option class="booking_time_night select_default_night" value="16:30">16:30</option>
                                <option class="booking_time_night" value="17:00">17:00</option>
                                <option class="booking_time_night" value="17:30">17:30</option>
                                <option class="booking_time_night" value="18:00">18:00</option>
                                <option class="booking_time_night" value="18:30">18:30</option>
                                <option class="booking_time_night" value="19:00">19:00</option>
                                <option class="booking_time_night" value="19:30">19:30</option>
                                <option class="booking_time_night" value="20:00">20:00</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="statue" class="form-label">備註</label>
                            <textarea class="form-control" name="statue" id="statue" cols="30" rows="3"></textarea>
                            <div class="form-text"></div>
                        </div>


                        <button type="submit" class="btn btn-outline-danger">新增</button>
                        <a class="btn btn-outline-danger" href="booking-list.php">取消</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>



<?php include '../parts/script.php'; ?>
<script>
    // const mobile = document.form1.mobile; // DOM element
    // const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

    // const name = document.form1.name; // DOM element
    // const name_msg = name.closest('.mb-3').querySelector('.form-text');


    function checkForm() {
        let isPass = true; // 有沒有通過檢查

        // name_msg.innerText = ''; // 清空資訊
        // mobile_msg.innerText = ''; // 清空資訊


        // TODO: 表單資料送出之前，要做格式檢查
        // if (name.value.length < 2) {
        //     isPass = false;
        //     name_msg.innerText = '請填寫正確的姓名';

        // }

        // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()

        // if (mobile.value) {
        //     // 如果不是空字串就檢查格式
        //     if (!mobile_re.test(mobile.value)) {
        //         mobile_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('booking-add-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('新增成功');
                        location.href = 'booking-list.php';
                    } else {
                        alert('新增失敗');
                    }
                })
        }
    }


    $(document).ready(function() {


        $(".booking_time_night").hide();

        $("#meal_time").change(function() {
            var val = $(this).val();
            if (val == "中午") {

                $(".select_default_noon").attr('selected', 'selected');
                $(".select_default_night").removeAttr('selected', 'selected');

                $(".booking_time_noon").show("default");
                $(".booking_time_night").hide("default");
            } else {

                $(".select_default_night").attr('selected', 'selected');
                $(".select_default_noon").removeAttr('selected', 'selected');

                $(".booking_time_noon").hide("default");
                $(".booking_time_night").show("default");
            }

        })
    })
</script>
<?php include '../parts/html-foot.php'; ?>