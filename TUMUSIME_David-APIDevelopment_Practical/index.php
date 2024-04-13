<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="ind.css">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['firstname'];
        $password = $_POST['password'];

        // Query the manager table
        $query = "SELECT * FROM manager WHERE username = :username AND password = MD5(:password)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Login successful, set session variables and redirect to dashboard
            $_SESSION['manager_id'] = $row['manager_id'];
            $_SESSION['username'] = $row['username'];
            header('Location: home.php'); // Redirect to the dashboard page
            exit();
        } else {
            // Login failed, set an error message
            $error = 'Invalid username or password!';
        }
    }
    ?>
</head>
<style>
  .login-form {
    max-width: 400px; /* Limit form width */
    margin: auto; /* Center the form */
    padding: 20px; /* Add padding around the form */
    background-color: #f9f9f9; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Light shadow */
}

/* Style form elements */
.form-group {
    margin-bottom: 15px; /* Space between form groups */
}

label {
    display: block; /* Display label on its own line */
    margin-bottom: 5px; /* Space between label and input */
    color: #333; /* Dark gray text */
    font-weight: bold; /* Bold label text */
}

input[type="text"],
input[type="password"] {
    width: 100%; /* Full-width inputs */
    padding: 10px; /* Padding inside inputs */
    border-radius: 4px; /* Rounded corners */
    border: 1px solid #ccc; /* Light gray border */
    box-sizing: border-box; /* Account for padding and border */
}

input[type="submit"] {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 20px; /* Padding inside button */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor */
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

input[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
}
</style>
<body>
    <div class="content">
        <!-- Display error message if any -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="login-form">
    <div class="form-group">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="firstname" placeholder="Ton nom d'utilisateur" required> 
    </div>

    <div class="form-group">
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="*******" required> 
    </div>

    <div class="form-group">
        <input type="submit" value="Se connecter">
    </div>
</form>

        <!-- Add a button to redirect to createAccount.php -->
        <p>Vous n'avez pas de compte ? <a href="createAccount.php"><button>Créer un compte</button></a></p>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
