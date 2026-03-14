<?php
session_start();
include("library.php");


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: user_dashboard.php");
    exit();
}


$count_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"))['total'];
$count_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM user"))['total'];
$count_reqs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM metaphor1"))['total'];
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; font-family: 'Segoe UI', sans-serif; }
        .stat-card { background: rgba(30, 41, 59, 0.7); border: 1px solid #38bdf8; border-radius: 20px; padding: 30px; text-align: center; }
        .stat-card i { font-size: 40px; color: #38bdf8; }
        .stat-card h2 { font-size: 45px; font-weight: 800; }
        .admin-nav { background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.1); }
        .nav-btn { display: block; padding: 15px; color: white; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.1); transition: 0.3s; }
        .nav-btn:hover { background: #38bdf8; color: #0f172a; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>Admin <span class="text-info">Dashboard</span></h1>
            <span class="badge bg-danger">Full Access: <?php echo $_SESSION['sname']; ?></span>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4"><div class="stat-card"><i class="bi bi-book"></i><h2><?php echo $count_books; ?></h2><p>Books</p></div></div>
            <div class="col-md-4"><div class="stat-card"><i class="bi bi-people"></i><h2><?php echo $count_users; ?></h2><p>Users</p></div></div>
            <div class="col-md-4"><div class="stat-card"><i class="bi bi-send"></i><h2><?php echo $count_reqs; ?></h2><p>Requests</p></div></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 admin-nav">
                <h4 class="mb-4 text-info">System Management</h4>
                <a href="user.php" class="nav-btn"><i class="bi bi-person-gear"></i> Manage All Users</a>
                <a href="Books.php" class="nav-btn"><i class="bi bi-journal-text"></i> Inventory & Stock Control</a>
                <a href="Metaphor.php" class="nav-btn"><i class="bi bi-activity"></i> Monitor All Borrowing Activities</a>
                <a href="logout.php" class="nav-btn text-danger border-0"><i class="bi bi-power"></i> Sign Out</a>
            </div>
        </div>
    </div>
</body>
</html>