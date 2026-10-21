<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm align-middle">
        <div class="container px-3">
            <a class="navbar-brand" href="<?= site_url() ?>">
                <img src="/uploads/images/logo.png" alt="" style="width: 30px; height: auto;">
                <?= BASE_NAME ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (session()->has('userid')) : ?>
                    <!-- User is logged in -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= site_url('keys') ?>">Keys Generated</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= site_url('keys/generate') ?>">Generate Keys</a>
                        </li>
                    </ul>
                    <div class="float-right">
                        <button class="btn btn-outline-light" id="sideMenuToggle">
                            <i class="bi bi-person-circle"></i> <?= getName($user) ?>
                        </button>
                    </div>
                <?php else : ?>
                    <!-- User is not logged in -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= site_url('login') ?>"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= site_url('register') ?>"></a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<?php if (session()->has('userid')) : ?>
    <!-- Side Menu for logged in users -->
    <div id="sideMenu" class="side-menu">
        <div class="side-menu-header">
            <h5 class="text-white"><?= getName($user) ?></h5>
            <button class="btn-close btn-close-white" id="sideMenuClose" aria-label="Close"></button>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= site_url('settings') ?>">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
            <?php if($user->username == 'Icycubes') : ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('ManageShortenerLinks') ?>">
                        USERS PROFILE
                    </a>
                </li>
            <?php endif; ?>
            <?php if (($user->level == 1) || ($user->level ==2)) : ?>
                <li class="nav-item text-muted"></li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('Server') ?>">
                        <i class="bi-controller"></i> Online System
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('lib') ?>">
                        <i class="bi bi-cloud-upload"></i> Online LIB
                    </a>
                </li>
            <?php endif; ?>
            <?php if($user->level == 1) : ?>
            
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('PrivateDashboard') ?>">
                        <i class="bi bi-person-check"></i> Private Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('admin/manage-users') ?>">
                        <i class="bi bi-person-check"></i> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('admin/create-referral') ?>">
                        <i class="bi bi-person-plus"></i> Create Referral
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="https://t.me/icy_cracks">
                    <i class="bi bi-telegram"></i> Panel Developer
                </a>
            </li>
             <li class="nav-item">
                    <a class="nav-link text-white" href="<?= site_url('ManageHackingAttempt') ?>">
                        <i class="bi bi-person-check"></i> Chat Room
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= site_url('logout') ?>">
                    <i class="bi bi-box-arrow-in-left"></i> Logout
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>

<style>
    .side-menu {
        position: fixed;
        top: 0;
        right: -250px;
        width: 250px;
        height: 100%;
        background-color: #343a40;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        z-index: 1050;
    }

    .side-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        border-bottom: 1px solid #495057;
    }

    .side-menu .nav-link {
        padding: 10px 20px;
        font-size: 16px;
    }
</style>

<script>
    document.getElementById("sideMenuToggle").addEventListener("click", function() {
        document.getElementById("sideMenu").style.right = "0";
    });

    document.getElementById("sideMenuClose").addEventListener("click", function() {
        document.getElementById("sideMenu").style.right = "-250px";
    });
</script>
