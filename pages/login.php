<section id="login">
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card mt-5 py-5 px-5 border-0 shadow">
                <h5 class="text-muted fst-italic">Login</h5>
                <h2 class="mb-4 text-warning">GrowSurvey</h2>

                <!-- Alert -->
                <?php if (isset($_SESSION['msg'])) : ?>
                    <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']['value'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['msg']) ?>
                
                <form action="process/login_proses.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
                <p class="mt-3">Belum memiliki akun? <a href="index.php?page=registrasi">registrasi sekarang</a></p>
            </div>
        </div>
    </div>
</div>
</section>