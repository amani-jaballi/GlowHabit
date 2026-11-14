<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: /login.php"); exit; }
include '../includes/navbar.php';

$h = (int)date('H');
$greeting = $h < 12 ? 'Good morning' : ($h < 18 ? 'Good afternoon' : 'Good evening');
$username = htmlspecialchars($_SESSION['username'] ?? 'there');
?>

<div class="dash-header">
    <div class="dash-header-inner">
        <div class="dash-greeting"><?= $greeting ?>,</div>
        <div class="dash-name"><?= $username ?> 👋</div>
    </div>
</div>

<div class="dash-body">
    <div class="dash-cards">
        <a href="/fitness.php" class="dash-card">
            <div class="dash-card-icon"><img src="../pics/work.png" alt="Workout"></div>
            <h3>Workout Plans</h3>
            <p>Check your exercises and routines to gain muscle or lose weight.</p>
            <div class="dash-card-link">View programs →</div>
        </a>
        <a href="/recipes_lose.php" class="dash-card">
            <div class="dash-card-icon"><img src="../pics/meal.png" alt="Meals"></div>
            <h3>Meal Plans</h3>
            <p>Explore healthy meal plans for gaining or losing weight.</p>
            <div class="dash-card-link">Browse meals →</div>
        </a>
        <a href="/wellness.php" class="dash-card">
            <div class="dash-card-icon" style="background:#f0f9f4;font-size:1.5rem;display:flex;align-items:center;justify-content:center">🧘</div>
            <h3>Wellness Tips</h3>
            <p>Mindfulness, sleep, hydration and daily habits to improve your life.</p>
            <div class="dash-card-link">Read tips →</div>
        </a>
        <a href="/pages/profile.php" class="dash-card">
            <div class="dash-card-icon"><img src="../pics/profi.png" alt="Profile"></div>
            <h3>Your Profile</h3>
            <p>Update your stats, goal, and personal information.</p>
            <div class="dash-card-link">Edit profile →</div>
        </a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
