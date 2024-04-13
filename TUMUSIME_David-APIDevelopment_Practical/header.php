<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
    header {
    background-color: black;
    color: white;
    padding: 20px 0;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.nav-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}

.nav-menu ul li {
    margin-right: 20px;
}

.nav-menu ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.nav-menu ul li a:hover {
    background-color: #555;
}

    </style><!-- Make sure to link your CSS file here -->
</head>
<body>
    <header>
        <div class="header-container">
            <h1>IMPORTATION/EXPORTATION DE FRET!</h1>
            <nav class="nav-menu">
                <ul>
                    <li><a href="home.php">Maison</a></li>
                    <li><a href="imports.php">Importations</a></li>
                    <li><a href="exports.php">Exportations</a></li>
                    <li><a href="furnitures.php">Meubles</a></li>
                    <li><a href="report.php">Rapport</a></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                </ul>
            </nav>
        </div>
    </header>
