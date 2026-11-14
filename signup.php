<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); session_regenerate_id(true); }
if (isset($_SESSION['user_id'])) { header("Location: /pages/dashboard.php"); exit; }

require_once 'includes/database.php';
require_once 'classes/user.php';
$db  = new Database();
$pdo = $db->connect();

$errors  = [];
$success = "";
$f = ['username'=>'','email'=>'','gender'=>'','height'=>'','weight'=>'','goal'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $f['username'] = trim($_POST['username']);
    $f['email']    = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password      = trim($_POST['password']);
    $f['gender']   = $_POST['gender'];
    $f['height']   = (float)$_POST['height'];
    $f['weight']   = (float)$_POST['weight'];
    $f['goal']     = $_POST['goal'];

    if (empty($f['username']) || !$f['email'] || empty($password) || empty($f['gender']) || empty($f['goal'])) $errors[] = "Please fill in all required fields.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($f['height'] <= 0 || $f['weight'] <= 0) $errors[] = "Height and weight must be positive numbers.";

    if (empty($errors)) {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $check->execute(['email' => $f['email']]);
        if ($check->fetch()) $errors[] = "This email address is already registered.";
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username,email,password,gender,height,weight,goal,role) VALUES (?,?,?,?,?,?,?,'user')");
        try {
            $stmt->execute([$f['username'],$f['email'],$hash,$f['gender'],$f['height'],$f['weight'],$f['goal']]);
            $success = "Account created! You can now sign in.";
            $f = array_fill_keys(array_keys($f), '');
        } catch (PDOException $e) {
            $errors[] = "Database error: " . htmlspecialchars($e->getMessage());
        }
    }
}
include 'includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card" style="max-width:520px">
        <div class="auth-logo">🌿 Glow<span>Habit</span></div>
        <h2 class="auth-title">Create your account</h2>
        <p class="auth-sub">Join thousands building healthier habits every day.</p>

        <?php foreach ($errors as $e): ?>
            <div class="form-error-msg">⚠ <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
        <?php if ($success): ?>
            <div class="form-success-msg">✓ <?= htmlspecialchars($success) ?> <a href="/login.php" style="font-weight:700;color:var(--mint-2);margin-left:4px">Sign in →</a></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Full name</label>
                <input class="form-input" type="text" name="username" required placeholder="Sara Ben Ali" value="<?= htmlspecialchars($f['username']) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input class="form-input" type="email" name="email" required placeholder="you@email.com" value="<?= htmlspecialchars($f['email']) ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Password <span style="font-weight:400;color:var(--muted)">(min. 6 characters)</span></label>
                <input class="form-input" type="password" name="password" required placeholder="Choose a strong password">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select class="form-input" name="gender" required>
                        <option value="">Select</option>
                        <option value="Male"   <?= $f['gender']==='Male'   ? 'selected':'' ?>>Male</option>
                        <option value="Female" <?= $f['gender']==='Female' ? 'selected':'' ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Goal</label>
                    <select class="form-input" name="goal" required>
                        <option value="">Select</option>
                        <option value="Lose Weight"     <?= $f['goal']==='Lose Weight'     ? 'selected':'' ?>>Lose Weight</option>
                        <option value="Gain Weight"     <?= $f['goal']==='Gain Weight'     ? 'selected':'' ?>>Gain Weight</option>
                        <option value="Maintain Weight" <?= $f['goal']==='Maintain Weight' ? 'selected':'' ?>>Maintain Weight</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Height (cm)</label>
                    <input class="form-input" type="number" name="height" step="0.1" min="100" max="250" required placeholder="170" value="<?= htmlspecialchars($f['height']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input class="form-input" type="number" name="weight" step="0.1" min="30" max="300" required placeholder="65" value="<?= htmlspecialchars($f['weight']) ?>">
                </div>
            </div>
            <button type="submit" class="btn-full">Create account</button>
        </form>
        <p class="auth-switch">Already have an account? <a href="/login.php">Sign in</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
