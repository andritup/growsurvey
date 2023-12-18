<?php
    if(!isAuthenticated()) header("Location: index.php?page=login-admin")
?>
<section id="survey-admin" style="margin-top:90px">
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
            <h4 style="color: darkblue">Survey - Public</h4>
            <span>
                <a href="index.php?page=tambah-survey-admin" class="btn btn-primary btn-sm">Buat Survey</a>
            </span>
        </div>
        <hr>
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

                    while ($survey = mysqli_fetch_assoc($result)) {
                        $jumlah_pertanyaan = dataExist($survey['id_survey'], 'id_survey', 'kuisioner');
                        if ($jumlah_pertanyaan <= 0) {
                            $status = '<span class="badge text-bg-warning">belum ada data</span>';
                        } else {
                            $status = '<span class="badge text-bg-success">process</span>';
                        }
                ?>
                    <tr>
                        <td><?= $survey['nama_survey'] ?></td>
                        <td><?= $survey['keterangan'] ?></td>
                        <td><?= countResponden($survey['id_survey'])."/".$survey['jumlah_responden'] ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <?php if ($jumlah_pertanyaan <= 0) { ?>
                                <form action="index.php?page=import-survey-admin" method="post">
                                    <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                    <button type="submit" name="import-survey" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-cloud-upload"></i>
                                    </button>
                                </form>
                            <?php } else { ?>
                                <form action="index.php?page=detail-survey-admin" method="post">
                                    <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                    <button type="submit" name="detail-survey" class="btn btn-primary" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </form>
                                
                                <a href="pages/report.php?id=<?= $survey['id_survey'] ?>" type="submit" target="_blank" class="btn btn-success" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-printer"></i>
                                </a>
                            <?php } ?>
                            <form action="process/survey_proses.php" method="post">
                                <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                <button type="submit" name="hapus-survey" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus?')" style="--bs-btn-padding-y: .1rem; --bs-btn-padding-x: .3rem; --bs-btn-font-size: .75rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</section>