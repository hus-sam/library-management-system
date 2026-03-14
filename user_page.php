<?php
session_start();
include("library.php");

if (!isset($_SESSION['sname'])) { header("Location: login.php"); exit(); }

$user_name = $_SESSION['sname'];
$my_reqs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM metaphor1 WHERE msname = '$user_name'"))['total'];
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>My Account | Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .user-panel { background: rgba(30, 41, 59, 0.8); border-radius: 30px; padding: 50px; border: 1px solid rgba(56, 189, 248, 0.2); width: 100%; max-width: 500px; text-align: center; }
        .btn-action { padding: 15px; border-radius: 12px; font-weight: bold; text-decoration: none; display: block; margin-bottom: 15px; transition: 0.3s; }
        .btn-books { background: #38bdf8; color: #0f172a; }
        .btn-reqs { background: transparent; color: #38bdf8; border: 1px solid #38bdf8; }
        .btn-action:hover { transform: scale(1.03); opacity: 0.9; }
    </style>
</head>
<body>
    <div class="user-panel">
        <i class="bi bi-person-circle text-info" style="font-size: 80px;"></i>
        <h2 class="mt-3">Welcome, <?php echo $user_name; ?></h2>
        <p class="text-muted">You have borrowed <b><?php echo $my_reqs; ?></b> books so far.</p>
        
        <div class="mt-5">
            <a href="Books.php" class="btn-action btn-books"><i class="bi bi-book"></i> Browse Library & Request</a>
            <a href="Metaphor.php" class="btn-action btn-reqs"><i class="bi bi-clock-history"></i> My Requests Status</a>
            <a href="logout.php" class="text-secondary d-block mt-4 text-decoration-none">Logout</a>
        </div>
    </div>
</body>
</html>