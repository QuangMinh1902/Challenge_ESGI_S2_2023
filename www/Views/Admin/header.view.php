<!-- <?php //session_start(); ?> -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a href="/" class="b-brand" target="_blank">
            <img src="assets/images/logo.png" alt="" class="logo">
        </a>
      
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-notification">
                        <div class="pro-head">
                            <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                            <span><?php echo $_SESSION["user"]['email']; ?> (<?php echo $_SESSION["user"]['role']; ?>)</span>
                            <a href="auth-signin.html" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="/admin/user/update?id=<?php echo $_SESSION["user"]['id']; ?>" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="/logout" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>