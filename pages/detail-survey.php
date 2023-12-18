<?php
    if(!isAuthenticated() || !isset($_POST['id_survey'])) header("Location: index.php?page=login-admin");
?>
<section id="detail-survey" style="margin-top:90px">
<div class="container mb-5">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php if ($_SESSION['role'] === "admin") { ?>
            <li class="breadcrumb-item"><a href="index.php?page=survey-admin">Survey</a></li>
        <?php } else { ?>
            <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
        <?php } ?>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
    </nav>

    <!-- Body content -->
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Detail Survey</h4>
            
            <?php if ($_SESSION['role'] === "admin") { ?>
                <span><a href="index.php?page=home-admin" class="btn btn-sm btn-primary">Kembali</a></span>
            <?php } else { ?>
                <?php if(isset($_POST['status'])) { ?>
                    <span><a href="index.php?page=home" class="btn btn-sm btn-primary">Kembali</a></span>
                <?php } else { ?>
                    <form action="index.php?page=pembayaran" method="post">
                        <input type="hidden" name="id_survey" value="<?= $_POST['id_survey'] ?>">
                        <button type="submit" class="btn btn-primary" name="pembelian">Pembelian</button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
        <hr>
        
        <!-- Menampilkan detail dengan accordion -->
        <div class="accordion accordion-flush" id="accordionFlushExample">

            <?php
                $id_survey = $_POST['id_survey'];
                $query = "SELECT * FROM kuisioner WHERE id_survey = '$id_survey'";
                $result = mysqli_query($conn, $query);

                $i = 1;
                while ($pertanyaan = mysqli_fetch_assoc($result)) {
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i ?>" aria-expanded="false" aria-controls="flush-collapse<?= $i ?>">
                    <span class="fw-bold"><?= $pertanyaan['pertanyaan']; ?></span>
                </button>
                </h2>
                <div id="flush-collapse<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <?php 
                                $id_kuisioner = $pertanyaan['id_kuisioner'];
                                
                                $query_respon = "SELECT * FROM respon WHERE id_kuisioner = '$id_kuisioner' LIMIT 10";
                                if($_SESSION['role'] === "admin") {
                                    $query_respon = "SELECT * FROM respon WHERE id_kuisioner = '$id_kuisioner'";
                                } else if (isset($_POST['status'])) {
                                    $query_respon = "SELECT * FROM respon WHERE id_kuisioner = '$id_kuisioner'";
                                }
                                
                                $result_respon = mysqli_query($conn, $query_respon);
                
                                while ($respon = mysqli_fetch_assoc($result_respon)) {
                            ?>
                            <li class="list-group-item"><?= $respon['jawaban'] ?></li>
                            <?php 
                                } 
                                
                                if ($_SESSION['role'] !== "admin" and !isset($_POST['status'])) {
                                    echo '<li class="list-group-item" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Lihat semua ....</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php  
                    $i++;
                } 
            ?>
        </div>

    </div>
</div>
</section>

<!-- Modal pembelian -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header" style="background-image: linear-gradient(to right, #3d0fd6, darkblue);">
            <h1 class="modal-title fs-5 text-warning" id="staticBackdropLabel">GrowSurvey</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Dapatkan akses penuh ke semua responden dengan melakukan pembelian sekarang!. Jangan lewatkan kesempatan untuk mendapatkan informasi lengkap, karena hanya 10 responden teratas yang akan ditampilkan tanpa pembelian.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <form action="index.php?page=pembayaran" method="post">
                <input type="hidden" name="id_survey" value="<?= $id_survey ?>">
                <button type="submit" class="btn btn-primary" name="pembelian">Beli Sekarang</button>
            </form>
        </div>
        </div>
    </div>
</div>