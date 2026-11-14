<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: /login.php"); exit; }
require_once '../includes/database.php';
$db   = new Database();
$conn = $db->connect();
$msg  = "";

if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO recipes (title, description) VALUES (?, ?)");
    $stmt->execute([trim($_POST['title']), trim($_POST['description'])]);
    $msg = "Recipe added successfully.";
}
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ?");
    $stmt->execute([(int)$_GET['delete']]);
    header("Location: manage_recipes.php"); exit;
}
$recipes = $conn->query("SELECT id, title, description FROM recipes ORDER BY id DESC")->fetchAll() ?: [];
include '../includes/navbar.php';
?>
<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="admin-sidebar-title">Admin Panel</div>
        <a href="/GlowHabit/admin/index.php"          class="admin-nav-btn">📊 Dashboard</a>
        <a href="/GlowHabit/admin/manage_recipes.php"  class="admin-nav-btn active">🥗 Recipes</a>
        <a href="/GlowHabit/admin/manage_workouts.php" class="admin-nav-btn">💪 Workouts</a>
        <a href="/GlowHabit/admin/manage_tips.php"     class="admin-nav-btn">🌿 Tips</a>
        <div style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(255,255,255,.1)">
            <a href="/GlowHabit/pages/dashboard.php" class="admin-nav-btn">← Back to App</a>
        </div>
    </aside>
    <div class="admin-content">
        <div class="admin-page-title">Manage Recipes</div>
        <div class="admin-page-sub">Add or remove meal plan recipes</div>

        <?php if ($msg): ?><div class="form-success-msg">✓ <?= htmlspecialchars($msg) ?></div><?php endif; ?>

        <div class="admin-form-card">
            <h3>Add new recipe</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input class="form-input" type="text" name="title" placeholder="Recipe title" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description / Ingredients</label>
                    <textarea class="form-input" name="description" placeholder="Ingredients and preparation…" style="min-height:80px;resize:vertical"></textarea>
                </div>
                <button type="submit" name="add" class="btn-dark">Add Recipe</button>
            </form>
        </div>

        <div class="admin-table-card">
            <div class="admin-table-header"><h3>All recipes (<?= count($recipes) ?>)</h3></div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Title</th><th>Description</th><th>Action</th></tr></thead>
                <tbody>
                <?php foreach ($recipes as $r): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td style="max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($r['description']) ?></td>
                    <td><a href="?delete=<?= $r['id'] ?>" class="del-btn" onclick="return confirm('Delete this recipe?')">🗑 Delete</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (!$recipes): ?><tr><td colspan="4" style="text-align:center;padding:28px;color:var(--muted)">No recipes yet.</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
