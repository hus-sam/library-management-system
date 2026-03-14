<?php
include("library.php");
$id = $_GET["id"];
$sql = "SELECT * FROM `metaphor1` WHERE `mnumber`=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["update_req"])){
    $a = $_POST["mnumber"]; $b = $_POST["msname"]; $c = $_POST["mbname"]; $d = $_POST["mtime"];
    $update_sql = "UPDATE `metaphor1` SET `msname`='$b', `mbname`='$c', `mtime`='$d' WHERE `mnumber`=$a";
    if(mysqli_query($conn, $update_sql)) { header("location: Metaphor.php"); }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; }
        .edit-card { background: rgba(30, 41, 59, 0.7); padding: 40px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); width: 100%; max-width: 450px; backdrop-filter: blur(10px); }
        h2 { color: #38bdf8; font-weight: bold; margin-bottom: 25px; text-align: center; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; background: rgba(0,0,0,0.2); border: 1px solid #334155; border-radius: 10px; color: white; }
        .btn-save { background: #38bdf8; color: #0f172a; border: none; font-weight: bold; width: 100%; padding: 12px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="edit-card">
        <h2>Edit Request #<?php echo $row['mnumber']; ?></h2>
        <form method="post">
            <input type="hidden" name="mnumber" value="<?php echo $row['mnumber']; ?>">
            <label class="text-muted small">User Name</label>
            <input type="text" name="msname" value="<?php echo $row['msname']; ?>">
            <label class="text-muted small">Book Name</label>
            <input type="text" name="mbname" value="<?php echo $row['mbname']; ?>">
            <label class="text-muted small">Date</label>
            <input type="date" name="mtime" value="<?php echo $row['mtime']; ?>">
            <button type="submit" name="update_req" class="btn-save">UPDATE CHANGES</button>
            <a href="Metaphor.php" class="d-block text-center mt-3 text-secondary text-decoration-none">Cancel</a>
        </form>
    </div>
</body>
</html>