<?php
    if(!isAuthenticated()) header("Location: index.php?page=login")
?>
<section id="home" style="margin-top:90px">
<div class="container">

    <!-- Alert -->
    <?php if (isset($_SESSION['msg'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['msg']['value'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['msg']) ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Survey</li>
        </ol>
    </nav>

    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Daftar Survey</h4>
            <span><a href="index.php?page=tambah-survey" class="btn btn-primary btn-sm">Buat Survey</a></span>
        </div>
        <hr>
        <div class="card mb-3">
            <div class="card-header">
                Survey Private
            </div>
            <div class="card-body">
                <table id="tabelDaftarKuisioner" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Survey</th>
                            <th>Keterangan</th>
                            <th>Jumlah Responden</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id_owner = $_SESSION['user'];
                            $query = "SELECT * FROM survey WHERE id_owner = '$id_owner' ORDER BY id_survey DESC";
                            $result = mysqli_query($conn, $query);

                            $bayar = 0;
                            while ($survey = mysqli_fetch_assoc($result)) {
                                $jumlah_pertanyaan = dataExist($survey['id_survey'], 'id_survey', 'kuisioner');
                                if ($jumlah_pertanyaan <= 0) {
                                    $status = '<span class="badge text-bg-warning">belum ada pertanyaan</span>';
                                } else {
                                    $id_survey = $survey['id_survey'];
                                    $id_owner = $_SESSION['user'];
                                    $query_bayar = "SELECT status FROM bayar WHERE id_survey = '$id_survey'";
                                    $result_bayar = mysqli_query($conn, $query_bayar);    
                                    if(mysqli_num_rows($result_bayar) > 0) {
                                        $status_bayar = mysqli_fetch_assoc($result_bayar);
                                        if($status_bayar['status'] === "belum diverifikasi") {
                                            $status = '<span class="badge text-bg-warning">belum diverifikasi</span>';
                                        } else {
                                            $bayar = 1;
                                            $jumlah_jawaban = dataExist($survey['id_survey'], 'id_survey', 'respon');
                                            if ($jumlah_jawaban <= 0) {
                                                $status = '<span class="badge text-bg-success">process</span>';
                                            } else {
                                                $status = '<span class="badge text-bg-primary">Selesai</span>';
                                            }
                                        }
                                    } else {
                                        $status = '<span class="badge text-bg-danger">belum ada pembayaran</span>';
                                    }
                                }
                        ?>
                            <tr>
                                <td><?= $survey['nama_survey'] ?></td>
                                <td><?= $survey['keterangan'] ?></td>
                                <td><?= countResponden($survey['id_survey'])."/".$survey['jumlah_responden'] ?></td>
                                <td><?= $status ?></td>
                                <td>
                                    <?php if ($jumlah_pertanyaan <= 0) { ?>
                                        <form action="index.php?page=tambah-pertanyaan" method="post">
                                            <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                            <button type="submit" name="tambah-pertanyaan" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                                <i class="bi bi-plus-square"></i>
                                            </button>
                                        </form>
                                    <?php } else { ?>
                                        <?php if ($bayar == 1) { ?>
                                            <form action="index.php?page=detail-survey" method="post">
                                                <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" name="detail-survey" class="btn btn-primary" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </form>
                                            <a href="pages/report.php?id=<?= $survey['id_survey'] ?>" type="submit" target="_blank" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        <?php } else { ?>
                                            <form action="index.php?page=pembayaran" method="post">
                                                <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                                <button type="submit" class="btn btn-primary" name="pembayaran" class="btn btn-primary" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                                    <i class="bi bi-credit-card-2-back"></i>
                                                </button>
                                            </form>
                                        <?php }?>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div> 

        <div class="card mb-3">
            <div class="card-header">
                Survey Public
            </div>
            <div class="card-body">
                <table id="tabelDaftarKuisioner" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Survey</th>
                            <th>Keterangan</th>
                            <th>Jumlah Responden</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id_owner = $_SESSION['user'];
                            $query = "SELECT survey.*, bayar.jumlah_bayar FROM survey INNER JOIN bayar ON bayar.id_survey = survey.id_survey WHERE bayar.status = 'selesai' AND bayar.id_owner = '$id_owner' AND survey.jenis = 'public'" ;
                            $result = mysqli_query($conn, $query);

                            while ($survey = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $survey['nama_survey'] ?></td>
                                <td><?= $survey['keterangan'] ?></td>
                                <td><?= $survey['jumlah_responden'] ?></td>
                                <td>
                                    <form action="index.php?page=detail-survey" method="post">
                                        <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" name="detail-survey" class="btn btn-primary" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;"><i class="bi bi-eye"></i></button>
                                    </form>
                                    <a href="pages/report.php?id=<?= $survey['id_survey'] ?>" type="submit" target="_blank" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>