<?php
    if (!isset($_SESSION['username'])) {
        echo "<p>You aren't currently signed in.</p>";
        echo "<p><a href='/php/login.php'>Sign in</a></p>"
        return

    $user = $_SESSION['username'];
    echo "<p>You are currently signed in as $user.</p>";
    ?>
