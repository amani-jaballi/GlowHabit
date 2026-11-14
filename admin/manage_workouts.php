<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: /login.php"); exit; }
require_once '../includes/database.php';
$db   = new Database();
$conn = $db->connect();
$msg  = "";

if (isset($_POST['add_workout'])) {
    $stmt = $conn->prepare("INSERT INTO workouts (name, description) VALUES (?, ?)");
    $stmt->execute([trim($_POST['name']), trim($_POST['description'])]);
    $msg = "Workout added successfully.";
}
if (isset($_GET['delete_workout'])) {
    $stmt = $conn->prepare("DELETE FROM workouts WHERE id = ?");
    $stmt->execute([(int)$_GET['delete_workout']]);
    header("Location: manage_workouts.php"); exit;
}
$workouts = $conn->query("SELECT id, name, description FROM workouts ORDER BY id DESC")->fetchAll() ?: [];
include '../includes/navbar.php';
?>
<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-title">Admin Panel</div>
        <a href="/GlowHabit/admin/index.php"          class="admin-nav-btn">📊 Dashboard</a>
        <a href="/GlowHabit/admin/manage_recipes.php"  class="admin-nav-btn">🥗 Recipes</a>
        <a href="/GlowHabit/admin/manage_workouts.php" class="admin-nav-btn active">💪 Workouts</a>
        <a href="/GlowHabit/admin/manage_tips.php"     class="admin-nav-btn">🌿 Tips</a>
        <div style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(255,255,255,.1)">
            <a href="/GlowHabit/pages/dashboard.php" class="admin-nav-btn">← Back to App</a>
        </div>
    </aside>
    <div class="admin-content">
        <div class="admin-page-title">Manage Workouts</div>
        <div class="admin-page-sub">Add or remove workout exercises</div>

        <?php if ($msg): ?><div class="form-success-msg">✓ <?= htmlspecialchars($msg) ?></div><?php endif; ?>

        <div class="admin-form-card">
            <h3>Add new workout</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Exercise name</label>
                    <input class="form-input" type="text" name="name" placeholder="e.g. Deadlifts" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description / Instructions</label>
                    <textarea class="form-input" name="description" placeholder="Sets, reps, instructions…" style="min-height:80px;resize:vertical"></textarea>
                </div>
                <button type="submit" name="add_workout" class="btn-dark">Add Workout</button>
            </form>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-header"><h3>All workouts (<?= count($workouts) ?>)</h3></div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Action</th></tr></thead>
                <tbody>
                <?php foreach ($workouts as $w): ?>
                <tr>
                    <td><?= $w['id'] ?></td>
                    <td><?= htmlspecialchars($w['name']) ?></td>
                    <td style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($w['description']) ?></td>
                    <td><a href="?delete_workout=<?= $w['id'] ?>" class="del-btn" onclick="return confirm('Delete this workout?')">🗑 Delete</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (!$workouts): ?><tr><td colspan="4" style="text-align:center;padding:28px;color:var(--muted)">No workouts yet.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
