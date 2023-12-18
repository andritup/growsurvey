<?php
    if(!isAuthenticated() || !isset($_POST['id_survey'])) header("Location: index.php?page=login-admin")
?>
<section id="tambah-survey" style="margin-top:90px">
<div class="container">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php if ($_SESSION['role'] === "admin") { ?>
            <li class="breadcrumb-item"><a href="index.php?page=survey-admin">Survey</a></li>
        <?php } else { ?>
            <li class="breadcrumb-item"><a href="index.php?page=survey">Survey</a></li>
        <?php } ?>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
    </nav>

    <form action="process/survey_proses.php" method="post">
    <input type="hidden" name="id_survey" value="<?= $_POST['id_survey'] ?>">
    <div class="card p-4 mb-3">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Tambah Survey</h4>
        </div>
        <hr>
        <div id="form-kuisioner">
            <div class="mb-3 card p-2">
                <label for="kuisioner" class="form-label">Pertanyaan 1</label>
                <input type="text" class="form-control" id="kuisioner" name="kuisioner[]" placeholder="Ketikkan pertanyaan disini...">
            </div>

            <!-- Pertanyaan Tambahan -->
            <div id="pertanyaan"></div>

            <span id="limit_res"></span>

            <!-- Button -->
            <div class="d-flex justify-content-between">
                <!-- Button Triger Tambah Pertanyaan -->
                <button type="button" id="sisip-pertanyaan" class="btn btn-sm btn-success">Sisipkan Kolom Pertanyaan</button>
                <button type="submit" class="btn btn-primary" name="tambah-pertanyaan">Kirim</button>
            </div>
        </div>
    </div>
    </form>
</div>
</section>