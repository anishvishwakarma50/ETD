<?php require_once __DIR__ . '/header.php'; ?>

<h1>Hero Section Settings</h1>

<?php if ($msg): ?>
    <div class="alert alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="card">
    <h2>Update Hero Videos</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Portrait Video (Mobile) (.mp4)</label>
            <p>Current: <code><?= htmlspecialchars($settings['hero_video_portrait'] ?? 'None') ?></code></p>
            <input type="file" name="portrait_video" accept="video/mp4,video/webm">
        </div>
        
        <div class="form-group">
            <label>Landscape Video (Desktop) (.mp4)</label>
            <p>Current: <code><?= htmlspecialchars($settings['hero_video_landscape'] ?? 'None') ?></code></p>
            <input type="file" name="landscape_video" accept="video/mp4,video/webm">
        </div>
        
        <button type="submit" class="btn">Upload & Save</button>
    </form>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
