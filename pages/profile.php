<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: /login.php"); exit; }

include '../includes/database.php';
include '../classes/user.php';

$db      = new Database();
$conn    = $db->connect();
$userObj = new User($conn);
$uid     = $_SESSION['user_id'];
$msg     = "";
$msgType = "success";

$user = $userObj->getUserById($uid);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $weight   = (float)$_POST['weight'];
    $height   = (float)$_POST['height'];
    $goal     = $_POST['goal'];

    if ($userObj->updateProfile($uid, $username, $email, $user['gender'], $height, $weight, $goal)) {
        $msg     = "Profile updated successfully.";
        $msgType = "success";
        $_SESSION['username'] = $username;
        $user = $userObj->getUserById($uid);
    } else {
        $msg     = "Error updating profile. Please try again.";
        $msgType = "error";
    }
}

$bmi = "";
$bmiStatus = "";
if ($user['height'] > 0 && $user['weight'] > 0) {
    $bmiVal = $user['weight'] / pow($user['height'] / 100, 2);
    $bmi = round($bmiVal, 1);
    if ($bmiVal < 18.5)     $bmiStatus = "Underweight";
    elseif ($bmiVal < 25)   $bmiStatus = "Normal weight ✓";
    elseif ($bmiVal < 30)   $bmiStatus = "Overweight";
    else                    $bmiStatus = "Obese";
}

include '../includes/navbar.php';
?>

<div class="profile-wrapper">
    <div class="profile-header-card">
        <div class="profile-avatar"><?= $user['gender'] === 'Female' ? '👩' : '👨' ?></div>
        <div>
            <div class="profile-header-name"><?= htmlspecialchars($user['username']) ?></div>
            <div class="profile-header-email"><?= htmlspecialchars($user['email']) ?></div>
            <div class="profile-header-goal">🎯 <?= htmlspecialchars($user['goal']) ?></div>
        </div>
    </div>

    <div class="card-box">
        <div class="card-box-title">✏️ Edit Profile</div>

        <?php if ($msg): ?>
            <div class="form-<?= $msgType ?>-msg"><?= $msgType === 'success' ? '✓' : '⚠' ?> <?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Full name</label>
                    <input class="form-input" type="text" name="username" required value="<?= htmlspecialchars($user['username']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input class="form-input" type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Weight (kg)</label>
                    <input class="form-input" type="number" name="weight" step="0.1" min="30" required
                        value="<?= htmlspecialchars($user['weight']) ?>" id="inp-weight">
                </div>
                <div class="form-group">
                    <label class="form-label">Height (cm)</label>
                    <input class="form-input" type="number" name="height" step="0.1" min="100" required
                        value="<?= htmlspecialchars($user['height']) ?>" id="inp-height">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Goal</label>
                <select class="form-input" name="goal" required>
                    <option value="Lose Weight"     <?= $user['goal']==='Lose Weight'     ? 'selected':'' ?>>Lose Weight</option>
                    <option value="Gain Weight"     <?= $user['goal']==='Gain Weight'     ? 'selected':'' ?>>Gain Weight</option>
                    <option value="Maintain Weight" <?= $user['goal']==='Maintain Weight' ? 'selected':'' ?>>Maintain Weight</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Your BMI</label>
                <div class="bmi-display" id="bmi-display">
                    <div>
                        <div class="bmi-num" id="bmi-num"><?= $bmi ?: '—' ?></div>
                        <div class="bmi-label" id="bmi-label"><?= $bmiStatus ?: 'Fill in your stats' ?></div>
                    </div>
                    <div class="bmi-status">BMI Score</div>
                </div>
            </div>
            <button type="submit" name="update" class="btn-full">Save changes</button>
        </form>
    </div>
</div>

<script>
function recalcBMI() {
    const w = parseFloat(document.getElementById('inp-weight').value);
    const h = parseFloat(document.getElementById('inp-height').value);
    if (w > 0 && h > 0) {
        const bmi = w / Math.pow(h / 100, 2);
        const val = Math.round(bmi * 10) / 10;
        let status = bmi < 18.5 ? 'Underweight' : bmi < 25 ? 'Normal weight ✓' : bmi < 30 ? 'Overweight' : 'Obese';
        document.getElementById('bmi-num').textContent   = val;
        document.getElementById('bmi-label').textContent = status;
    }
}
document.getElementById('inp-weight').addEventListener('input', recalcBMI);
document.getElementById('inp-height').addEventListener('input', recalcBMI);
</script>

<?php include '../includes/footer.php'; ?>
