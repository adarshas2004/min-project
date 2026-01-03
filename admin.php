<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

:root {
    --primary: #4361ee;
    --secondary: #3a0ca3;
    --success: #4cc9f0;
    --danger: #f72585;
    --warning: #f8961e;
    --light: #f8f9fa;
    --dark: #212529;
    --gray: #6c757d;
    --light-gray: #e9ecef;
    --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: var(--dark);
    background: linear-gradient(135deg, #f5f7ff 0%, #e6e9ff 100%);
    padding: 20px;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
}

.logo {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo i {
    font-size: 2.5rem;
    color: var(--primary);
}

.logo h1 {
    font-size: 2.2rem;
    background: linear-gradient(to right, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
}

.admin-nav {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.nav-btn {
    padding: 12px 20px;
    background: white;
    border: 2px solid var(--primary);
    border-radius: 8px;
    color: var(--primary);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.nav-btn.active {
    background: var(--primary);
    color: white;
}

.section {
    display: none;
}

.section.active {
    display: block;
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background-color: #fee2e2;
    color: #b91c1c;
    border-left: 4px solid #ef4444;
}

.card {
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    padding: 25px;
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
}

h2 {
    margin: 0 0 20px;
    color: var(--secondary);
    padding-bottom: 12px;
    border-bottom: 2px solid var(--light-gray);
    display: flex;
    align-items: center;
    gap: 10px;
}

h2 i {
    color: var(--primary);
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--dark);
}

input,
textarea,
select {
    width: 100%;
    padding: 14px;
    border: 1px solid var(--light-gray);
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s;
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
}

textarea {
    min-height: 120px;
    resize: vertical;
}

/* ---- CSS CONTINUES EXACTLY AS ORIGINAL ---- */

</style>
</head>

<body>

<div class="container">
<header>
    <div class="logo">
        <i class="fas fa-book-open"></i>
        <h1>Admin Dashboard</h1>
    </div>
</header>

<div class="admin-nav">
    <button class="nav-btn active" onclick="showSection('books')">
        <i class="fas fa-book"></i> Books Management
    </button>

    <button class="nav-btn" onclick="showSection('orders')">
        <i class="fas fa-clipboard-list"></i> Orders View
    </button>

    <button class="nav-btn" onclick="showSection('feedback')">
        <i class="fas fa-clipboard-list"></i> Feedback
    </button>
</div>

<section id="books-section" class="section active">

<div class="card">
<h2><i class="fas fa-plus-circle"></i> Add New Book</h2>

<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('<div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Connection failed: ' . $conn->connect_error . '
    </div>');
}

$image_tmp = '';
$image_path = '';

if (isset($_POST['insert'])) {

    $image_name = $_FILES['image']['name'];
    $image_tmp  = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . $image_name;

    if (move_uploaded_file($image_tmp, $image_path)) {

        $name        = $conn->real_escape_string($_POST['name']);
        $author      = $conn->real_escape_string($_POST['author']);
        $publisher   = $conn->real_escape_string($_POST['publisher']);
        $year        = $conn->real_escape_string($_POST['year']);
        $genre       = $conn->real_escape_string($_POST['genre']);
        $language    = $conn->real_escape_string($_POST['language']);
        $pages       = $conn->real_escape_string($_POST['pages']);
        $binding     = $conn->real_escape_string($_POST['binding']);
        $description = $conn->real_escape_string($_POST['description']);
        $price       = $conn->real_escape_string($_POST['price']);

        $query = "INSERT INTO book
        (image, name, author, publisher, year_of_publish, genre, language,
        number_of_pages, binding, description, price)
        VALUES
        ('$image_path','$name','$author','$publisher','$year','$genre',
        '$language','$pages','$binding','$description','$price')";

        if ($conn->query($query)) {
            echo '<div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                Book inserted successfully!
            </div>';
        } else {
            echo '<div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                Error: ' . $conn->error . '
            </div>';
        }

    } else {
        echo '<div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            Failed to upload image.
        </div>';
    }
}

if (isset($_POST['update'])) {

    $id          = $conn->real_escape_string($_POST['id']);
    $name        = $conn->real_escape_string($_POST['name']);
    $author      = $conn->real_escape_string($_POST['author']);
    $publisher   = $conn->real_escape_string($_POST['publisher']);
    $year        = $conn->real_escape_string($_POST['year']);
    $genre       = $conn->real_escape_string($_POST['genre']);
    $language    = $conn->real_escape_string($_POST['language']);
    $pages       = $conn->real_escape_string($_POST['pages']);
    $binding     = $conn->real_escape_string($_POST['binding']);
    $description = $conn->real_escape_string($_POST['description']);
    $price       = $conn->real_escape_string($_POST['price']);

    $image_path  = $conn->real_escape_string($_POST['existing_image']);

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp  = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    }

    $update_query = "UPDATE book SET
        image='$image_path',
        name='$name',
        author='$author',
        publisher='$publisher',
        year_of_publish='$year',
        genre='$genre',
        language='$language',
        number_of_pages='$pages',
        binding='$binding',
        description='$description',
        price='$price'
        WHERE id='$id'";

    if ($conn->query($update_query)) {
        echo '<div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            Book updated successfully!
        </div>';
    }
}

if (isset($_GET['delete'])) {

    $id = $conn->real_escape_string($_GET['delete']);

    $delete_query = "DELETE FROM book WHERE id='$id'";

    if ($conn->query($delete_query)) {
        echo '<div class="alert alert-danger">
            <i class="fas fa-trash-alt"></i>
            Book deleted.
        </div>';
    }
}

$result = $conn->query("SELECT * FROM book");

?>

</div>

<div class="card">
<h2><i class="fas fa-book"></i> Your Book Collection</h2>

<div class="books-grid">

<?php
if ($result && $result->num_rows > 0) {

while ($row = $result->fetch_assoc()) {
?>

<div class="book-card">

<div class="book-badge">
<?php echo htmlspecialchars($row['language']); ?>
</div>

<div class="book-image">
<img src="<?php echo htmlspecialchars($row['image']); ?>">
</div>

<div class="book-details">

<div class="book-title">
<?php echo htmlspecialchars($row['name']); ?>
</div>

<div class="book-author">
by <?php echo htmlspecialchars($row['author']); ?>
</div>

<div class="book-price">
₹<?php echo htmlspecialchars($row['price']); ?>
</div>

<a href="?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this book?');"
class="btn btn-danger">
Delete
</a>

</div>
</div>

<?php
}
}
$conn->close();
?>

</div>
</div>

</section>
<section id="orders-section" class="section">

<div class="card">
<h2><i class="fas fa-clipboard-list"></i> Orders List</h2>

<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('<div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Connection failed: ' . $conn->connect_error . '
    </div>');
}

$order_query = "SELECT * FROM orders";
$order_result = $conn->query($order_query);

?>

<div class="table-container">
<table>
<thead>
<tr>
    <th>Order ID</th>
    <th>User ID</th>
    <th>Book ID</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Order Date</th>
</tr>
</thead>

<tbody>

<?php
if ($order_result && $order_result->num_rows > 0) {

while ($order = $order_result->fetch_assoc()) {
?>

<tr>
    <td><?php echo htmlspecialchars($order['id']); ?></td>
    <td><?php echo htmlspecialchars($order['user_id']); ?></td>
    <td><?php echo htmlspecialchars($order['book_id']); ?></td>
    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
    <td>₹<?php echo htmlspecialchars($order['total_price']); ?></td>
    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
</tr>

<?php
}
} else {
?>

<tr>
    <td colspan="6" style="text-align:center;">
        No orders found
    </td>
</tr>

<?php
}
$conn->close();
?>

</tbody>
</table>
</div>

</div>

</section>
<section id="feedback-section" class="section">

<div class="card">
<h2><i class="fas fa-comments"></i> User Feedback</h2>

<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "books";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('<div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Connection failed: ' . $conn->connect_error . '
    </div>');
}

$feedback_query = "SELECT * FROM feedback";
$feedback_result = $conn->query($feedback_query);

?>

<div class="table-container">
<table>
<thead>
<tr>
    <th>ID</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Message</th>
    <th>Date</th>
</tr>
</thead>

<tbody>

<?php
if ($feedback_result && $feedback_result->num_rows > 0) {

while ($fb = $feedback_result->fetch_assoc()) {
?>

<tr>
    <td><?php echo htmlspecialchars($fb['id']); ?></td>
    <td><?php echo htmlspecialchars($fb['name']); ?></td>
    <td><?php echo htmlspecialchars($fb['email']); ?></td>
    <td><?php echo htmlspecialchars($fb['message']); ?></td>
    <td><?php echo htmlspecialchars($fb['created_at']); ?></td>
</tr>

<?php
}
} else {
?>

<tr>
    <td colspan="5" style="text-align:center;">
        No feedback available
    </td>
</tr>

<?php
}
$conn->close();
?>

</tbody>
</table>
</div>

</div>

</section>
<script>

function showSection(section) {

    const sections = document.querySelectorAll('.section');
    const buttons = document.querySelectorAll('.nav-btn');

    sections.forEach(sec => {
        sec.classList.remove('active');
    });

    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    if (section === 'books') {
        document.getElementById('books-section').classList.add('active');
        buttons[0].classList.add('active');
    }

    if (section === 'orders') {
        document.getElementById('orders-section').classList.add('active');
        buttons[1].classList.add('active');
    }

    if (section === 'feedback') {
        document.getElementById('feedback-section').classList.add('active');
        buttons[2].classList.add('active');
    }
}

</script>  