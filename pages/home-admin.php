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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
    </nav>

    <!-- Body Content -->
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Pengajuan Survey</h4>
        </div>
        <hr>

        <!-- Menampilkan data dalam bentuk tabel -->
        <table id="tabelDaftarKuisioner" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID Survey</th>
                    <th>ID Owner</th>
                    <th>Nama Survey</th>
                    <th>Keterangan</th>
                    <th>Jumlah Responden</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM survey WHERE jenis = 'private'";
                    $result = mysqli_query($conn, $query);

                    while ($survey = mysqli_fetch_assoc($result)) {
                        $bayar = FALSE;
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
                                    $bayar = TRUE;
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
                        <td><?= $survey['id_survey'] ?></td>
                        <td><?= $survey['id_owner'] ?></td>
                        <td><?= $survey['nama_survey'] ?></td>
                        <td><?= $survey['keterangan'] ?></td>
                        <td><?= $survey['jumlah_responden'] ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <?php if (!dataExist($survey['id_survey'], 'id_survey', 'respon') && $bayar) { ?>
                                <form action="index.php?page=import-survey-admin" method="post">
                                    <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                    <button type="submit" name="import-survey" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-cloud-upload"></i>
                                    </button>
                                </form>
                            <?php } ?>
                            <form action="index.php?page=detail-survey-admin" method="post">
                                <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                <button type="submit" name="detail-survey" class="btn btn-primary"  style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </form>
                            <a href="pages/report.php?id=<?= $survey['id_survey'] ?>" type="submit" target="_blank" class="btn btn-success"  style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>
    </div>
</div>
</section>