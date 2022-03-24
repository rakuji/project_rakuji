<?php
$systemName = '活動管理系統';
$systemitem = '最新消息';
?>
<?php include __DIR__ . '/breadcrumb.php'; ?>

<style>
    .navbar-light .navbar-nav .nav-link.active {
        background-color: #0d6efd;
        color: white;
        border-radius: 5px;
        font-weight: 800;

    }
</style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="">最新消息</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='news-list' ? 'active' : '' ?>" href="news-list.php">列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName=='news-add' ? 'active' : '' ?>" href="news-add.php">新增</a>
                    </li>

                </ul>

        </div>
    </nav>
