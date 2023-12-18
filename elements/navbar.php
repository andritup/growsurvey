<?php 
    if ($_SESSION['role'] !== 'owner') {
        header('Location: index.php?page=login');
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark p-3 shadow fixed-top" style="background-image: linear-gradient(to right, #3d0fd6, darkblue);">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-warning fw-bold">GrowSurvey</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" aria-current="page" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php?page=survey">Survey <i class="bi bi-bookmark-star-fill text-warning"></i></a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link text-light" href="index.php?page=riwayat-pembayaran">Riwayat Pembayaran</i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['email'] ?>
                    </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="process/logout_proses.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>