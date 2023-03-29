<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
        header("Location: http://localhost:8000", TRUE, 301);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP 476 Project | Login</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="favicon.png" type="image/png">
    <script src="/login/login.js"></script>
</head>
<body>
    <div class="app-container">
        <h1 style="margin-top: 100px">Student Grade CRUD System</h1>
        <div class="login-container">
            <h2>Please Log In</h2>
            <div id="error-message"></div>
            <form id="login-form" method="POST">
                <div>
                    <label for="username">Database Username:</label>
                    <input id="username" name="username" type="text" required>
                </div>
                <div>
                    <label for="password">Database Password:</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div>
                    <input id="submit" value="Log In" type="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
