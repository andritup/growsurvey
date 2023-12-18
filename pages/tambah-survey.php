<?php
    if(!isAuthenticated()) header("Location: index.php?page=login-admin")
?>
<section id="tambah-survey" style="margin-top:90px">
<div class="container">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=survey-admin">Survey</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
    </nav>

    <form action="process/survey_proses.php" method="post">
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Tambah Survey</h4>
        </div>
        <hr>
        <?php if ($_SESSION['role'] !== "admin") { ?>
            <div class="alert alert-primary" role="alert">
                <h5 class="text-center card-title text-muted">Tentukan ukuran sampel yang sesuai dengan kebutuhan Anda! Pilih jumlah responden yang ingin Anda peroleh, dan temukan penawaran harga eksklusif untuk setiap kategori jumlah responden.</h5>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">50 Responden</div>
                        <div class="card-body">
                            <h5 class="card-title">IDR 150.000</h5>
                            <p class="card-text">Max 20 pertanyaan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">100 Responden</div>
                        <div class="card-body">
                            <h5 class="card-title">IDR 225.000</h5>
                            <p class="card-text">Max 20 pertanyaan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">200 Responden</div>
                        <div class="card-body">
                            <h5 class="card-title">IDR 300.000</h5>
                            <p class="card-text">Max 20 pertanyaan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">500 Responden</div>
                        <div class="card-body">
                            <h5 class="card-title">IDR 400.000</h5>
                            <p class="card-text">Max 20 pertanyaan</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>
        <div id="form-survey">
            <div class="mb-3">
                <label for="nama_survey" class="form-label">Judul Survey</label>
                <input type="text" class="form-control" id="nama_survey" name="nama_survey">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
            </div>
            <div class="mb-3">
                <label for="jumlah_responden" class="form-label">Jumlah Responden</label>
                <select class="form-select" id="jumlah_responden" name="jumlah_responden">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
            </div>

            <!-- Button next -->
            <button type="submit" class="btn btn-primary float-end" id="next-tambah-survey" name="tambah-survey">Tambah Data</button>
        </div>
    </div>
    </form>
</div>
</section>