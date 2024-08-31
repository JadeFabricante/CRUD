<?php include 'connectiondb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssii", $name, $description, $price, $quantity);

    if ($statement->execute()) {
        $message = "Record created successfully.";
    } else {
        $message = "Error: " . $statementt->error;
    }

    $statement->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Create New Product</h2>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form action="create.php" method = "post">
        Name: <input type="text" name="name" required><br>
        Description: <input type="text" name="description" required><br>
        Price: <input type="number" name="price" required><br>
        Quantity: <input type="number" name="quantity" required><br>
        <input type="submit" value="Create">
    </form>
    <a href="index.php">Back to the Products Lis</a>
</body>
</html>
