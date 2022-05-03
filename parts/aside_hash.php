<div class="list-group">

    <div class="">
        <a class="btn list-group-item list-group-item-action aside_btn <?= $pageName == 'inv_management' ? 'active' : '' ?>" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right arrow1"></i>Hash Test
        </a>
        <div class="collapse" id="collapseExample">
            <div class="card-body">
                <a href="#../hash/hash_test.php" class="list-group-item list-group-item-action <?= $pageName == 'pn_maintain' ? 'active' : '' ?>">Hash Test</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>活動管理系統
        </a>
        <div class="collapse" id="collapseExample2">
            <div class="card-body">
                <a href="#" class="list-group-item list-group-item-action">最新消息</a>
                <a href="#" class="list-group-item list-group-item-action">特殊節日及壽星</a>
                <a href="#" class="list-group-item list-group-item-action">最佳餐點</a>
                <a href="#" class="list-group-item list-group-item-action">餐點投票結果</a>
                <a href="#" class="list-group-item list-group-item-action">副產品專區</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>創意食譜系統
        </a>
        <div class="collapse" id="collapseExample3">
            <div class="card-body">
                <a href="#" class="list-group-item list-group-item-action">食譜查詢</a>
                <a href="#" class="list-group-item list-group-item-action">新增食譜</a>
                <a href="#" class="list-group-item list-group-item-action">卡路里計算</a>
            </div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action" data-bs-toggle="collapse" href="#" role="button" aria-expanded="false" aria-controls="collapseExample">
            會員管理系統
        </a>
        <div class="collapse" id="collapseExample4">
            <div class="card card-body"></div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action">
            員工管理系統
        </a>
        <div class="collapse" id="collapseExample5">
            <div class="card card-body"></div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action">
            訂餐管理系統
        </a>
        <div class="collapse" id="collapseExample6">
            <div class="card card-body"></div>
        </div>
    </div>

    <div>
        <a class="btn list-group-item list-group-item-action aside_btn <?= ($pageName == 'order-list' or $pageName == 'ab-add') ? 'active' : '' ?>" data-bs-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-caret-right"></i>訂位管理系統
        </a>
        <div class="collapse" id="collapseExample7">
            <div class="card-body">
                <a href="order-list.php" class="list-group-item list-group-item-action <?= $pageName == 'order-list' ? 'active' : '' ?>">訂位查詢</a>
                <a href="ab-add.php" class="list-group-item list-group-item-action <?= $pageName == 'ab-add' ? 'active' : '' ?>">新增訂位</a>
            </div>
        </div>
    </div>

</div>
<script>
    const whenHashChange = function() {
        let h = location.hash.slice(1);
        console.log(h);
        if (h) {
            $.get(h, function(data) {
                $('#content').html(data);
            });
        }

    };
    // whenHashChange();
    window.addEventListener('hashchange', whenHashChange);
</script>