<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.html');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/all.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet">
    <style>
        body { background: #f6f5fd; }
        .dashboard-card { background: #fff; border-radius: 2rem; box-shadow: 0 30px 75px rgba(16, 23, 84, 0.12); padding: 4rem; margin: 5rem auto; max-width: 760px; }
        .dashboard-card h1 { font-size: 3rem; margin-bottom: 1rem; }
        .dashboard-card p { color: #6e6b83; font-size: 1.6rem; margin-bottom: 2rem; }
        .btn-2 { border-radius: 3rem 0 3rem 3rem; width: auto; height: 5rem; padding: 0 2.5rem; font-size: 1.7rem; }
    </style>
</head>
<body class="side-header">
    <div class="container">
        <div class="dashboard-card text-center">
            <h1>Selamat datang, <?= htmlentities($_SESSION['admin_username']) ?></h1>
            <p>Anda berhasil login ke area admin.</p>
            <a href="logout.php" class="btn-2">Logout</a>
        </div>
    </div>
</body>
</html>
