<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get book ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM book WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $book = mysqli_fetch_assoc($result);
} else {
    die("Book not found!");
}
?>
<!DOCTYPE html>
<html lang="ml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['name']; ?> - Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f8e9;
            padding: 20px;
            position: relative;
        }
        .book-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            position: relative;
        }
        .book-container img {
            max-width: 200px;
            float: left;
            margin-right: 20px;
            border-radius: 8px;
        }
        h2 {
            color: #2e7d32;
        }
        .meta {
            margin: 10px 0;
            color: #555;
        }
        .order-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #2e7d32;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .order-btn:hover {
            background: #1b5e20;
        }
        /* Go back button */
        .back-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            color: #2e7d32;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-btn:hover {
            color: #1b5e20;
        }
    </style>
</head>
<body>
    <div class="book-container">
        <!-- Go Back Icon -->
        <a href="javascript:history.back()" class="back-btn" title="Go Back">
            <i class="fas fa-arrow-left"></i>
        </a>

        <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['name']; ?>">
        <h2><?php echo $book['name']; ?></h2>
        <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
        <p class="meta"><i class="fas fa-building"></i> Publisher: <?php echo $book['publisher']; ?></p>
        <p class="meta"><i class="fas fa-calendar-alt"></i> Year: <?php echo $book['year_of_publish']; ?></p>
        <p class="meta"><i class="fas fa-tag"></i> Genre: <?php echo $book['genre']; ?></p>
        <p class="meta"><i class="fas fa-book"></i> Pages: <?php echo $book['number_of_pages']; ?></p>
        <p class="meta"><i class="fas fa-bookmark"></i> Binding: <?php echo $book['binding']; ?></p>
        <p><strong>Description:</strong> <?php echo $book['description']; ?></p>

        <!-- Price button that links to order.php -->
        <a href="order.php?id=<?php echo $book['id']; ?>" class="order-btn">
            ₹<?php echo $book['price']; ?> - Order Now
        </a>
    </div>
</body>
</html>
