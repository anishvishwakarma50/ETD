<?php
require_once __DIR__ . '/header.php';

$msg = '';
$msg_type = '';
$upload_dir = __DIR__ . '/../uploads/';

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM partners WHERE id = ?")->execute([$id]);
    header("Location: partners.php?msg=deleted");
    exit;
}

if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $msg = "Partner deleted successfully.";
    $msg_type = "success";
}
if (isset($_GET['msg']) && $_GET['msg'] === 'saved') {
    $msg = "Partner saved successfully.";
    $msg_type = "success";
}

// Handle Add/Edit Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $name = $_POST['name'] ?? '';
    $role = $_POST['role'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $linkedin = $_POST['linkedin'] ?? '';
    $email = $_POST['email'] ?? '';
    $display_order = (int)($_POST['display_order'] ?? 0);
    
    // Handle Image Upload
    $image_path = $_POST['existing_image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9\.]/", "", basename($_FILES['image']['name']));
        if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
            $image_path = 'uploads/' . $filename;
        }
    }
    
    if ($id) {
        // Update
        $stmt = $pdo->prepare("UPDATE partners SET name=?, role=?, bio=?, image=?, linkedin=?, email=?, display_order=? WHERE id=?");
        $stmt->execute([$name, $role, $bio, $image_path, $linkedin, $email, $display_order, $id]);
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO partners (name, role, bio, image, linkedin, email, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $role, $bio, $image_path, $linkedin, $email, $display_order]);
    }
    
    header("Location: partners.php?msg=saved");
    exit;
}

$action = $_GET['action'] ?? 'list';
$edit_id = $_GET['id'] ?? 0;

if ($action === 'edit' || $action === 'add') {
    $partner = [
        'id' => '', 'name' => '', 'role' => '', 'bio' => '', 'image' => '', 'linkedin' => '', 'email' => '', 'display_order' => '0'
    ];
    if ($edit_id) {
        $stmt = $pdo->prepare("SELECT * FROM partners WHERE id = ?");
        $stmt->execute([$edit_id]);
        $partner = $stmt->fetch() ?: $partner;
    }
?>
    <h1><?= $edit_id ? 'Edit' : 'Add' ?> Partner</h1>
    <a href="partners.php" class="btn" style="margin-bottom: 20px;">&larr; Back to List</a>
    <div class="card">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $partner['id'] ?>">
            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($partner['image']) ?>">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($partner['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" name="role" value="<?= htmlspecialchars($partner['role']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email Link (e.g. mailto:xyz@xyz.com)</label>
                <input type="text" name="email" value="<?= htmlspecialchars($partner['email']) ?>">
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="text" name="linkedin" value="<?= htmlspecialchars($partner['linkedin']) ?>">
            </div>
            <div class="form-group">
                <label>Display Order (Lower number = appears first)</label>
                <input type="text" name="display_order" value="<?= htmlspecialchars($partner['display_order']) ?>">
            </div>
            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" rows="6" required><?= htmlspecialchars($partner['bio']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Photo</label>
                <?php if ($partner['image']): ?>
                    <div style="margin-bottom:10px;">
                        <img src="../<?= htmlspecialchars($partner['image']) ?>" class="thumbnail" alt="Current Photo">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn">Save Partner</button>
        </form>
    </div>
<?php
} else {
    // List View
    $partners = $pdo->query("SELECT * FROM partners ORDER BY display_order ASC, id ASC")->fetchAll();
?>
    <h1>Manage Partners</h1>
    <?php if ($msg): ?>
        <div class="alert alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    
    <a href="partners.php?action=add" class="btn" style="margin-bottom: 20px;">+ Add New Partner</a>
    
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name / Role</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partners as $p): ?>
                <tr>
                    <td>
                        <?php if ($p['image']): ?>
                            <img src="../<?= htmlspecialchars($p['image']) ?>" class="thumbnail">
                        <?php else: ?>
                            <em>No Image</em>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= htmlspecialchars($p['name']) ?></strong><br>
                        <small><?= htmlspecialchars($p['role']) ?></small>
                    </td>
                    <td><?= $p['display_order'] ?></td>
                    <td>
                        <a href="partners.php?action=edit&id=<?= $p['id'] ?>" class="btn">Edit</a>
                        <a href="partners.php?delete=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete this partner?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($partners)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No partners found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php
}

require_once __DIR__ . '/footer.php';
?>
