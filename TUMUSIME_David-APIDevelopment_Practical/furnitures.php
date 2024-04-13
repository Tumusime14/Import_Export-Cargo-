<?php
session_start();
include("connect.php");
if (!isset($_SESSION['manager_id'])) {
    header('Location: index.php');
    exit();
  }
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_furniture'])) {
        // Add new furniture
        $furnitureId = $_POST['furniture_id'];
        $furnitureName = $_POST['furniture_name'];
        $furnitureOwnerName = $_POST['furniture_owner_name'];

        $stmt = $conn->prepare("INSERT INTO furnitures (furniture_id,furniture_name, furniture_owner_name) VALUES (:furniture_id,:furniture_name, :furniture_owner_name)");
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->bindParam(':furniture_name', $furnitureName);
        $stmt->bindParam(':furniture_owner_name', $furnitureOwnerName);
        $stmt->execute();
    } elseif (isset($_POST['update_furniture'])) {
        // Update existing furniture record
        $furnitureId = $_POST['furniture_id'];
        $furnitureName = $_POST['furniture_name'];
        $furnitureOwnerName = $_POST['furniture_owner_name'];

        $stmt = $conn->prepare("UPDATE furnitures SET furniture_name = :furniture_name, furniture_owner_name = :furniture_owner_name WHERE furniture_id = :furniture_id");
        $stmt->bindParam(':furniture_name', $furnitureName);
        $stmt->bindParam(':furniture_owner_name', $furnitureOwnerName);
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->execute();
    } elseif (isset($_POST['delete_furniture'])) {
        // Delete furniture record
        $furnitureId = $_POST['furniture_id'];

        $stmt = $conn->prepare("DELETE FROM furnitures WHERE furniture_id = :furniture_id");
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->execute();
    }
}

// Fetch furniture data
$furnitureQuery = "SELECT * FROM furnitures";
$furnitureStmt = $conn->query($furnitureQuery);
$furnitures = $furnitureStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Furnitures</title>
    <link rel="stylesheet" href="ind.css">
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4; /* Light gray background */
}

h3 {
    margin-top: 0;
    color: #333; /* Dark gray text */
}

p {
    color: #666; /* Medium gray text */
}

/* Menu Tabs */
.menu-tabs {
    background-color: #333; /* Dark background */
    padding: 10px 0;
}

.menu-tabs ul {
    list-style: none; /* Remove default list styles */
    margin: 0;
    padding: 0;
    display: flex; /* Display tabs inline */
    justify-content: center; /* Center the tabs */
}

.menu-tabs ul li {
    margin: 0 10px;
}

.menu-tabs ul li a {
    color: #fff; /* White text */
    text-decoration: none; /* Remove underline */
    padding: 8px 16px;
    display: block;
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

.menu-tabs ul li a:hover {
    background-color: #555; /* Dark gray hover background */
}

/* Content Styles */
.content {
    padding: 20px;
    max-width: 800px;
    margin: auto;
    background-color: #fff; /* White background */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Light shadow */
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333; /* Dark gray text */
}

input[type="text"],
input[type="number"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #28a745; /* Green background */
    color: #fff; /* White text */
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ccc; /* Light gray border */
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #333; /* Dark background for headers */
    color: #fff; /* White text */
}

td {
    background-color: #f9f9f9; /* Light background for cells */
}

/* Footer Styles */
footer {
    background-color: #333; /* Dark background */
    color: #fff; /* White text */
    text-align: center;
    padding: 10px;
}

    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <h3></h3>
   <!-- Add Furniture Form -->
    <form method="POST" action="furnitures.php">
        <h4>Ajouter une nouvelle importation</h4>
        <label for="furniture_id">Identifiant du meuble:</label>
        <input type="text" id="furniture_id" name="furniture_id" required> <br>
        <label for="furniture_name">Nom du meuble:</label>
        <input type="text" id="furniture_name" name="furniture_name" required>

        <label for="furniture_owner_name">Nom du propriétaire du meuble:</label>
        <input type="text" id="furniture_owner_name" name="furniture_owner_name" required>

        <input type="submit" name="add_furniture" value="Ajouter une nouvelle importation">
    </form>

    <!-- Display Furnitures Table -->
    <h4><u>Meubles existants</u></h4>
    <table border="1">
        <tr>
            <th>ID du meuble</th>
            <th>Nom du meuble</th>
            <th>Nom du propriétaire du meuble</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($furnitures as $furniture): ?>
            <tr>
                <td><?php echo $furniture['furniture_id']; ?></td>
                <td><?php echo $furniture['furniture_name']; ?></td>
                <td><?php echo $furniture['furniture_owner_name']; ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="POST" action="furnitures.php" style="display:inline;">
                        <input type="hidden" name="furniture_id" value="<?php echo $furniture['furniture_id']; ?>">
                        <input type="hidden" name="furniture_name" value="<?php echo $furniture['furniture_name']; ?>">
                        <input type="hidden" name="furniture_owner_name" value="<?php echo $furniture['furniture_owner_name']; ?>">
                        <input type="submit" name="update_furniture" value="Modifier">
                    </form>
                    
                    <!-- Delete Form -->
                    <form method="POST" action="furnitures.php" style="display:inline;">
                        <input type="hidden" name="furniture_id" value="<?php echo $furniture['furniture_id']; ?>">
                        <input type="submit" name="delete_furniture" value="Supprimer" style="background-color: red;">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php include('footer.php'); ?>
</body>
</html>
