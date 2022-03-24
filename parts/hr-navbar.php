<style>
    .navbar-light .navbar-nav .nav-link.active {
        background-color: #6969fc;
        color: white;
        border-radius: 5px;
        font-weight: 800;

    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'home' ? 'active' : '' ?>" aria-current="page" href="../index/index_.php">首頁</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'Hr-list' ? 'active' : '' ?>" href="hr_list.php">員工列表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'Hr-add' ? 'active' : '' ?>" href="hr_add.php">新增員工資料</a>
                    </li>
                </ul>

            </div>
            <div class="row">
                    <div class="col">
                        <div class="d-flex flex-row-reverse">
                            <form class="d-flex mb-3" method="$_GET" action="hr_list.php">
                                <input class="form-control me-2" name="hr" type="text" placeholder="search" aria-label="Search" required>
                                <button class="btn btn-primary search" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
    </nav>
</div>