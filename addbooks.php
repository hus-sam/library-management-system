<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <style>
        :root {
            --bg-dark: #0f172a;
            --neon-gold: #fbbf24;
            --neon-purple: #a855f7;
            --glass: rgba(30, 41, 59, 0.7);
        }

        body {
            background-color: var(--bg-dark);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
        }

        .add-card {
            background: var(--glass);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 25px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            background: linear-gradient(to right, var(--neon-gold), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: 800;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 0.85rem;
            padding-left: 5px;
        }

        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid #334155;
            border-radius: 12px;
            color: white;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--neon-gold);
            box-shadow: 0 0 15px rgba(251, 191, 36, 0.2);
            background: rgba(0, 0, 0, 0.4);
        }

        .btn-submit {
            background: linear-gradient(45deg, var(--neon-purple), var(--neon-gold));
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 12px;
            color: #0f172a;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(168, 85, 247, 0.3);
            filter: brightness(1.1);
        }

        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .back-btn:hover {
            color: var(--neon-gold);
        }
    </style>
</head>
<body>

    <div class="add-card">
        <?php
        if(isset($_POST["b1"])){
            $v=$_POST["bnumber"];
            $a=$_POST["bname"];
            $b=$_POST["bwriter"];
            $c=$_POST["bavailable"];
            $d=$_POST["bimg"];

            include("library.php");
            
            $a = mysqli_real_escape_string($conn, $a);
            $b = mysqli_real_escape_string($conn, $b);
            
            $sql="INSERT INTO `books` (`bnumber`, `bname`, `bwriter`, `bavailable`, `bimg`) VALUES ('$v', '$a', '$b', '$c', '$d');";
            
            if(mysqli_query($conn , $sql)) {
                echo "<p style='color:#4ade80; text-align:center;'>✔️ Book added successfully!</p>";
                echo "<script>setTimeout(()=> {window.location.href='Books.php';}, 1500);</script>";
            } else {
                echo "<p style='color:#f43f5e; text-align:center;'>❌ Error: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>

        <h1>Add New Masterpiece</h1>
        
        <form method="post">
            <div class="input-group">
                <label>Book ID / Number</label>
                <input type="text" name="bnumber" placeholder="e.g. 5001" required>
            </div>

            <div class="input-group">
                <label>Book Title</label>
                <input type="text" name="bname" placeholder="Enter book title" required>
            </div>

            <div class="input-group">
                <label>Author Name</label>
                <input type="text" name="bwriter" placeholder="Author's name">
            </div>

            <div class="input-group">
                <label>Quantity Available</label>
                <input type="number" name="bavailable" placeholder="0" min="0">
            </div>

            <div class="input-group">
                <label>Book Cover Image URL</label>
                <input type="text" name="bimg" placeholder="img/book_cover.jpg">
            </div>

            <input type="submit" name="b1" value="REGISTER BOOK" class="btn-submit">
        </form>

        <a href="Books.php" class="back-btn">← Back to Library</a>
    </div>

</body>
</html>