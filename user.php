<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; color: white; padding: 40px; }
        .table-container {
            background: rgba(30, 41, 59, 0.5);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        h1 { color: #38bdf8; font-weight: bold; margin-bottom: 30px; }
        .table { color: white !important; }
        .table thead { background: rgba(56, 189, 248, 0.1); }
        .table th { color: #38bdf8; border: none; }
        .table td { vertical-align: middle; border-color: rgba(255,255,255,0.05); }
        .btn-add { background: #38bdf8; color: black; font-weight: bold; border-radius: 8px; padding: 10px 20px; text-decoration: none; float: right; }
        .btn-add:hover { background: #a855f7; color: white; }
        .action-link { padding: 5px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; }
        .edit-link { background: rgba(56, 189, 248, 0.2); color: #38bdf8; }
        .delete-link { background: rgba(244, 63, 94, 0.2); color: #f43f5e; margin-left: 5px; }
    </style>
</head>
<body>
    <div class="container table-container">
        <a href="adduser.php?id=0" class="btn-add">+ Add User</a>
        <h1>User Directory</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("library.php");
                $sql="SELECT * FROM `user`";
                $result= mysqli_query($conn,$sql);
                while( $row=mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>#{$row['snum']}</td>
                        <td><strong>{$row['sname']}</strong></td>
                        <td style='color:#94a3b8'>{$row['Email']}</td>
                        <td>@{$row['uname']}</td>
                        <td>
                            <a href='editu.php?id={$row["snum"]}' class='action-link edit-link'>Edit</a>
                            <a href='Deleteu.php?id={$row["snum"]}' class='action-link delete-link'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <form action="admin_page.php" class="mt-4">
            <button type="submit" class="btn btn-outline-secondary">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>