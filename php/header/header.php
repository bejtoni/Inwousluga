<?php

$authenticated = $_SESSION["authenticated"] ?? false;

?>

<header class="header">
    <div class="logo-container">
        <a href="<?= $indexPath ?>">
            <img src="<?= $logoPath; ?>" alt="Inwobill logo" />
        </a>
    </div>

    <nav class="main-nav">
        <?php if ($authenticated): ?>
            <ul class="main-nav-list">
                <li>
                    <a href="<?= $addServicePath ?>">
                        <div class="nav-link-container">
                            <i class="fa-regular fa-square-plus icon"></i>
                            <span class="main-nav-link">Add Your Service</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= $likedServicePath ?>">
                        <div class="nav-link-container">
                            <i class="fa-regular fa-heart icon"></i>
                            <span class="main-nav-link">Liked Services</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= $collaborationsPath ?>">
                        <div class="nav-link-container">
                            <i class="fa-regular fa-handshake icon"></i>
                            <span class="main-nav-link">Collaborations</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= $profilePath ?>">
                        <div class="nav-link-container">
                            <i class="fa-regular fa-user icon"></i>
                            <span class="main-nav-link">Profile</span>
                        </div>
                    </a>
                </li>
            </ul>
        <?php endif; ?>

        <?php echo $authenticated ? '<a href="' . $logoutPath . '" class="button">Logout</a>' : '<a href="' . $loginPath . '" class="button">Login</a>'; ?>

    </nav>

    <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
    </button>
</header>