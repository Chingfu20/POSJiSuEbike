<?php
         
         echo htmlspecialchars($totalCount);
         ?>

$sql = "SELECT COUNT(*) AS total FROM categories WHERE status = 0"; // Count visible categories
$result = $conn->query($sql);

$totalCount = 0; // Default count
if ($result && $row = $result->fetch_assoc()) {
    $totalCount = $row['total'];
}
$conn->close();