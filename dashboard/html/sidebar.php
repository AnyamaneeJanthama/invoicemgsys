<?php
// Assuming $currentPage holds the name of the current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Dashboard</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-light fa-file-invoice"></i>
                <div data-i18n="Authentications">Invoices</div>
            </a>
            <!-- <ul class="menu-sub">
                <li class="menu-item">
                    <a href="sale.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Add User</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="magUsers.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Manage Users</div>
                    </a>
                </li>
            </ul> -->
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-light fa-box-taped"></i>
                <div data-i18n="Authentications">Products</div>
            </a>
            <!-- <ul class="menu-sub">
                <li class="menu-item">
                    <a href="sale.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Add User</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="magUsers.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Manage Users</div>
                    </a>
                </li>
            </ul> -->
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-light fa-users"></i>
                <div data-i18n="Authentications">Customers</div>
            </a>
            <!-- <ul class="menu-sub">
                <li class="menu-item">
                    <a href="sale.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Add User</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="magUsers.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Basic">Manage Users</div>
                    </a>
                </li>
            </ul> -->
        </li>

        <li class="menu-item <?php echo ($currentPage == 'magUsers.php' || $currentPage == 'frm_user.php') ? "active" : ""; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-light fa-user"></i>
                <div data-i18n="Authentications">System Users</div>
            </a>
            <ul class="menu-sub <?php echo ($currentPage == 'frm_user.php') ? "active-sub" : ""; ?>">
                <li class="menu-item <?php echo ($currentPage == 'magUsers.php' || $currentPage == 'frm_user.php') ? "active-sub" : ""; ?>">
                    <a href="magUsers.php" class="menu-link">
                        <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
                        <i class="menu-icon fa-regular fa-gear"></i>
                        <div data-i18n="Basic">Manage Users</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>