<?php
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
}
session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/db.php';

$app = new Leaf\App;

// Frontend Routes
$app->get('/', function() {
    global $pdo;
    require __DIR__ . '/views/home.php';
});

// Admin Auth Routes
$app->get('/admin/login', function() {
    if (isset($_SESSION['admin_id'])) {
        header("Location: /admin/dashboard");
        exit;
    }
    $error = '';
    require __DIR__ . '/views/admin/login.php';
});

$app->post('/admin/login', function() use ($pdo) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header("Location: /admin/dashboard");
        exit;
    } else {
        $error = 'Invalid username or password';
        require __DIR__ . '/views/admin/login.php';
    }
});

$app->get('/admin/logout', function() {
    session_destroy();
    header("Location: /admin/login");
    exit;
});

function check_admin_auth() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /admin/login");
        exit;
    }
}

// Admin Protected Routes
$app->group('/admin', function() use ($app, $pdo) {

    $app->get('/dashboard', function() {
        check_admin_auth();
        require __DIR__ . '/views/admin/dashboard.php';
    });

    // Partners
    $app->get('/partners', function() use ($pdo) {
        check_admin_auth();
        $msg = '';
        $msg_type = '';
        
        // Handle Deletion
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            $pdo->prepare("DELETE FROM partners WHERE id = ?")->execute([$id]);
            header("Location: /admin/partners?msg=deleted");
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
        } else {
            $partners = $pdo->query("SELECT * FROM partners ORDER BY display_order ASC, id ASC")->fetchAll();
        }
        
        require __DIR__ . '/views/admin/partners.php';
    });

    $app->post('/partners', function() use ($pdo) {
        check_admin_auth();
        $upload_dir = __DIR__ . '/uploads/';
        $id = $_POST['id'] ?? 0;
        $name = $_POST['name'] ?? '';
        $role = $_POST['role'] ?? '';
        $bio = $_POST['bio'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $email = $_POST['email'] ?? '';
        $display_order = (int)($_POST['display_order'] ?? 0);
        
        $image_path = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $filename = time() . '_' . preg_replace("/[^a-zA-Z0-9\.]/", "", basename($_FILES['image']['name']));
            if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                $image_path = 'uploads/' . $filename;
            }
        }
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE partners SET name=?, role=?, bio=?, image=?, linkedin=?, email=?, display_order=? WHERE id=?");
            $stmt->execute([$name, $role, $bio, $image_path, $linkedin, $email, $display_order, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO partners (name, role, bio, image, linkedin, email, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $role, $bio, $image_path, $linkedin, $email, $display_order]);
        }
        
        header("Location: /admin/partners?msg=saved");
        exit;
    });

    // Settings
    $app->get('/settings', function() use ($pdo) {
        check_admin_auth();
        $msg = '';
        $msg_type = '';
        $settings = $pdo->query("SELECT key, value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
        require __DIR__ . '/views/admin/settings.php';
    });

    $app->post('/settings', function() use ($pdo) {
        check_admin_auth();
        $upload_dir = __DIR__ . '/uploads/';
        
        $uploadVideo = function($fileKey, $settingKey) use ($pdo, $upload_dir) {
            if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES[$fileKey]['tmp_name'];
                $name = basename($_FILES[$fileKey]['name']);
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
        };

        $uploadedAny = false;
        if ($uploadVideo('portrait_video', 'hero_video_portrait')) $uploadedAny = true;
        if ($uploadVideo('landscape_video', 'hero_video_landscape')) $uploadedAny = true;
        
        if ($uploadedAny) {
            $msg = "Videos updated successfully!";
            $msg_type = "success";
        } else {
            $msg = "No valid video files uploaded.";
            $msg_type = "error";
        }
        
        $settings = $pdo->query("SELECT key, value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
        require __DIR__ . '/views/admin/settings.php';
    });

    // Users
    $app->get('/users', function() use ($pdo) {
        check_admin_auth();
        $msg = '';
        $msg_type = '';
        $users = $pdo->query("SELECT id, username, created_at FROM users ORDER BY created_at DESC")->fetchAll();
        require __DIR__ . '/views/admin/users.php';
    });

    $app->post('/users', function() use ($pdo) {
        check_admin_auth();
        $msg = '';
        $msg_type = '';
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
            if ($id != $_SESSION['admin_id']) {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$id]);
                $msg = "User deleted successfully.";
                $msg_type = "success";
            } else {
                $msg = "You cannot delete your own account while logged in.";
                $msg_type = "error";
            }
        }
        $users = $pdo->query("SELECT id, username, created_at FROM users ORDER BY created_at DESC")->fetchAll();
        require __DIR__ . '/views/admin/users.php';
    });
});

$app->run();
