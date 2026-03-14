<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Delete</title>
    <style>
        body { background-color: #0f172a; color: white; font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .delete-box { background: rgba(30, 41, 59, 0.8); border: 1px solid #f43f5e; padding: 40px; border-radius: 20px; text-align: center; max-width: 400px; }
        h2 { color: #f43f5e; margin-bottom: 10px; }
        p { color: #94a3b8; margin-bottom: 30px; }
        .btn-confirm { background: #f43f5e; color: white; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%; }
        .btn-cancel { display: block; margin-top: 15px; color: white; text-decoration: none; font-size: 0.9rem; opacity: 0.7; }
    </style>
</head>
<body>
    <div class="delete-box">
        <?php 
        $id=$_GET["id"]; 
        include("library.php");   
        $sql="SELECT * FROM `user` WHERE `snum`=$id";
        $result = mysqli_query($conn , $sql); 
        $row= mysqli_fetch_assoc($result);  

        if(isset($_POST["b1"])){
            $v=$row["snum"]; 
            $sql="DELETE FROM user WHERE `user`.`snum` = $v;";
            if(mysqli_query($conn , $sql)) { header("location: user.php"); exit(); }
        }
        ?>

        <h2>Delete User?</h2>
        <p>You are about to delete user: <br><strong><?php echo $row['sname']; ?></strong><br>This action cannot be undone.</p>
        
        <form method="post">
            <input type="submit" name="b1" value="YES, DELETE" class="btn-confirm">
        </form>
        <a href="user.php" class="btn-cancel">Cancel and go back</a>
    </div>
</body>
</html>