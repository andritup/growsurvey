<?php
    if(!isAuthenticated()) header("Location: index.php?page=login-admin")
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
        <li class="breadcrumb-item active" aria-current="page">Riwayat Pembayaran</li>
    </ol>
    </nav>

    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Daftar Pembayaran</h4>
        </div>
        <hr>
        <?php if ($_SESSION['role'] === "admin") : ?>
        <div class="card mb-3">
            <div class="card-header">
                Pembayaran Terbaru
            </div>
            <div class="card-body">
                <table id="tabelDaftarKuisioner" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>ID Survey</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM bayar WHERE status = 'belum diverifikasi'";
                        $result = mysqli_query($conn, $query);
                        while($bayar = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $bayar['id_owner'] ?></td>
                            <td><?= $bayar['id_survey'] ?></td>
                            <td><?= $bayar['tanggal'] ?></td>
                            <td>IDR <?= number_format($bayar['jumlah_bayar'], 0, ',', '.') ?></td>
                            <td><?= $bayar['jenis_bayar'] ?></td>
                            <td><a href="assets/img/uploads/<?= $bayar['foto'] ?>" target="_blank"><i class="bi bi-image"></i></a></td>
                            <td><a href="process/verifikasi_pembayaran_proses.php?id=<?= $bayar['id_bayar'] ?>" class="btn btn-sm btn-primary" onclick="return confirm('verifikasi sekarang?')">verifikasi</a></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <div class="card mb-2">
            <div class="card-header">
                Pembayaran Selesai
            </div>
            <div class="card-body">
                <table id="tabelDaftarKuisioner2" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>ID Survey</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Bukti</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM bayar WHERE status = 'selesai'";

                        if ($_SESSION['role'] !== "admin") {
                            $id_owner = $_SESSION['user'];
                            $query = "SELECT * FROM bayar WHERE id_owner = '$id_owner'";
                        }
                        $result = mysqli_query($conn, $query);
                        while($bayar = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $bayar['id_owner'] ?></td>
                            <td><?= $bayar['id_survey'] ?></td>
                            <td><?= $bayar['tanggal'] ?></td>
                            <td>IDR <?= number_format($bayar['jumlah_bayar'], 0, ',', '.') ?></td>
                            <td><?= $bayar['jenis_bayar'] ?></td>
                            <td><a href="assets/img/uploads/<?= $bayar['foto'] ?>" target="_blank"><i class="bi bi-image"></i></a></td>
                            <td>
                                <?php 
                                    if($bayar['status'] === 'selesai') {
                                        echo '<span class="badge text-bg-success">selesai</span>';
                                    } else {
                                        echo '<span class="badge text-bg-warning">belum diverifikasi</span>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>