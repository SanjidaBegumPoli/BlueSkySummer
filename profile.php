<?php
session_start();
include("dbcon.php");

// Only logged in users can access
if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];

// Fetch user data
$query = $con->prepare("SELECT name, phone, email, created_at FROM user WHERE email=? LIMIT 1");
$query->bind_param("s", $user_email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<?php include("includes/header.php"); ?>

<div class="container my-5">
    <h3 class="text-center text-danger mb-4">My Profile</h3>
    
    <?php if ($user): ?>
        <div class="card p-4 shadow">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Joined On:</strong> <?= htmlspecialchars($user['created_at']) ?></p>
            
            <div class="mt-3">
                <a href="profile_edit.php" class="btn btn-warning">Edit Profile</a>
                <a href="profile_delete.php" class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                   Delete Account
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">User not found!</div>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>
