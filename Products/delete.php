<?php
include 'connectiondb.php';

$id = $_GET['id'];

$sql = "DELETE FROM practice WHERE ID=?";
$statement = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($statement->execute()) {
    echo "Record deleted successfully.";
} else {
    echo "Error: " . $statement->error;
}

$statement->close();
$conn->close();
?>
<a href="index.php">Back to Products List</a>
