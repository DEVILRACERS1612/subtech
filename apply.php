<?php
include_once "./config/config.inc.php";

$job_id = isset($_GET['job']) ? $_GET['job'] : '';

if($job_id != ''){
    $query = mysqli_query($conn,"SELECT * FROM jobs WHERE id='$job_id'");
    $row = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Job</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Apply Now</h2>
        <p class="text-muted">Join the team by filling out the form below</p>
    </div>

    <div class="card shadow-sm p-4 mx-auto" style="max-width:600px;">

        <form id="applyform" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="<?=$job_id?>" />
            <input type="hidden" name="method" value="JobApply" />
            <input type="hidden" name="job" value="<?=$job_id?>" />

            <div class="mb-3">
                <label class="form-label">Full Name *</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address *</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number *</label>
                <input type="number" class="form-control" name="mobile" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Resume (PDF only) *</label>
                <input type="file" class="form-control" name="resume" accept=".pdf" required>
            </div>

            <div class="mb-3">
                <label class="form-label">About You</label>
                <textarea class="form-control" name="message" rows="4"></textarea>
            </div>

            <div id="msg" class="text-center mb-3"></div>

            <div class="text-center">
                <button type="submit" id="btnsubmit" class="btn btn-danger px-5 py-2 fw-semibold">
                    Submit Application
                </button>
            </div>

        </form>

    </div>

</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>