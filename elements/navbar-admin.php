<?php 
    if ($_SESSION['role'] !== 'admin') {
        header('Location: index.php?page=login-admin');
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark p-3 shadow fixed-top" style="background-image: linear-gradient(to right, #3d0fd6, darkblue);">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-warning fw-bold">GrowSurvey</span> - Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="index.php?page=home-admin">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php?page=survey-admin">Survey</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-light" href="index.php?page=riwayat-pembayaran-admin">Riwayat Pembayaran</i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['username'] ?>
                    </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="process/logout_proses.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>