<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
</head>
<body>
    <h1>Orders Management</h1>
    
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

    // Fetch orders with book information
    $query = "SELECT o.*, b.name as book_name, b.author as book_author, b.price as book_price 
              FROM orders o 
              JOIN book b ON o.book_id = b.id 
              ORDER BY o.order_date DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
        echo "<thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Book</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Pincode</th>
                    <th>Price</th>
                    <th>Order Date</th>
                </tr>
              </thead>
              <tbody>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>#{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>
                        <strong>{$row['book_name']}</strong><br>
                        by {$row['book_author']}
                    </td>
                    <td>{$row['address']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['pincode']}</td>
                    <td>₹{$row['book_price']}</td>
                    <td>{$row['order_date']}</td>
                  </tr>";
        }
        
        echo "</tbody></table>";
    } else {
        echo "<p>No orders found</p>";
    }
    
    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>