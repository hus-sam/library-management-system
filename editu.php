<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Profile</title>
    <style>
        body { background-color: #0f172a; color: white; font-family: sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .edit-card { background: rgba(30, 41, 59, 0.7); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); width: 100%; max-width: 500px; }
        h1 { color: #38bdf8; text-align: center; margin-bottom: 25px; }
        label { color: #94a3b8; font-size: 0.8rem; }
        input[type="text"] { width: 100%; padding: 12px; margin: 8px 0 18px 0; background: rgba(0,0,0,0.3); border: 1px solid #334155; border-radius: 8px; color: white; }
        .btn-update { background: #38bdf8; border: none; padding: 12px; width: 100%; border-radius: 8px; font-weight: bold; cursor: pointer; color: #0f172a; }
        .btn-update:hover { background: #a855f7; color: white; }
    </style>
</head>
<body>
    <div class="edit-card">
        <?php
        $id=$_GET["id"]; 
        include("library.php");   
        $sql="SELECT * FROM `user` WHERE `snum`=$id";
        $result = mysqli_query($conn , $sql); 
        $row= mysqli_fetch_assoc($result);  

        if(isset($_POST["b1"])){
            $a=$_POST["snum"]; $b=$_POST["sname"]; $c=$_POST["simg"];
            $d=$_POST["Email"]; $e=$_POST["spass"]; $f=$_POST["uname"];
            $sql="UPDATE `user` SET `simg` = '$c', `Email` = '$d', `spass` = '$e', `uname` = '$f' WHERE `user`.`snum` = $a;";
            if(mysqli_query($conn , $sql)) { header("location: user.php"); exit(); }
        }
        ?>

        <h1>Edit User</h1>
        <form method="post">
            <label>User ID (Read Only)</label>
            <input type="text" name="snum" value="<?php echo $row['snum'] ?>" readonly style="opacity: 0.5;">
            
            <label>Full Name</label>
            <input type="text" name="sname" value="<?php echo $row['sname'] ?>">
            
            <label>Email</label>
            <input type="text" name="Email" value="<?php echo $row['Email'] ?>">
            
            <label>Username</label>
            <input type="text" name="uname" value="<?php echo $row['uname'] ?>">

            <label>Password</label>
            <input type="text" name="spass" value="<?php echo $row['spass'] ?>">

            <label>Image Reference</label>
            <input type="text" name="simg" value="<?php echo $row['simg'] ?>">

            <input type="submit" name="b1" value="UPDATE DATA" class="btn-update">
        </form>
    </div>
</body>
</html>