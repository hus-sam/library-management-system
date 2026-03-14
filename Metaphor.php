<?php
session_start();
include("library.php");

// 1. Security Check: Redirect to login if session is not set
if (!isset($_SESSION['role'])) { 
    header("Location: login.php"); 
    exit(); 
}

$role = $_SESSION['role'];
$snum = $_SESSION['snum'];

// 2. Smart Redirect Logic: Determine back page based on role
$back_page = ($role == 'admin') ? "admin_page.php" : "user_page.php";

// 3. Optimized SQL Query: LEFT JOIN ensures data is shown even if book details are missing
$sql = "SELECT m.mnumber, u.sname, m.mbname, m.mtime 
        FROM metaphor1 m
        LEFT JOIN user u ON m.snum = u.snum";

// 4. Permission Logic: Admins see all requests, Users see only their own
if ($role != 'admin') {
    $sql .= " WHERE m.snum = '$snum'";
}

$sql .= " ORDER BY m.mtime DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests Management | Library System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background: #0f172a; 
            color: #f8fafc; 
            font-family: 'Inter', sans-serif; 
            padding-top: 60px; 
            padding-bottom: 60px;
        }
        .main-card { 
            background: rgba(30, 41, 59, 0.7); 
            backdrop-filter: blur(10px);
            padding: 40px; 
            border-radius: 24px; 
            border: 1px solid rgba(56, 189, 248, 0.2); 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
        }
        h2 { 
            font-weight: 800; 
            letter-spacing: -1px;
            background: linear-gradient(to right, #38bdf8, #818cf8); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
        }
        .table { 
            --bs-table-bg: transparent; 
            color: #e2e8f0; 
            border-color: #334155; 
            margin-top: 20px;
        }
        .table thead th { 
            border-bottom: 2px solid #38bdf8; 
            color: #38bdf8; 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            letter-spacing: 0.05em;
            padding: 15px;
        }
        .table tbody td { 
            padding: 15px; 
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
        }
        .btn-back {
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            padding: 10px 20px;
        }
        .btn-back:hover {
            background: #38bdf8;
            color: #0f172a;
            transform: translateY(-2px);
        }
        .btn-delete { 
            background: #ef4444; 
            border: none; 
            color: white; 
            font-weight: 600; 
            padding: 8px 18px; 
            border-radius: 10px; 
            transition: 0.3s; 
            text-decoration: none; 
            font-size: 0.85rem; 
        }
        .btn-delete:hover { 
            background: #dc2626; 
            box-shadow: 0 4px 14px 0 rgba(239, 68, 68, 0.39);
        }
        .request-id { color: #94a3b8; font-family: monospace; font-size: 0.9rem; }
        .book-title { color: #f8fafc; font-weight: 600; }
        .empty-state { color: #64748b; font-style: italic; }
    </style>
</head>
<body>

<div class="container">
    <div class="main-card">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2>Requests List</h2>
                <p class="text-secondary mb-0">Manage all library borrowing activities</p>
            </div>
            <a href="<?php echo $back_page; ?>" class="btn-back">
                &larr; Back to Dashboard
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Book Title</th>
                        <th>Date Requested</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="request-id">#<?php echo $row['mnumber']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="fw-medium"><?php echo $row['sname'] ?? 'Unknown User'; ?></span>
                                </div>
                            </td>
                            <td class="book-title"><?php echo $row['mbname']; ?></td>
                            <td>
                                <span class="text-secondary small"><?php echo $row['mtime']; ?></span>
                            </td>
                            <td class="text-center">
                                <a href="Deleter.php?id=<?php echo $row['mnumber']; ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('Are you sure you want to remove this record?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 empty-state">
                                No records found in the database.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>