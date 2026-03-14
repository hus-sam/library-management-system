<?php
include("library.php");

$error_msg = "";
$success_msg = "";

// عند الضغط على زر التسجيل
if (isset($_POST['signup_btn'])) {
    
    // استقبال وتنظيف البيانات
    $name  = mysqli_real_escape_string($conn, $_POST['sname']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pass  = $_POST['spass'];

    // التحقق من أن اسم المستخدم غير مكرر
    $check_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `uname` = '$uname'");
    
    if (mysqli_num_rows($check_user) > 0) {
        $error_msg = "Username already exists! Please choose another.";
    } else {
        // تشفير كلمة المرور
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $role = "user"; 

        // معالجة الصورة
        $imageName = "default.jpg"; // صورة افتراضية في حال لم يرفع المستخدم صورة
        if (!empty($_FILES['simg']['name'])) {
            $imageName = time() . "_" . $_FILES['simg']['name']; // إضافة وقت لاسم الصورة لمنع التشابه
            $tmpName = $_FILES['simg']['tmp_name'];
            move_uploaded_file($tmpName, "img/" . $imageName);
        }

        // الإدخال في قاعدة البيانات
        $sql = "INSERT INTO `user` (`sname`, `simg`, `Email`, `spass`, `uname`, `role`) 
                VALUES ('$name', '$imageName', '$email', '$hashed_pass', '$uname', '$role')";

        if (mysqli_query($conn, $sql)) {
            // توجيه لصفحة الدخول مع رسالة نجاح
            header("Location: login.php?signup=success");
            exit();
        } else {
            $error_msg = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account | Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0f172a; color: white; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Inter', sans-serif; padding: 20px; }
        .card { background: rgba(30, 41, 59, 0.8); padding: 40px; border-radius: 20px; width: 100%; max-width: 500px; border: 1px solid rgba(56, 189, 248, 0.2); }
        .form-control { background: #1e293b; border: 1px solid #334155; color: white; margin-bottom: 15px; }
        .form-control:focus { background: #1e293b; color: white; border-color: #38bdf8; box-shadow: none; }
        .btn-register { width: 100%; background: #38bdf8; border: none; padding: 12px; font-weight: bold; color: #0f172a; margin-top: 10px; }
        .btn-register:hover { background: #7dd3fc; }
        h2 { color: #38bdf8; margin-bottom: 20px; font-weight: 700; text-align: center; }
        .login-link { text-align: center; margin-top: 20px; font-size: 0.9rem; }
        .login-link a { color: #38bdf8; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Create Account</h2>
        
        <?php if($error_msg): ?>
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="small text-secondary">Full Name</label>
                <input type="text" name="sname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="small text-secondary">Username</label>
                <input type="text" name="uname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="small text-secondary">Email Address</label>
                <input type="email" name="Email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="small text-secondary">Password</label>
                <input type="password" name="spass" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="small text-secondary">Profile Picture</label>
                <input type="file" name="simg" class="form-control">
            </div>

            <button type="submit" name="signup_btn" class="btn-register rounded-3">Sign Up</button>
            
            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>