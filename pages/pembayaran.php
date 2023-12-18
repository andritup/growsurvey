<?php
    if(!isAuthenticated() || !isset($_POST)) header("Location: index.php?page=login");
?>
<section id="pembelian" style="margin-top:90px">
<div class="container mb-5">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php if (isset($_POST['pembelian'])) { ?>
            <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembelian</li>
        <?php } else { ?>
            <li class="breadcrumb-item"><a href="index.php?page=survey">Survey</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
        <?php } ?>
    </ol>
    </nav>

    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Pembayaran</h4>
        </div>
        <hr>
        <div class="card mb-2">
            <div class="card-header text-center">
                Detail Pembayaran
            </div>
            <div class="card-body">
            <?php
                $id_survey = $_POST['id_survey'];
                $query = "SELECT * FROM survey WHERE id_survey = '$id_survey'";
                $result = mysqli_query($conn, $query);
                $survey = mysqli_fetch_assoc($result);

                $jumlah_responden = $survey['jumlah_responden'];
                $query_harga = "SELECT harga FROM harga WHERE jumlah_responden = '$jumlah_responden'";
                $result_harga = mysqli_query($conn, $query_harga);
                $harga = mysqli_fetch_assoc($result_harga);

                // Penambahan PPn untuk harga >= IDR 300.000
                $ppn = 10;
                if ($harga['harga'] >= 300000) {
                    $ppn = 11;
                }
                
                $harga_tambah = $harga['harga'] * ($ppn/100);
                $new_harga = $harga['harga'] + $harga_tambah;

            ?>
    
                <p class="mb-0">Judul Survey </p>
                <p class="text-muted mt-0"><?= $survey['nama_survey'] ?></p>
                <p class="mb-0">Jumlah Responden</p>
                <p class="text-muted mt-0"><?= $survey['jumlah_responden'] ?></p>
                <p class="mb-0">Harga</p>
                <p class="fw-bold mt-0 mb-1">IDR <?= number_format($harga['harga'], 0, ',', '.') ?></p>
                <p class="text-lighter mt-0" style="font-size: 13px">PPn <?= $ppn; ?>%</p>
                <p class="text-muted mb-0">Harga + PPn</p>
                <p class="fw-bold fs-3 mt-0 text-primary">IDR <?= number_format($new_harga, 0, ',', '.') ?></p>
                

            </div>    
        </div>
        <div class="card text-center mb-2">
            
            <div class="card-header">
                Pilih salah satu metode pembayaran!
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="assets/img/MANDIRI.webp" alt="MANDIRI" class="img-thumbnail w-50 mb-3">
                        <p class="text-muted mb-0">No. Rekening 19202XXXXXXXX</p>
                        <p class="text-muted mt-0">a.n growsurvey</p>
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/img/BNI.png" alt="BNI" class="img-thumbnail w-50 mb-3">
                        <p class="text-muted mb-0">No. Rekening 19202XXXXXXXX</p>
                        <p class="text-muted mt-0">a.n growsurvey</p>
                    </div>
                    <div class="col-sm-4">
                        <img src="assets/img/BCA.webp" alt="BCA" class="img-thumbnail w-50 mb-3">
                        <p class="text-muted mb-0">No. Rekening 19202XXXXXXXX</p>
                        <p class="text-muted mt-0">a.n growsurvey</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-body-secondary">
                Setelah melakukan transaksi, kirimkan foto bukti pembayaran pada form dibawah ini!
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
                Form Upload Bukti Pembayaran
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="process/pembayaran_proses.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_survey" value="<?= $id_survey ?>">
                            <input type="hidden" name="harga" value="<?= $new_harga ?>">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Foto</label>
                                <input class="form-control" type="file" id="formFile" name="gambar" required>
                            </div>
                            <?php if (isset($_POST['pembelian'])) { ?>
                                <button type="submit" class="btn btn-primary" name="pembelian">Kirim</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-primary" name="pembayaran">Kirim</button>
                            <?php } ?>
                            
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Perhatian!</h4>
                            <p>Terima kasih atas pembayaran yang Anda lakukan. Kami menghargai kerjasama Anda. Mohon bersabar sejenak, karena tim admin kami akan segera memverifikasi bukti pembayaran yang telah Anda unggah. Proses ini biasanya memakan waktu paling lama 1 hari kerja. Terima kasih atas pengertian dan kesabaran Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</section>