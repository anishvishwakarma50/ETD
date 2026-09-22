<?php
require_once __DIR__ . '/header.php';

$msg = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($username && $password) {
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
                $msg = "User added successfully.";
                $msg_type = "success";
            } catch (Exception $e) {
                $msg = "Error adding user. That username might already exist.";
                $msg_type = "error";
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'] ?? 0;
        if ($id != $_SESSION['admin_id']) { // Prevent deleting self
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
            $msg = "User deleted successfully.";
            $msg_type = "success";
        } else {
            $msg = "You cannot delete your own account while logged in.";
            $msg_type = "error";
        }
    }
}

$users = $pdo->query("SELECT id, username, created_at FROM users ORDER BY created_at DESC")->fetchAll();
?>

<h1>Manage Admin Users</h1>

<?php if ($msg): ?>
    <div class="alert alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="card">
    <h2>Add New Admin</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">Add Admin</button>
    </form>
</div>

<div class="card">
    <h2>Existing Admins</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= $u['created_at'] ?></td>
                <td>
                    <?php if ($u['id'] != $_SESSION['admin_id']): ?>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <?php else: ?>
                        <em>Current Session</em>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
