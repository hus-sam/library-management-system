<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <style>
        :root {
            --bg-dark: #0f172a;
            --neon-blue: #38bdf8;
            --neon-purple: #a855f7;
            --glass: rgba(30, 41, 59, 0.7);
        }
        body {
            background-color: var(--bg-dark);
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-card {
            background: var(--glass);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            background: linear-gradient(to right, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.8rem;
            margin-bottom: 30px;
        }
        label { color: #94a3b8; font-size: 0.85rem; display: block; margin-bottom: 5px; }
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background: rgba(0,0,0,0.2);
            border: 1px solid #334155;
            border-radius: 10px;
            color: white;
            outline: none;
        }
        input[type="submit"] {
            background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .back-link { display: block; text-align: center; margin-top: 15px; color: var(--neon-blue); text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="form-card">
        <?php
        $a=0; $b=""; $c=""; $d=""; $e=""; $f="";
        if(isset($_POST["b1"])){
            $a=$_POST["snum"]; $b=$_POST["sname"]; $c=$_POST["simg"];
            $d=$_POST["Email"]; $e=$_POST["spass"]; $f=$_POST["uname"];
            include("library.php");
            $sql="INSERT INTO `user` (`snum`, `sname`, `simg`, `Email`, `spass`, `uname`) VALUES ('$a', '$b', '$c', '$d', '$e', '$f');";
            $result= mysqli_query($conn , $sql);
            if($result) { header("location: user.php"); exit(); }
        }
        ?>
        
        <h1>Add New User</h1>
        <form method="post">
            <label>User Number (ID)</label>
            <input type="text" name="snum" placeholder="e.g. 101" required>
            <label>Full Name</label>
            <input type="text" name="sname" placeholder="Enter name">
            <label>Profile Image Name</label>
            <input type="text" name="simg" placeholder="image.jpg">
            <label>Email Address</label>
            <input type="text" name="Email" placeholder="email@example.com">
            <label>Password</label>
            <input type="text" name="spass" placeholder="Set password">
            <label>Username</label>
            <input type="text" name="uname" placeholder="Choose username">
            
            <input type="submit" name="b1" value="SAVE USER">
        </form>
        <a href="user.php" class="back-link">← Back to Users List</a>
    </div>
</body>
</html>