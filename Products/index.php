<?php include 'connectiondb.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Products List</h2>
    <a href="create.php">Create New Product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result -> num_rows > 0) {
            while($row = $result ->fetch_assoc()){
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['created_at']}</td>
                        <td>{$row['updated_at']}</td>
                        <td>
                            <a href='update.php?id={$row['id']}'>Edit</a> |
                            <a href='delete.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>";
            }
            
        }else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }

        $conn ->close();
        ?>
    </table>
</body>
</html>