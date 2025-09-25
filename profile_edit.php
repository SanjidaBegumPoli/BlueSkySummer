<?php
session_start();
include("dbcon.php");

if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['auth_user']['email'];

$query = $con->prepare("SELECT name, phone, email, password FROM user WHERE email=? LIMIT 1");
$query->bind_param("s", $user_email);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    
    if (!preg_match("/^[a-zA-Z ]{2,50}$/", $name)) {
        $errors[] = "Name must be 2-50 characters long and only letters/spaces.";
    }

    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errors[] = "Phone must be 10-15 digits.";
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{6,20}$/", $password)) {
        $errors[] = "Password must be 6-20 characters with letters, numbers, and special characters.";
    }

    if (empty($errors)) {
        if (!empty($password)) {
            $update = $con->prepare("UPDATE user SET name=?, phone=?, password=? WHERE email=?");
            $update->bind_param("ssss", $name, $phone, $password, $user_email);
        } else {
            $update = $con->prepare("UPDATE user SET name=?, phone=? WHERE email=?");
            $update->bind_param("sss", $name, $phone, $user_email);
        }

        if ($update->execute()) {
            $_SESSION['auth_user']['username'] = $name; 
            $_SESSION['status'] = "Profile updated successfully!";
            header("Location: profile.php");
            exit();
        } else {
            $errors[] = "Something went wrong while updating profile!";
        }
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="container my-5">
    <h3 class="text-center text-danger mb-4">Edit Profile</h3>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow" id="editProfileForm">

        <div class="mb-3">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required
                   pattern="[a-zA-Z ]{2,50}" title="2-50 letters and spaces only">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" required
                   pattern="[0-9]{10,15}" title="10-15 digits only">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email (read-only)</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="text" name="password" class="form-control" 
                   value="<?= htmlspecialchars($user['password']) ?>" required
                   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{6,20}$" 
                   title="6-20 chars, letters, numbers, and special chars">
        </div>

        <button type="submit" class="btn btn-warning">Update Profile</button>
        <a href="profile.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("includes/footer.php"); ?>

<script>
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
    let form = e.target;
    let name = form.name.value.trim();
    let phone = form.phone.value.trim();
    let password = form.password.value;

    let nameRegex = /^[a-zA-Z ]{2,50}$/;
    let phoneRegex = /^[0-9]{10,15}$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&]).{6,20}$/;

    if(!nameRegex.test(name) || !phoneRegex.test(phone) || !passwordRegex.test(password)) {
        alert("Please fill the fields correctly according to the guidelines.");
        e.preventDefault();
    }
});
</script>
