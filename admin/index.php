<?php require_once __DIR__ . '/header.php'; ?>
<h1>Dashboard</h1>
<div class="card">
    <p>Welcome, <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong>!</p>
    <p>Use the sidebar to manage the site content. You can update the hero section videos or manage the team members shown on the site.</p>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>
