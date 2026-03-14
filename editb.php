<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book Details</title>
    <style>
        body { background-color: #0f172a; color: white; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .edit-card { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(15px); padding: 40px; border-radius: 25px; border: 1px solid rgba(255,255,255,0.1); width: 100%; max-width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        h1 { text-align: center; color: #fbbf24; margin-bottom: 25px; font-size: 1.5rem; }
        label { color: #94a3b8; font-size: 0.8rem; margin-top: 10px; display: block; }
        input[type="text"], input[type="number"] { width: 100%; padding: 12px; margin: 8px 0; background: rgba(0,0,0,0.3); border: 1px solid #334155; border-radius: 10px; color: white; outline: none; transition: 0.3s; }
        input:focus { border-color: #fbbf24; box-shadow: 0 0 10px rgba(251, 191, 36, 0.2); }
        .update-btn { background: linear-gradient(45deg, #a855f7, #fbbf24); border: none; padding: 14px; width: 100%; border-radius: 10px; color: white; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #94a3b8; text-decoration: none; font-size: 0.85rem; }
    </style>
</head>
<body>
    <div class="edit-card">
        <?php 
        include("library.php");
        $id = $_GET["id"]; 
        $sql = "SELECT * FROM `books` WHERE `bnumber`=$id";
        $result = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_assoc($result);  

        if(isset($_POST["update_btn"])){
            $v = $_POST["bnumber"];
            $a = $_POST["bname"];
            $b = $_POST["bwriter"];
            $c = $_POST["bavailable"];
            $d = $_POST["bimg"];

            $update_sql = "UPDATE `books` SET `bname`='$a', `bwriter`='$b', `bavailable`='$c', `bimg`='$d' WHERE `bnumber`=$v";
            if(mysqli_query($conn, $update_sql)) {
                header("location: Books.php");
                exit();
            } else { echo "<p style='color:red'>Error updating record</p>"; }
        }
        ?>

        <h1>Edit Book</h1>
        <form method="post">
            <label>Book ID (Locked)</label>
            <input type="text" name="bnumber" value="<?php echo $row['bnumber']; ?>" readonly style="opacity:0.6">
            <label>Title</label>
            <input type="text" name="bname" value="<?php echo $row['bname']; ?>">
            <label>Author</label>
            <input type="text" name="bwriter" value="<?php echo $row['bwriter']; ?>">
            <label>Available Quantity</label>
            <input type="number" name="bavailable" value="<?php echo $row['bavailable']; ?>">
            <label>Image URL</label>
            <input type="text" name="bimg" value="<?php echo $row['bimg']; ?>">

            <input type="submit" name="update_btn" value="CONFIRM CHANGES" class="update-btn">
        </form>
        <a href="Books.php" class="back-link">Cancel and go back</a>
    </div>
</body>
</html>