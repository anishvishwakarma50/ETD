<?php require_once __DIR__ . '/header.php'; ?>
<?php if ($action === 'edit' || $action === 'add'): ?>
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
<?php else: ?>
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
<?php endif; ?>
<?php require_once __DIR__ . '/footer.php'; ?>
