<section id="login-admin">
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card mt-5 py-5 px-5 border-0 shadow">
                <h5 class="text-muted fst-italic">Login</h5>
                <h2 class="mb-4" style="color: #3d0fd6">GrowSurvey - Admin</h2>

                <!-- Alert -->
                <?php if (isset($_SESSION['msg'])) : ?>
                    <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']['value'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['msg']) ?>
                
                <form action="process/login_admin_proses.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
</section>