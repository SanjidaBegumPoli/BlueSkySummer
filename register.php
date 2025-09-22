<?php  
session_start();
$page_title  = "Registration Form";

include("includes/header.php");
//include("includes/navbar.php");
//include("include/code.php");
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php
                        if(isset($_SESSION['status']))
                        {
                            echo "<h4>",$_SESSION['status']."</h4>";
                            unset($_SESSION['status']);
                        }
                    
                    ?>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center text-danger">Registration Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="name" class="fw-bold text-warning">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="fw-bold text-warning">Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="fw-bold text-warning">Email ID</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="fw-bold text-warning">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <!-- <div class="form-group mb-3">
                                <label for="">Confirm Password</label>
                                <input type="text" name="confirm_password" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-danger col-12">Register Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<?php include("includes/footer.php"); ?>