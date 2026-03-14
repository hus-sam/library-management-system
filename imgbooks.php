<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Gallery</title>
    <style>
        body { background-color: #0f172a; color: white; padding: 50px; font-family: sans-serif; }
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .book-card { background: #1e293b; border-radius: 15px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s; }
        .book-card:hover { transform: translateY(-10px); border-color: #fbbf24; }
        .book-card img { width: 100%; height: 250px; object-fit: cover; }
        .book-info { padding: 20px; }
        .book-info h3 { margin: 0 0 10px 0; color: #fbbf24; font-size: 1.1rem; }
        .book-info p { color: #94a3b8; font-size: 0.85rem; line-height: 1.5; height: 60px; overflow: hidden; }
        .btn-back { background: #334155; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-bottom: 30px; display: inline-block; }
    </style>
</head>
<body>
    <a href="admin_page.php" class="btn-back">← Back to Dashboard</a>
    <h1 style="margin-bottom: 40px; font-size: 2.5rem;">Visual Library Explorer</h1>

    <div class="gallery-grid">
        <div class="book-card">
            <img src="img/11.jpg" alt="Book">
            <div class="book-info">
                <h3>To Kill a Mockingbird</h3>
                <p>A classic novel about justice, racism, and childhood in the southern United States.</p>
            </div>
        </div>
        <div class="book-card">
            <img src="img/14.webp" alt="Book">
            <div class="book-info">
                <h3>1984 - George Orwell</h3>
                <p>A dystopian social science fiction novel and cautionary tale about totalitarianism.</p>
            </div>
        </div>
        </div>
</body>
</html>