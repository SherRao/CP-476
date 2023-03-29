<?php
    session_start();
    echo "hey";
    if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header("Location: http://localhost:8000/login", TRUE, 301);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP 476 Project | Grades</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="app-container">
        <h1>Student Grade Calculator</h1>
        <?php
            include 'main.php';
        ?>
</div>
</body>
</html>