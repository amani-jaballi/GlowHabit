<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GlowHabit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/includes/style.css">
</head>
<body>

<nav class="navbar" id="main-navbar">
    <div class="nav-logo">
        <a href="/index.php">🌿 Glow<span>Habit</span></a>
    </div>

    <ul class="nav-links" id="navLinks">
        <li><a href="/index.php"
            <?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'class="nav-active"'; ?>>Home</a></li>
        <li><a href="/about.php"
            <?php if(basename($_SERVER['PHP_SELF'])=='about.php') echo 'class="nav-active"'; ?>>About</a></li>
        <li><a href="/contact.php"
            <?php if(basename($_SERVER['PHP_SELF'])=='contact.php') echo 'class="nav-active"'; ?>>Contact</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/pages/dashboard.php"
                <?php if(basename($_SERVER['PHP_SELF'])=='dashboard.php') echo 'class="nav-active"'; ?>>Dashboard</a></li>
            <li class="has-submenu">
                <a href="javascript:void(0)">Meal Plans ▾</a>
                <ul class="submenu">
                    <li><a href="/recipes_lose.php">Lose Weight</a></li>
                    <li><a href="/recipes_gain.php">Gain Weight</a></li>
                </ul>
            </li>
            <li><a href="/fitness.php"
                <?php if(basename($_SERVER['PHP_SELF'])=='fitness.php') echo 'class="nav-active"'; ?>>Workouts</a></li>
            <li><a href="/wellness.php"
                <?php if(basename($_SERVER['PHP_SELF'])=='wellness.php') echo 'class="nav-active"'; ?>>Wellness</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="/admin/index.php">Admin ⚙️</a></li>
            <?php endif; ?>
            <li><a href="/logout.php"
                onclick="return confirm('Sign out of GlowHabit?');"
                style="color:#e53e3e!important">Sign out</a></li>
        <?php else: ?>
            <li><a href="/login.php" class="btn-nav">Sign In</a></li>
        <?php endif; ?>
    </ul>

    <div class="menu-toggle" onclick="document.getElementById('navLinks').classList.toggle('show')">☰</div>
</nav>
