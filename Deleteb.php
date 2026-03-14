<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Confirmation</title>
    <style>
        body { background-color: #0f172a; color: white; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .delete-card { background: rgba(30, 41, 59, 0.8); border: 2px solid #f43f5e; padding: 40px; border-radius: 20px; text-align: center; max-width: 400px; box-shadow: 0 10px 30px rgba(244, 63, 94, 0.2); }
        .warning-icon { font-size: 50px; color: #f43f5e; margin-bottom: 10px; }
        h2 { color: #f43f5e; margin-top: 0; }
        p { color: #94a3b8; line-height: 1.6; }
        .confirm-btn { background: #f43f5e; color: white; border: none; padding: 12px 30px; border-radius: 10px; cursor: pointer; font-weight: bold; width: 100%; transition: 0.3s; margin-top: 20px; }
        .confirm-btn:hover { background: #be123c; transform: scale(1.02); }
        .cancel-btn { display: block; margin-top: 15px; color: white; text-decoration: none; font-size: 0.9rem; opacity: 0.6; }
    </style>
</head>
<body>
    <div class="delete-card">
        <?php 
        include("library.php");
        $id = $_GET["id"]; 
        $sql = "SELECT bname FROM `books` WHERE `bnumber`=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if(isset($_POST["confirm_delete"])){
            $del_sql = "DELETE FROM `books` WHERE `bnumber`=$id";
            if(mysqli_query($conn, $del_sql)) {
                header("location: Books.php");
                exit();
            }
        }
        ?>

        <div class="warning-icon">⚠️</div>
        <h2>Are you sure?</h2>
        <p>You are about to delete the book:<br><strong>"<?php echo $row['bname']; ?>"</strong><br>This action is permanent.</p>
        
        <form method="post">
            <input type="submit" name="confirm_delete" value="YES, DELETE IT" class="confirm-btn">
        </form>
        <a href="Books.php" class="cancel-btn">No, take me back</a>
    </div>
</body>
</html>