<?php
    // if(!isAuthenticated() || !isset($_POST['id_survey'])) header("Location: index.php?page=login-admin")
    include('../functions.php');
?>
<section id="detail-survey" style="margin-top:90px">
<div class="container">

    <!-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=survey-admin">Survey</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
    </nav> -->

    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Detail Survey</h4>
        </div>
        <hr>
        
        <form action="../process/survey_proses.php" method="post">
            <input type="hidden" name="id_survey" value="<?= $_GET['id'] ?>">
            <?php
                $id_survey = $_GET['id'];
                $query = "SELECT * FROM kuisioner WHERE id_survey = '$id_survey'";
                $result = mysqli_query($conn, $query);

                $i = 0;
                while($kuisioner = mysqli_fetch_assoc($result)) {
            ?>
            <div class="mb-3">
                <input type="hidden" name="id_kuisioner[]" value="<?= $kuisioner['id_kuisioner'] ?>">
                <label for="respon<?= $i ?>" class="form-label"><?= $kuisioner['pertanyaan'] ?></label>
                <input type="text" class="form-control" id="respon<?= $i ?>" name="respon[]">
            </div>
            <?php 
                    $i++;
                } 
            ?>

            <button type="submit" class="btn btn-primary float-end" id="next-tambah-survey" name="tambah-respon">Tambah Data</button>
        </form>
    </div>
    </form>
</div>
</section> 