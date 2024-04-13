<?php
session_start();
include("connect.php");
if (!isset($_SESSION['manager_id'])) {
    header('Location: index.php');
    exit();
  }

// Fetch statistics for furnitures, imports, and exports

// Total number of furnitures
$furnitureQuery = "SELECT COUNT(*) AS total_furnitures FROM furnitures";
$furnitureStmt = $conn->query($furnitureQuery);
$totalFurnitures = $furnitureStmt->fetch(PDO::FETCH_ASSOC)['total_furnitures'];

// Total quantity of imports
$importQuery = "SELECT SUM(quantity) AS total_imports FROM imports";
$importStmt = $conn->query($importQuery);
$totalImports = $importStmt->fetch(PDO::FETCH_ASSOC)['total_imports'];

// Total quantity of exports
$exportQuery = "SELECT SUM(quantity) AS total_exports FROM exports";
$exportStmt = $conn->query($exportQuery);
$totalExports = $exportStmt->fetch(PDO::FETCH_ASSOC)['total_exports'];

// Import and export quantities by furniture
$reportQuery = "SELECT
                    furnitures.furniture_name,
                    COALESCE(SUM(imports.quantity), 0) AS total_imports,
                    COALESCE(SUM(exports.quantity), 0) AS total_exports
                FROM
                    furnitures
                LEFT JOIN imports ON furnitures.furniture_id = imports.furniture_id
                LEFT JOIN exports ON furnitures.furniture_id = exports.furniture_id
                GROUP BY
                    furnitures.furniture_id, furnitures.furniture_name";
$reportStmt = $conn->query($reportQuery);
$reportData = $reportStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <link rel="stylesheet" href="ind.css">
    <style>
        /* Add your CSS styles here */
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h3 {
            margin-top: 0;
            color: #333;
        }

        p {
            color: #666;
        }

        .content {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="content">
        <h3>Report</h3>

        <h4>Summary</h4>
        <p>Total Furnitures: <?php echo $totalFurnitures; ?></p>
        <p>Total Imports: <?php echo $totalImports; ?></p>
        <p>Total Exports: <?php echo $totalExports; ?></p>

        <h4>Details</h4>
        <table>
            <thead>
                <tr>
                    <th>Furniture Name</th>
                    <th>Total Imports</th>
                    <th>Total Exports</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportData as $data): ?>
                    <tr>
                        <td><?php echo $data['furniture_name']; ?></td>
                        <td><?php echo $data['total_imports']; ?></td>
                        <td><?php echo $data['total_exports']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
