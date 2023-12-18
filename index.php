<?php
    include('functions.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GrowSurvey</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
        <!-- Datatable CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        
        <!-- My CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <?php
            if(isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'login':
                        include('elements/navbar-landing.php');
                        include('pages/login.php');
                        break;
                    case 'registrasi':
                        include('elements/navbar-landing.php');
                        include('pages/registrasi.php');
                        break;
                    case 'login-admin':
                        include('pages/login-admin.php');
                        break;
                    case 'home-admin':
                        include('elements/navbar-admin.php');
                        include('pages/home-admin.php');
                        break;
                    case 'survey-admin':
                        include('elements/navbar-admin.php');
                        include('pages/survey-admin.php');
                        break;
                    case 'tambah-survey-admin':
                        include('elements/navbar-admin.php');
                        include('pages/tambah-survey.php');
                        break;
                    case 'import-survey-admin':
                        include('elements/navbar-admin.php');
                        include('pages/import-survey.php');
                        break;
                    case 'tambah-pertanyaan-admin':
                        include('elements/navbar-admin.php');
                        include('pages/tambah-pertanyaan.php');
                        break;
                    case 'detail-survey-admin':
                        include('elements/navbar-admin.php');
                        include('pages/detail-survey.php');
                        break;
                    case 'riwayat-pembayaran-admin':
                        include('elements/navbar-admin.php');
                        include('pages/riwayat-pembayaran.php');
                        break;
                    case 'home':
                        include('elements/navbar.php');
                        include('pages/home.php');
                        break;
                    case 'survey':
                        include('elements/navbar.php');
                        include('pages/survey.php');
                        break;
                    case 'tambah-survey':
                        include('elements/navbar.php');
                        include('pages/tambah-survey.php');
                        break;
                    case 'tambah-pertanyaan':
                        include('elements/navbar.php');
                        include('pages/tambah-pertanyaan.php');
                        break;
                    case 'detail-survey':
                        include('elements/navbar.php');
                        include('pages/detail-survey.php');
                        break;
                    case 'pembayaran':
                        include('elements/navbar.php');
                        include('pages/pembayaran.php');
                        break;
                    case 'riwayat-pembayaran':
                        include('elements/navbar.php');
                        include('pages/riwayat-pembayaran.php');
                        break;
                    
                    default:    
                        include('elements/navbar.php');
                        include('pages/home.php');
                        break;
                }
            } else {
                include('elements/navbar-landing.php');
                include('pages/landing.php');
            }
        ?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>