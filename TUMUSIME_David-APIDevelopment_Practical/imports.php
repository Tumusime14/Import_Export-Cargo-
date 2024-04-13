<?php
session_start();
if (!isset($_SESSION['manager_id'])) {
    header('Location: index.php');
    exit();
  }
include("connect.php");
// Handle form submission for adding, updating, or deleting imports
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_import'])) {
        // Add new import record
        $furnitureId = $_POST['furniture_id'];
        $importDate = $_POST['import_date'];
        $quantity = $_POST['quantity'];

        $stmt = $conn->prepare("INSERT INTO imports (furniture_id, import_date, quantity) VALUES (:furniture_id, :import_date, :quantity)");
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->bindParam(':import_date', $importDate);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    } elseif (isset($_POST['update_import'])) {
        // Update existing import record
        $furnitureId = $_POST['furniture_id'];
        $importDate = $_POST['import_date'];
        $quantity = $_POST['quantity'];

        $stmt = $conn->prepare("UPDATE imports SET import_date = :import_date, quantity = :quantity WHERE furniture_id = :furniture_id");
        $stmt->bindParam(':import_date', $importDate);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->execute();
    } elseif (isset($_POST['delete_import'])) {
        // Delete import record
        $furnitureId = $_POST['furniture_id'];

        $stmt = $conn->prepare("DELETE FROM imports WHERE furniture_id = :furniture_id");
        $stmt->bindParam(':furniture_id', $furnitureId);
        $stmt->execute();
    }
}

// Fetch imports data
$importsQuery = "SELECT imports.furniture_id, furnitures.furniture_name, imports.import_date, imports.quantity
                FROM imports
                JOIN furnitures ON imports.furniture_id = furnitures.furniture_id";

$importsStmt = $conn->query($importsQuery);
$imports = $importsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Importations</title>
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
     <form method="POST" action="imports.php">
        <h4>Add New Import</h4>
        <label for="furniture_id">ID du Meuble:</label>
        <input type="text" id="furniture_id" name="furniture_id" required>

        <label for="import_date">Date du importations:</label>
        <input type="date" id="import_date" name="import_date" required>

        <label for="quantity">Quantité:</label>
        <input type="text" id="quantity" name="quantity" required>

        <input type="submit" name="add_import" value="Ajouter une importation">
    </form>

    <!-- Display Imports Table -->
    <h4>Importations existant</h4>
    <table border="1">
        <tr>
            <th>Furniture ID</th>
            <th>Nom du Mueble</th>
            <th>Date du importation</th>
            <th>Quantité</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($imports as $import): ?>
            <tr>
                <td><?php echo $import['furniture_id']; ?></td>
                <td><?php echo $import['furniture_name']; ?></td>
                <td><?php echo $import['import_date']; ?></td>
                <td><?php echo $import['quantity']; ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="POST" action="imports.php" style="display:inline;">
                        <input type="hidden" name="furniture_id" value="<?php echo $import['furniture_id']; ?>">
                        <input type="hidden" name="import_date" value="<?php echo $import['import_date']; ?>">
                        <input type="hidden" name="quantity" value="<?php echo $import['quantity']; ?>">
                        <input type="submit" name="update_import" value="Modifier">
                    </form>
                    
                    <!-- Delete Form -->
                    <form method="POST" action="imports.php" style="display:inline;">
                        <input type="hidden" name="furniture_id" value="<?php echo $import['furniture_id']; ?>">
                        <input type="submit" name="delete_import" value="Supprimer" style="background-color: red;">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php include('footer.php'); ?>
</body>
</html>
