<?php
session_start();
include("library.php");

// 1. Handle Quick Add from URL
if (isset($_GET['quick_add'])) {
    
    // Safety check: Ensure user is logged in
    if (!isset($_SESSION['snum'])) {
        die("Error: Please login first to borrow books.");
    }

    $snum = $_SESSION['snum']; 
    $user_name = $_SESSION['sname'];
    
    // Receive book name safely
    $book_name = isset($_GET['book_name']) ? mysqli_real_escape_string($conn, $_GET['book_name']) : 'Unknown Book';
    
    $request_date = date('Y-m-d'); 
    $request_id = rand(10000, 99999); 

    // SQL Query: Removed 'bnumber' from the list to fix your error
    $sql = "INSERT INTO `metaphor1` (`mnumber`, `snum`, `msname`, `mbname`, `mtime`) 
            VALUES ('$request_id', '$snum', '$user_name', '$book_name', '$request_date')";
    
    if (mysqli_query($conn, $sql)) {
        header("location: Metaphor.php?status=success");
        exit();
    } else {
        // This will help catch any other structural errors
        die("Database Error: " . mysqli_error($conn));
    }
}

// 2. Handle Manual Form Submission
$d = date('Y-m-d');
if(isset($_POST["b1"])){
    if (!isset($_SESSION['snum'])) { die("Access Denied: Please login."); }

    $mnum = mysqli_real_escape_string($conn, $_POST["mnumber"]);
    $snum = $_SESSION['snum'];
    $sname = mysqli_real_escape_string($conn, $_POST["msname"]);
    $bname = mysqli_real_escape_string($conn, $_POST["mbname"]);
    $mdate = mysqli_real_escape_string($conn, $_POST["mtime"]);

    // SQL Query: Removed 'bnumber' here as well
    $sql = "INSERT INTO `metaphor1` (`mnumber`, `snum`, `msname`, `mbname`, `mtime`) 
            VALUES ('$mnum', '$snum', '$sname', '$bname', '$mdate');";
            
    if(mysqli_query($conn , $sql)) { 
        header("location: Metaphor.php"); 
        exit(); 
    } else {
        die("Form Error: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Borrow Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; display: flex; align-items: center; justify-content: center; min-height: 100vh; font-family: 'Segoe UI', sans-serif; }
        .card-manual { background: rgba(30, 41, 59, 0.85); padding: 30px; border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.2); width: 100%; max-width: 400px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        input { width: 100%; padding: 12px; margin: 10px 0; background: #1e293b; border: 1px solid #334155; border-radius: 10px; color: white; }
        .btn-submit { background: linear-gradient(135deg, #38bdf8 0%, #a855f7 100%); border: none; color: white; font-weight: 600; padding: 12px; width: 100%; border-radius: 10px; margin-top: 10px; transition: 0.3s; }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="card-manual">
        <h3 class="text-center mb-4">New Request</h3>
        <form method="post">
            <label class="text-info small">Request ID (Auto)</label>
            <input type="text" name="mnumber" value="<?php echo rand(1000, 9999); ?>" readonly>
            
            <label class="text-info small">Borrower Name</label>
            <input type="text" name="msname" value="<?php echo $_SESSION['sname'] ?? ''; ?>" required>
            
            <label class="text-info small">Book Title</label>
            <input type="text" name="mbname" placeholder="Enter Book Name" required>
            
            <label class="text-info small">Date</label>
            <input type="date" name="mtime" value="<?php echo $d; ?>">
            
            <button type="submit" name="b1" class="btn-submit">CONFIRM REQUEST</button>
        </form>
    </div>
</body>
</html>