<?php
session_start();

function storeData($studentId, $studentName, $host, $name, $port, $user, $pass): bool {
    $conn = new mysqli($host, $user, $pass, $name);
    if ($conn->connect_error)
        return false;

    $stmt = $conn->prepare("INSERT INTO NameTable (StudentId, StudentName) VALUES (?, ?)");
    $stmt->bind_param("is", $studentId, $studentName);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    return true;
}

function handlePostRequest() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo json_encode(array("message" => "Invalid request method"));
        return;
    }

    if (!isset($_POST["studentId"]) || strlen((string) $_POST["studentId"]) != 9) {
        echo json_encode(array("message" => "Missing or invalid student ID"));
        return;
    }

    if (!isset($_POST["studentName"])) {
        echo json_encode(array("message" => "Missing student name"));
        return;
    }

    $studentId = $_POST["studentId"];
    $studentName = $_POST["studentName"];

    $databaseUsername = $_SESSION["username"];
    $databasePassword = $_SESSION["password"];
    $DATABASE_HOSTNAME = "localhost";
    $DATABASE_NAME = "cp476";
    $DATABASE_PORT = "3306";

    $success = storeData($studentId, $studentName, $DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUsername, $databasePassword);
    echo json_encode(array("status" => $success));
}

handlePostRequest();
?>
