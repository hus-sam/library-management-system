<?php
session_start();
include("library.php");

if (isset($_POST['login_btn'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = $_POST['spass'];

    $sql = "SELECT * FROM `user` WHERE `uname` = '$uname'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['spass'])) {
            $_SESSION['snum']  = $row['snum'];
            $_SESSION['sname'] = $row['sname'];
            $_SESSION['role']  = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        } else {
            echo "<script>alert('كلمة المرور غير صحيحة');</script>";
        }
    } else {
        echo "<script>alert('المستخدم غير موجود');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* خلفية الصفحة */
        body { 
            background: #0f172a; 
            color: #ffffff; /* لون النص أبيض للصفحة */
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Inter', sans-serif; 
        }

        /* البطاقة */
        .card { 
            background: rgba(30, 41, 59, 0.8); 
            padding: 40px; 
            border-radius: 20px; 
            width: 100%; 
            max-width: 400px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
        }

        /* حقول الإدخال */
        .form-control { 
            background: #1e293b; 
            border: 1px solid #334155; 
            color: #ffffff !important; 
            margin-bottom: 20px; 
            padding: 12px; 
        }
        
       
        .form-control:focus { 
            background: #1e293b; 
            color: #ffffff !important; 
            border-color: #38bdf8; 
            box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25); 
        }

       
        .form-control::placeholder {
            color: #94a3b8;
        }

      
        .btn-primary { 
            width: 100%; 
            background: linear-gradient(to right, #38bdf8, #818cf8); 
            border: none; 
            padding: 12px; 
            font-weight: bold; 
            margin-top: 10px; 
            color: white;
        }
        .btn-primary:hover { opacity: 0.9; }

     
        h2 { 
            color: #ffffff; 
            margin-bottom: 30px; 
            font-weight: 700; 
        }
        
        label {
            color: #ffffff !important;
            margin-bottom: 8px;
        }

        
        .register-link { 
            text-align: center; 
            margin-top: 20px; 
            font-size: 0.9rem; 
            color: #ffffff; 
        }
        .register-link a { 
            color: #38bdf8; 
            text-decoration: none; 
        }
        .register-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="text-center">Welcome</h2>
        <form method="POST">
            <label class="form-label">Username</label>
            <input type="text" name="uname" class="form-control" placeholder="Enter your username" required>
            
            <label class="form-label">Password</label>
            <input type="password" name="spass" class="form-control" placeholder="Enter your password" required>
            
            <button type="submit" name="login_btn" class="btn-primary rounded-3">LOGIN</button>
            
            <div class="register-link">
                Don't have an account? <a href="signup.php">Create Account</a>
            </div>
        </form>
    </div>
</body>
</html>