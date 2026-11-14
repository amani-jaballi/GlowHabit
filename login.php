<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /pages/dashboard.php"); exit;
}
require_once 'includes/database.php';
require_once 'classes/user.php';

$db  = new Database();
$pdo = $db->connect();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);

    if (isset($_POST['remember']) && $email) {
        setcookie("remember_email", $email, time() + 86400 * 30, "/");
    }

    if (!$email || !$password) {
        $errors[] = "Please fill in all fields correctly.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];
            header("Location: " . ($user['role'] === 'admin' ? '/admin/index.php' : '/pages/dashboard.php'));
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
include 'includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">🌿 Glow<span>Habit</span></div>
        <h2 class="auth-title">Welcome back</h2>
        <p class="auth-sub">Sign in to continue your wellness journey.</p>

        <?php foreach ($errors as $e): ?>
            <div class="form-error-msg">⚠ <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input class="form-input" type="email" name="email" required placeholder="you@email.com"
                    value="<?= isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : '' ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input class="form-input" type="password" name="password" required placeholder="••••••••">
            </div>
            <div class="remember-row">
                <label><input type="checkbox" name="remember"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn-full">Sign in</button>
        </form>

        <p class="auth-switch">Don't have an account? <a href="/signup.php">Sign up free</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
