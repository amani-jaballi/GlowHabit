<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /login.php"); exit;
}
include '../includes/database.php';
$db   = new Database();
$conn = $db->connect();

$total_users   = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_recipes = $conn->query("SELECT COUNT(*) FROM recipes")->fetchColumn();
$total_workouts= $conn->query("SELECT COUNT(*) FROM workouts")->fetchColumn();
$total_tips    = $conn->query("SELECT COUNT(*) FROM tips")->fetchColumn();

include '../includes/navbar.php';
?>

<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-title">Admin Panel</div>
        <a href="/admin/index.php"          class="admin-nav-btn active">📊 Dashboard</a>
        <a href="/admin/manage_recipes.php"  class="admin-nav-btn">🥗 Recipes</a>
        <a href="/admin/manage_workouts.php" class="admin-nav-btn">💪 Workouts</a>
        <a href="/admin/manage_tips.php"     class="admin-nav-btn">🌿 Tips</a>
        <div style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(255,255,255,.1)">
            <a href="/pages/dashboard.php" class="admin-nav-btn">← Back to App</a>
        </div>
    </aside>

    <div class="admin-content">
        <div class="admin-page-title">Admin Dashboard</div>
        <div class="admin-page-sub">Overview of all GlowHabit content</div>

        <div class="admin-stat-row">
            <div class="admin-stat green">
                <div class="admin-stat-icon">👥</div>
                <div><div class="admin-stat-num"><?= $total_users ?></div><div class="admin-stat-label">Registered users</div></div>
            </div>
            <div class="admin-stat blue">
                <div class="admin-stat-icon">🥗</div>
                <div><div class="admin-stat-num"><?= $total_recipes ?></div><div class="admin-stat-label">Recipes</div></div>
            </div>
            <div class="admin-stat orange">
                <div class="admin-stat-icon">💪</div>
                <div><div class="admin-stat-num"><?= $total_workouts ?></div><div class="admin-stat-label">Workouts</div></div>
            </div>
            <div class="admin-stat purple">
                <div class="admin-stat-icon">🌿</div>
                <div><div class="admin-stat-num"><?= $total_tips ?></div><div class="admin-stat-label">Wellness tips</div></div>
            </div>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-header">
                <h3>Quick actions</h3>
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;padding:20px">
                <a href="/admin/manage_recipes.php"  class="btn-dark" style="justify-content:center">🥗 Manage Recipes</a>
                <a href="/admin/manage_workouts.php" class="btn-dark" style="justify-content:center">💪 Manage Workouts</a>
                <a href="/admin/manage_tips.php"     class="btn-dark" style="justify-content:center">🌿 Manage Tips</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
