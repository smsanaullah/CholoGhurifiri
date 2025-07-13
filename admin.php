<?php
include 'db_connection.php';

if (isset($_POST['add_admin'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $contact_number = $_POST['contact_number'];

    $query = "INSERT INTO admins (name, role, contact_number) VALUES ('$name', '$role', '$contact_number')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Admin added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding admin.');</script>";
    }
}

$query = "SELECT * FROM admins";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admins List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Admins List</h1>
    <table>
        <thead>
        <tr>
            <th>Admin ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Contact Number</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['admin_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= $row['contact_number'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
