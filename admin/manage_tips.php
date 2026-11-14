<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: /login.php"); exit; }
require_once '../includes/database.php';
$db   = new Database();
$conn = $db->connect();
$msg  = "";

if (isset($_POST['add'])) {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($title) {
        $stmt = $conn->prepare("INSERT INTO tips (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        $msg = "Tip added successfully.";
    }
}
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM tips WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    header("Location: manage_tips.php"); exit;
}
$tips = $conn->query("SELECT * FROM tips ORDER BY id DESC")->fetchAll() ?: [];
include '../includes/navbar.php';
?>
<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-title">Admin Panel</div>
        <a href="/GlowHabit/admin/index.php"          class="admin-nav-btn">📊 Dashboard</a>
        <a href="/GlowHabit/admin/manage_recipes.php"  class="admin-nav-btn">🥗 Recipes</a>
        <a href="/GlowHabit/admin/manage_workouts.php" class="admin-nav-btn">💪 Workouts</a>
        <a href="/GlowHabit/admin/manage_tips.php"     class="admin-nav-btn active">🌿 Tips</a>
        <div style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(255,255,255,.1)">
            <a href="/GlowHabit/pages/dashboard.php" class="admin-nav-btn">← Back to App</a>
        </div>
    </aside>
    <div class="admin-content">
        <div class="admin-page-title">Manage Wellness Tips</div>
        <div class="admin-page-sub">Add or remove wellness tips</div>

        <?php if ($msg): ?><div class="form-success-msg">✓ <?= htmlspecialchars($msg) ?></div><?php endif; ?>

        <div class="admin-form-card">
            <h3>Add new tip</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input class="form-input" type="text" name="title" placeholder="e.g. Daily Stretching" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Content</label>
                    <textarea class="form-input" name="content" placeholder="Wellness tip content…" style="min-height:80px;resize:vertical"></textarea>
                </div>
                <button type="submit" name="add" class="btn-dark">Add Tip</button>
            </form>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-header"><h3>All tips (<?= count($tips) ?>)</h3></div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Title</th><th>Content</th><th>Action</th></tr></thead>
                <tbody>
                <?php foreach ($tips as $t): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= htmlspecialchars($t['title'] ?? '') ?></td>
                    <td style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($t['content'] ?? '') ?></td>
                    <td><a href="?delete=<?= $t['id'] ?>" class="del-btn" onclick="return confirm('Delete this tip?')">🗑 Delete</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (!$tips): ?><tr><td colspan="4" style="text-align:center;padding:28px;color:var(--muted)">No tips yet.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
