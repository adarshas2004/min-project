<!DOCTYPE html>
<html lang="ml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malayalam Books Collection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --accent: #ff5722;
            --text-dark: #263238;
            --text-light: #78909c;
            --background: #f1f8e9;
            --card-bg: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            position: relative;
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        header h1 { font-size: 2.5rem; margin-bottom: 10px; }

        header p { font-size: 1.2rem; max-width: 800px; margin: 0 auto; opacity: 0.9; }

        /* ✅ Go Back Button - Top Right */
        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--primary-dark);
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: background 0.3s ease;
            z-index: 1000;
        }

        .back-btn:hover {
            background: var(--primary-light);
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 5px 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .search-box i { color: var(--text-light); font-size: 1.2rem; margin-right: 10px; }

        .search-box input {
            width: 100%;
            padding: 15px 0;
            border: none;
            outline: none;
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .search-box input::placeholder { color: var(--text-light); }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 20px;
        }

        @media (max-width: 900px) { .books-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px) { .books-grid { grid-template-columns: 1fr; } }

        .book-card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .book-image { height: 280px; overflow: hidden; position: relative; }

        .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .book-card:hover .book-image img { transform: scale(1.05); }

        .book-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .book-details {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .book-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .book-author { color: var(--text-light); font-size: 1rem; margin-bottom: 15px; }

        .book-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .book-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.4rem;
            margin-top: 15px;
            text-align: right;
        }

        .view-btn {
            display: inline-block;
            padding: 12px 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            transition: background 0.3s ease;
            margin-top: 15px;
        }

        .view-btn:hover { background: var(--primary-dark); }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .empty-state i { font-size: 3rem; color: var(--text-light); margin-bottom: 20px; }

        .empty-state p { font-size: 1.2rem; color: var(--text-light); margin-bottom: 20px; }

        footer {
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
            color: var(--text-light);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: none;
        }

        .no-results i { font-size: 3rem; color: var(--text-light); margin-bottom: 20px; }

        .no-results p { font-size: 1.2rem; color: var(--text-light); margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <button class="back-btn" onclick="history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1><i class="fas fa-book"></i> മലയാളം പുസ്തകങ്ങൾ</h1>
            <p>Discover our collection of Malayalam literature - novels, poetry, and more</p>
        </header>

        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search for books by title, author, or genre..." onkeyup="filterBooks()">
            </div>
        </div>

        <div class="books-grid">
            <?php
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "books";

            $conn = mysqli_connect($host, $user, $password, $dbname);
            if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

            $query = "SELECT * FROM book WHERE language = 'Malayalam'";
            $result = mysqli_query($conn, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="book-card" data-title="<?php echo strtolower($row['name']); ?>" 
                     data-author="<?php echo strtolower($row['author']); ?>" 
                     data-genre="<?php echo strtolower($row['genre']); ?>">
                    <div class="book-image">
                        <span class="book-badge">Malayalam</span>
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>
                    <div class="book-details">
                        <h3 class="book-title"><?php echo $row['name']; ?></h3>
                        <p class="book-author">by <?php echo $row['author']; ?></p>
                        <div class="book-meta">
                            <span><i class="fas fa-calendar-alt"></i> <?php echo $row['year_of_publish']; ?></span>
                            <span><i class="fas fa-tag"></i> <?php echo $row['genre']; ?></span>
                        </div>
                        <div class="book-meta">
                            <span><i class="fas fa-file"></i> <?php echo $row['number_of_pages']; ?> pages</span>
                            <span><i class="fas fa-bookmark"></i> <?php echo $row['binding']; ?></span>
                        </div>
                        <div class="book-price">₹<?php echo $row['price']; ?></div>
                        <a href="details.php?id=<?php echo $row['id']; ?>" class="view-btn">
                            <i class="fas fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <p>No Malayalam books found in the collection.</p>
                </div>
            <?php
            }
            mysqli_close($conn);
            ?>
            <div class="no-results" id="noResults">
                <i class="fas fa-search"></i>
                <p>No books found matching your search.</p>
                <p>Try different keywords or browse all books.</p>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2023 Malayalam Books Collection. All rights reserved.</p>
    </footer>

    <script>
        function filterBooks() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const books = document.querySelectorAll('.book-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;
            books.forEach(book => {
                const title = book.getAttribute('data-title');
                const author = book.getAttribute('data-author');
                const genre = book.getAttribute('data-genre');
                if (title.includes(searchText) || author.includes(searchText) || genre.includes(searchText)) {
                    book.style.display = 'flex';
                    visibleCount++;
                } else {
                    book.style.display = 'none';
                }
            });
            if (visibleCount === 0 && searchText.length > 0) noResults.style.display = 'block';
            else noResults.style.display = 'none';
            if (searchText.length === 0) {
                books.forEach(book => { book.style.display = 'flex'; });
                noResults.style.display = 'none';
            }
        }
    </script>
</body>
</html>
