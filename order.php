<!DOCTYPE html>    
<html lang="en">    
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Order Book</title>    
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
            padding: 20px;    
        }    

        .container {    
            max-width: 850px;    
            margin: 0 auto;    
            background: var(--card-bg);    
            border-radius: 16px;    
            overflow: hidden;    
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);    
            animation: fadeIn 0.6s ease;    
        }    

        @keyframes fadeIn {    
            from { opacity: 0; transform: translateY(15px);}    
            to { opacity: 1; transform: translateY(0);}    
        }    

        header {    
            text-align: center;    
            padding: 30px;    
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));    
            color: white;    
            position: relative;    
        }    

        header h1 { font-size: 2.2rem; }    

        .header-icons {    
            position: absolute; top: 20px; right: 20px; display: flex; gap: 12px;    
        }    

        .header-icons div {    
            background: rgba(255, 255, 255, 0.25);    
            padding: 10px 12px;    
            border-radius: 50%;    
            cursor: pointer;    
            transition: 0.3s;    
        }    

        .header-icons div:hover { background: rgba(255, 255, 255, 0.45); }    

        .book-info {    
            display: flex;    
            gap: 20px;    
            padding: 25px;    
            background: #fafafa;    
            border-bottom: 1px solid rgba(0,0,0,0.1);    
        }    

        .book-info img {    
            width: 140px;    
            height: 180px;    
            border-radius: 12px;    
            object-fit: cover;    
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);    
        }    

        .book-details h3 {    
            color: var(--primary-dark);    
            margin-bottom: 10px;    
            font-size: 1.4rem;    
        }    

        .book-price {    
            margin-top: 12px;    
            font-size: 1.6rem;    
            font-weight: bold;    
            color: var(--primary);    
        }    

        .order-form { padding: 30px; }    

        .form-title {    
            font-size: 1.8rem;    
            padding-bottom: 10px;    
            margin-bottom: 20px;    
            color: var(--primary-dark);    
            border-bottom: 3px solid var(--primary-light);    
        }    

        .form-group { margin-bottom: 20px; }    

        .form-group label {    
            font-weight: 600;    
            display: block;    
            margin-bottom: 8px;    
        }    

        .form-group input,    
        .form-group textarea {    
            width: 100%;    
            padding: 14px;    
            border-radius: 10px;    
            font-size: 16px;    
            border: 1px solid #cfd8dc;    
            transition: 0.3s;    
        }    

        .form-group input:focus,    
        .form-group textarea:focus {    
            border-color: var(--primary);    
            box-shadow: 0 0 0 4px rgba(46,125,50,0.2);    
        }    

        .payment-box {    
            border-radius: 14px;    
            padding: 20px;    
            margin-top: 20px;    
            background: linear-gradient(120deg, #e8f5e9, #dcedc8);    
            border: 2px solid var(--primary-light);    
            box-shadow: 0 4px 12px rgba(46,125,50,0.2);    
            transition: 0.3s;    
        }    

        .payment-box:hover {    
            transform: scale(1.01);    
            box-shadow: 0 6px 18px rgba(46,125,50,0.25);    
        }    

        .payment-title {    
            font-size: 1.3rem;    
            margin-bottom: 12px;    
            font-weight: bold;    
            color: var(--primary-dark);    
        }    

        .payment-option {    
            display: flex;    
            align-items: center;    
            gap: 10px;    
            margin-bottom: 12px;    
            font-size: 1rem;    
        }    

        .payment-option input { transform: scale(1.2); accent-color: var(--primary); }    

        #card-details {    
            margin-top: 15px;    
            background: #f1f8e9;    
            padding: 18px;    
            border-radius: 10px;    
            border: 1px solid #c5e1a5;    
            animation: fadeIn 0.3s ease;    
        }    

        .submit-btn {    
            width: 100%;    
            padding: 18px;    
            margin-top: 10px;    
            border-radius: 12px;    
            border: none;    
            font-size: 1.2rem;    
            font-weight: bold;    
            cursor: pointer;    
            color: white;    
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));    
            box-shadow: 0 6px 15px rgba(46, 125, 50, 0.3);    
            transition: 0.3s;    
        }    

        .submit-btn:hover {    
            transform: translateY(-2px);    
            box-shadow: 0 8px 20px rgba(46,125,50,0.4);    
        }    

        footer {    
            padding: 20px;    
            text-align: center;    
            color: var(--text-light);    
            border-top: 1px solid rgba(0,0,0,0.1);    
            background: #fafafa;    
        }    

        @media (max-width: 600px) {    
            .book-info { flex-direction: column; text-align:center; }    
            .book-info img { margin-bottom: 15px; }    
        }    
    </style>    
</head>    

<body>    
<div class="container">    

    <header>    
        <h1><i class="fas fa-shopping-cart"></i> Place Your Order</h1>    
        <p>Complete the form below to order your book</p>    
        <div class="header-icons">    
            <div onclick="window.history.back()" title="Back"><i class="fas fa-arrow-left"></i></div>    
            <div onclick="window.location.href='home.php'" title="Home"><i class="fas fa-home"></i></div>    
        </div>    
    </header>    

    <?php    
    session_start();    
    $host = "localhost";    
    $user = "root";    
    $password = "";    
    $dbname = "books";    
    $conn = mysqli_connect($host, $user, $password, $dbname);    
    if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;    
    $query = "SELECT * FROM book WHERE id = $id";    
    $result = mysqli_query($conn, $query);    
    if ($result && mysqli_num_rows($result) > 0) {    
        $book = mysqli_fetch_assoc($result);    
    } else { die("Book not found!"); }    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
        $user_id = $_SESSION['user_id'];    
        $book_id = $id;    
        $name = $book['name'];    
        $price = $book['price'];    
        $address = mysqli_real_escape_string($conn, $_POST['address']);    
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);    
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);    
        $order_date = date('Y-m-d H:i:s');    

        $insert_query = "INSERT INTO orders (book_id, user_id, name, price, address, phone, pincode, order_date)    
                         VALUES ('$book_id', '$user_id', '$name', '$price', '$address', '$phone', '$pincode', '$order_date')";    

        if (mysqli_query($conn, $insert_query)) {    
            echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Order placed successfully!</div>';    
        } else {    
            echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Error: ' . mysqli_error($conn) . '</div>';    
        }    
    }    
    ?>    

    <div class="book-info">    
        <img src="<?php echo $book['image']; ?>" alt="Book Image">    
        <div class="book-details">    
            <h3><?php echo $book['name']; ?></h3>    
            <p><strong>Author:</strong> <?php echo $book['author']; ?></p>    
            <p><strong>Publisher:</strong> <?php echo $book['publisher']; ?></p>    
            <p><strong>Year:</strong> <?php echo $book['year_of_publish']; ?></p>    
            <div class="book-price">₹<?php echo $book['price']; ?></div>    
        </div>    
    </div>    

    <div class="order-form">    
        <h2 class="form-title">Shipping Information</h2>    

        <form method="POST" id="orderForm">    
            <div class="form-group">    
                <label><i class="fas fa-user"></i> Full Name</label>    
                <input type="text" name="customer_name" required>    
            </div>    

            <div class="form-group">    
                <label><i class="fas fa-map-marker-alt"></i> Address</label>    
                <textarea name="address" required></textarea>    
            </div>    

            <div class="form-group">    
                <label><i class="fas fa-phone"></i> Phone</label>    
                <input type="tel" name="phone" required>    
            </div>    

            <div class="form-group">    
                <label><i class="fas fa-map-pin"></i> Pincode</label>    
                <input type="text" name="pincode" required>    
            </div>    

            <div class="payment-box">    
                <div class="payment-title"><i class="fas fa-money-check-alt"></i> Payment Method</div>    
                <label class="payment-option">    
                    <input type="radio" name="payment_method" value="cod" required>    
                    <i class="fas fa-hand-holding-usd"></i> Cash on Delivery    
                </label>    
                <label class="payment-option">    
                    <input type="radio" name="payment_method" value="card">    
                    <i class="fas fa-credit-card"></i> Card Payment    
                </label>    
            </div>    

            <div id="card-details" style="display:none;">    
                <div class="form-group">    
                    <label>Card Number</label>    
                    <input type="text" name="card_number">    
                </div>    
                <div class="form-group">    
                    <label>Expiry Date</label>    
                    <input type="text" name="expiry_date">    
                </div>    
                <div class="form-group">    
                    <label>CVV</label>    
                    <input type="password" name="cvv">    
                </div>    
            </div>    

            <button type="submit" class="submit-btn">    
                <i class="fas fa-check-circle"></i> Confirm Order    
            </button>    
        </form>    
    </div>    

    <footer>    
        © 2023 BookStore — Delivery within 5–7 working days.    
    </footer>    
</div>    

<script>    
// Toggle card payment section
document.addEventListener("DOMContentLoaded", () => {    
    const card = document.querySelector('input[value="card"]');    
    const cod = document.querySelector('input[value="cod"]');    
    const box = document.getElementById("card-details");    

    document.querySelectorAll('input[name="payment_method"]').forEach(r => {    
        r.addEventListener("change", () => {    
            box.style.display = card.checked ? "block" : "none";    
        });    
    });    

    // ✅ Form validation
    document.getElementById("orderForm").addEventListener("submit", function(e) {
        const name = document.querySelector('input[name="customer_name"]').value.trim();
        const address = document.querySelector('textarea[name="address"]').value.trim();
        const phone = document.querySelector('input[name="phone"]').value.trim();
        const pincode = document.querySelector('input[name="pincode"]').value.trim();

        const namePattern = /^[A-Za-z\s]+$/;
        const addressPattern = /^[A-Za-z0-9\s,.\-]+$/;
        const phonePattern = /^[0-9]{10}$/;
        const pinPattern = /^[0-9]{6}$/;

        if (!namePattern.test(name)) {
            alert("Name should contain only alphabets and spaces.");
            e.preventDefault();
            return;
        }

        if (!addressPattern.test(address)) {
            alert("Address should contain only letters, numbers, commas, and dots.");
            e.preventDefault();
            return;
        }

        if (!phonePattern.test(phone)) {
            alert("Phone number must be exactly 10 digits and contain only numbers.");
            e.preventDefault();
            return;
        }

        if (!pinPattern.test(pincode)) {
            alert("Pincode must be a 6-digit number.");
            e.preventDefault();
            return;
        }
    });
});    
</script>    
</body>    
</html>

