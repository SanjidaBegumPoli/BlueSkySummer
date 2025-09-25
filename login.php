<?php
session_start();
if (isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already logged in";
    header('Location: dashboard.php');
    exit(0);
}
$page_title  = "Login Form";

include("includes/header.php");
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <a href="javascript:history.back()"
                        class="d-flex align-items-center"
                        style="color:#ff69b4; font-weight:bold; text-decoration:none;">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                    <a href="register.php" class="btn"
                        style="border:2px solid #ff69b4; color:#ff69b4; font-weight:bold;">
                        Register
                    </a>
                </div>
                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert alert-success">
                        <h5>
                            <?= $_SESSION['status']; ?>
                        </h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="text-center text-danger">Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="email" class="fw-bold text-warning">Email ID</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group mb-3 position-relative">
                                <label for="password" class="fw-bold text-warning">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>

                                <span id="togglePassword"
                                    style="position:absolute; top:38px; right:15px; cursor:pointer; color:#ff69b4;">
                                    <i class="bi bi-eye-fill"></i>
                                </span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-danger col-12">
                                    Login Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const eyeIcon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye-fill');
        eyeIcon.classList.toggle('bi-eye-slash-fill');
    });
</script>

<?php include("includes/footer.php"); ?>