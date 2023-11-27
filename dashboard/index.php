<?php
include("../init.php");

/// Set Page Title
$page_title = "Login - Dashboard";

if(isset($_SESSION['loggedin'])){
    header("Location: ./events.php");
}

$invalidLogin = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $database->prepare("SELECT id, username, password FROM admins WHERE username = ? and password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();
    if ($user) {
        session_regenerate_id();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ./events.php");
    } else {
        $invalidLogin = true;
    }
}
?>

<html>

<?php include("../layout/head.php"); ?>

<body class="auth-layout">
    <div class="card login-card">
        <div class="card-body">
            <div style="width: 100%;display: flex; justify-content: center;align-items: center">
                <img src="../assets/logo.svg" class="text-center" />
            </div>
            <h4 class="text-center mb-4">Admin Dashboard Login</h4>

            <?php if ($invalidLogin) : ?>
                <div class="alert alert-danger" role="alert">
                    Invalid username and password. Please try again.
                </div>
            <?php endif; ?>

            <form action="./index.php" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-block btn-primary">Login</button>
            </form>
        </div>
    </div>

</body>

</html>
