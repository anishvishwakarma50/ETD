<?php
require_once __DIR__ . '/header.php';

$msg = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = __DIR__ . '/../uploads/';
    
    // Helper function to handle video uploads
    function uploadVideo($fileKey, $settingKey, $pdo, $upload_dir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$fileKey]['tmp_name'];
            $name = basename($_FILES[$fileKey]['name']);
            // Generate a unique name
            $new_name = time() . '_' . preg_replace("/[^a-zA-Z0-9\.]/", "", $name);
            $target_file = $upload_dir . $new_name;
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $db_path = 'uploads/' . $new_name;
                $stmt = $pdo->prepare("UPDATE settings SET value = ? WHERE key = ?");
                $stmt->execute([$db_path, $settingKey]);
                return true;
            }
        }
        return false;
    }

    $uploadedAny = false;
    if (uploadVideo('portrait_video', 'hero_video_portrait', $pdo, $upload_dir)) $uploadedAny = true;
    if (uploadVideo('landscape_video', 'hero_video_landscape', $pdo, $upload_dir)) $uploadedAny = true;
    
    if ($uploadedAny) {
        $msg = "Videos updated successfully!";
        $msg_type = "success";
    } else {
        $msg = "No valid video files uploaded.";
        $msg_type = "error";
    }
}

// Fetch current settings
$settings = $pdo->query("SELECT key, value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
?>

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
