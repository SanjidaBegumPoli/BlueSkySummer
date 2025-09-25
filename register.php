<?php
session_start();
$page_title  = "Registration Form";

include("includes/header.php");
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Top Buttons -->
                <div class="d-flex justify-content-between mb-3 align-items-center">
                    <a href="javascript:history.back()"
                        style="color:#ff69b4; font-weight:bold; text-decoration:none;">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                    <a href="login.php" style="border:2px solid #ff69b4; color:#ff69b4; font-weight:bold; padding:0.375rem 0.75rem; border-radius:0.25rem; text-decoration:none;">
                        Login
                    </a>
                </div>

                <!-- Status Message -->
                <div class="alert">
                    <?php
                    if (isset($_SESSION['status'])) {
                        echo "<h4>", $_SESSION['status'], "</h4>";
                        unset($_SESSION['status']);
                    }
                    ?>
                </div>

                <!-- Registration Card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center text-danger">Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <label for="name" class="fw-bold text-warning">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <!-- Phone -->
                            <div class="form-group mb-3">
                                <label for="phone" class="fw-bold text-warning">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="email" class="fw-bold text-warning">Email ID</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3 position-relative">
                                <label for="password" class="fw-bold text-warning">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                
                                <span id="togglePassword"
                                    style="position:absolute; top:38px; right:15px; cursor:pointer; color:#ff69b4; font-size:1.2rem;">
                                    <i class="bi bi-eye-fill"></i>
                                </span>
                            </div>

                            <!-- Submit -->
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-danger col-12">
                                    Register Now
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