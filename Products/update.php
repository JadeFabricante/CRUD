<?php include 'connectiondb.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET name=?, description=?, price=?, quantity=? WHERE ID=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssiii", $name, $description, $price, $quantity, $id);

    if ($statement->execute()) {
        $message = "Record updated successfully.";
    } else {
        $message = "Error: " . $statement->error;
    }

    $statement->close();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE ID=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $statement->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <h2>Edit Products</h2>
    <?php if (!empty($message)) echo "<p>$message</p>"; ?>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo isset($row['id']) ? htmlspecialchars($row['id']) : ''; ?>">
        Name: <input type="text" name="name" value="<?php echo isset($row['name']) ? htmlspecialchars($row['name']) : ''; ?>" required><br>
        Description: <input name="description" value="<?php echo isset($row['description']) ? htmlspecialchars($row['description']) : ''; ?>"required><br>
        Price: <input type="number" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>" required><br>
        Quantity: <input type="number" name="quantity" value="<?php echo isset($row['quantity']) ? $row['quantity'] : ''; ?>" required><br>
        <input type="Submit" value="Edit">
    </form>
        <a href="index.php" class="button">Back to Products List</a>
</body>
</html>

<?php
$conn->close();
?>