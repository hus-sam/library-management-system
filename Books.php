<?php
session_start();
include("library.php");
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; padding: 30px; }
        .glass { background: rgba(255,255,255,0.05); padding: 25px; border-radius: 15px; }
        .table { color: white !important; }
    </style>
</head>
<body>
    <div class="container glass">
        <div class="d-flex justify-content-between mb-4">
            <h2>Library Collection</h2>
            <?php if($role == 'admin') echo '<a href="addbooks.php" class="btn btn-info">+ Add Book</a>'; ?>
        </div>
        <table class="table">
            <thead>
                <tr><th>Title</th><th>Author</th><th>Stock</th><th>Img</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM books";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>
                        <td>{$row['bname']}</td>
                        <td>{$row['bwriter']}</td>
                        <td>{$row['bavailable']}</td>
                        <td><img src='".$row["bimg"]."'width='70' height='70'></td>
                        <td>";
                    if($role == 'admin') {
                        echo "<a href='editb.php?id={$row['bnumber']}' class='btn btn-sm btn-success me-2'>Edit</a>";
                        echo "<a href='Deleteb.php?id={$row['bnumber']}' class='btn btn-sm btn-danger'>Delete</a>";
                    } else {
                        echo "<a href='addrequest.php?quick_add=1&book_name=".urlencode($row['bname'])."' class='btn btn-sm btn-primary'>Quick Request</a>";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="<?php echo ($role=='admin')?'admin_page.php':'user_page.php'; ?>" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
</body>
</html>