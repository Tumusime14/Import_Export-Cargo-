<?php
session_start();

// Check if the user is logged in
  if (!isset($_SESSION['manager_id'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Warehouse Management</title>
    <link rel="stylesheet" href="ind.css">
    <style>
        /* General Styles */
body {
    font-family: Arial, Helvetica, sans-serif; /* Modern font */
    margin: 0;
    padding: 0;
    background-color: #f0f2f5; /* Light gray background */
    color: #333; /* Dark gray text */
}

h3 {
    color: #4a4a4a; /* Darker gray text */
    text-align: center;
    margin-bottom: 20px;
}

p {
    color: #666; /* Medium gray text */
    line-height: 1.6; /* Improved readability */
}

/* Navigation Tabs */
.menu-tabs {
    background-color: #343a40; /* Dark gray background */
    padding: 10px 0;
}

.menu-tabs ul {
    list-style-type: none; /* Remove list bullet points */
    margin: 0;
    padding: 0;
    display: flex; /* Align items in a row */
    justify-content: center; /* Center tabs */
}

.menu-tabs ul li {
    margin: 0 10px; /* Space between list items */
}

.menu-tabs ul li a {
    color: #fff; /* White text */
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.menu-tabs ul li a:hover {
    background-color: #495057; /* Darker gray hover */
}

/* Content Section */
.content {
    padding: 20px;
    margin: 20px auto; /* Center content */
    max-width: 800px; /* Limit width */
    background-color: #fff; /* White background */
    border-radius:
}
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <h3>Tableau de bord de gestion d'entrepôt</h3>
    <div class="content">
        <p>Bienvenue dans le tableau de bord de gestion des entrepôts. Utilisez les onglets du menu pour accéder aux différentes sections. Choisissez « Importations » pour gérer les enregistrements d'importation, « Exportations » pour gérer les enregistrements d'exportation et « Meubles » pour gérer les enregistrements de meubles.
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
