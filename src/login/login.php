<?php
session_start();


function testDbConnection($host, $name, $port, $user, $pass): bool {
    try {
        $stmt = new PDO("mysql:host=$host:$port;dbname=$name", $user, $pass);
    } catch (PDOException $e) {
        return false;
    }

    $stmt = null;
    return true;
}

function handlePostRequest() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo json_encode(array("message" => "Invalid request method"));
        return;
    }

    if (!isset($_POST["username"])) {
        echo json_encode(array("message" => "Missing username"));
        return;
    }

    if (!isset($_POST["password"])) {
        echo json_encode(array("message" => "Missing password"));
        return;
    }

    $databaseUser = $_POST["username"];
    $databasePass = $_POST["password"];
    $DATABASE_HOSTNAME = "localhost";
    $DATABASE_NAME = "cp476";
    $DATABASE_PORT = "3306";
    $loggedIn = testDbConnection($DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUser, $databasePass);
    if($loggedIn) {
        $_SESSION["username"] = $databaseUser;
        $_SESSION["password"] = $databasePass;
    }

    echo json_encode(array("loggedIn" => $loggedIn));
}

handlePostRequest();
?>
