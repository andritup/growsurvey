<?php
    if(!isAuthenticated()) header("Location: index.php?page=login-admin")
?>
<section id="import-survey" style="margin-top:90px">
<div class="container">

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?page=survey-admin">Survey</a></li>
        <li class="breadcrumb-item active" aria-current="page">Import</li>
    </ol>
    </nav>

    <form action="process/survey_proses.php" method="post" enctype="multipart/form-data">
    <div class="card p-4">
        <div class="d-flex justify-content-between">
            <h4 style="color: darkblue">Import Survey</h4>
        </div>
        <hr>

        <div id="form-survey">
            <input type="hidden" name="id_survey" value="<?= $_POST['id_survey'] ?>">
            <div class="mb-3">
                <label for="survey_file" class="form-label">Upload file (.xlsx)</label>
                <input class="form-control" type="file" id="survey_file" name="survey_file">
            </div>

            <!-- Button next -->
            <button type="submit" class="btn btn-primary float-end" name="import-survey">Submit</button>
        </div>
    </div>
    </form>
</div>
</section>