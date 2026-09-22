<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; margin: 0; }
        .sidebar { width: 250px; background: #222; color: #fff; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar h2 { text-align: center; padding: 20px 0; margin: 0; background: #111; color: #ea580c; }
        .sidebar a { display: block; color: #ccc; text-decoration: none; padding: 15px 20px; border-bottom: 1px solid #333; }
        .sidebar a:hover, .sidebar a.active { background: #333; color: #fff; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        h1 { margin-top: 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: left; }
        th { background-color: #f9f9f9; }
        .btn { display: inline-block; padding: 8px 15px; background: #ea580c; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn:hover { background: #c2410c; }
        .btn-danger { background: #dc2626; }
        .btn-danger:hover { background: #b91c1c; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"], textarea, input[type="file"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .thumbnail { max-width: 100px; max-height: 100px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="index.php">Dashboard</a>
        <a href="partners.php">Manage Partners</a>
        <a href="settings.php">Hero Section Settings</a>
        <a href="users.php">Manage Admins</a>
        <a href="logout.php">Logout</a>
        <a href="../index.php" target="_blank" style="background:#ea580c; color:#fff; text-align:center; border:none; margin-top:20px;">View Live Site &rarr;</a>
    </div>
    <div class="main-content">
