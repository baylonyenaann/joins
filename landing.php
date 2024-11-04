<?php
session_start();
require 'assets/db/config.php'; 
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit; 
}

$query = "
    SELECT users.user_id, users.fullname, users.username, users.email, users.birthday, users.age, users.created_at, 
           profiles.profile_id
    FROM users
    RIGHT JOIN profiles ON users.user_id = profiles.user_id
";

$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - All Users Data</title>
    <link rel="stylesheet" href="assets/landing.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to Dashboard</h2>
        <a class="logout-button" href="assets/db/logout.php">Logout</a>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>Account Created</th>
                    <th>Profile ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['profile_id']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
