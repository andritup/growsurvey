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
            <h4 style="color: darkblue">Survey</h4>
        </div>
        <hr>

        <!-- Menampilkan data dalam bentuk tabel -->
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
                    $query = "SELECT * FROM survey WHERE jenis = 'public'";
                    $result = mysqli_query($conn, $query);

                    while ($survey = mysqli_fetch_assoc($result)) {
                        $jumlah_pertanyaan = dataExist($survey['id_survey'], 'id_survey', 'kuisioner');
                        if($jumlah_pertanyaan > 0 && countResponden($survey['id_survey']) == $survey['jumlah_responden']) {
                ?>
                    <tr>
                        <td><?= $survey['nama_survey'] ?></td>
                        <td><?= $survey['keterangan'] ?></td>
                        <td><?= $survey['jumlah_responden'] ?></td>
                        <td>    
                            <form action="index.php?page=detail-survey" method="post">
                                <input type="hidden" name="id_survey" value="<?= $survey['id_survey'] ?>">
                                <button type="submit" name="detail-survey" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                    lihat
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php 
                        }
                    } 
                ?>
            </tbody>
        </table>
    </div>
</div>
</section>