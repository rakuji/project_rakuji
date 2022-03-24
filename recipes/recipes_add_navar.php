<style>
    .navbar-light .navbar-nav .nav-link.active {
        background-color: #00f;
        color: white;
        border-radius: 5px;
        font-weight: 800;
    }
</style>
<div class="container ">
    <div class="col-lg-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light col-lg-6">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'ab-add' ? 'active' : '' ?>" href="recipes_add.php">新增食譜</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'ab-add' ? 'active' : '' ?>" href="food_add.php">新增食材</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>

</div>