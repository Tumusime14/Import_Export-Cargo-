<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $checkQuery = "SELECT COUNT(*) FROM manager WHERE username = :username";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        $error = 'Username already exists. Please choose another one.';
    } else {
        // Insert the new manager into the database
        $insertQuery = "INSERT INTO manager (username, password) VALUES (:username, MD5(:password))";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            // Account creation successful, redirect to login page
            header('Location: index.php');
            exit();
        } else {
            $error = 'Account creation failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="ind.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div class="content">
        <h3>Create an Account</h3>

        <!-- Display error message if any -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Your username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="*******" required>

            <input type="submit" value="Create Account">
        </form>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
