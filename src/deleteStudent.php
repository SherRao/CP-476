<?php
session_start();

function deleteFromNameTable($studentId, $host, $name, $port, $user, $pass): bool {
    $conn = new mysqli($host, $user, $pass, $name);
    if ($conn->connect_error)
        return false;

    $stmt = $conn->prepare("DELETE FROM NameTable WHERE StudentId=?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    return true;
}

function deleteFromCourseTable($studentId, $courseCode, $host, $name, $port, $user, $pass): bool {
    $conn = new mysqli($host, $user, $pass, $name);
    if ($conn->connect_error)
        return false;

    $stmt = $conn->prepare("DELETE FROM CourseTable WHERE StudentId=? AND CourseCode=?");
    $stmt->bind_param("is", $studentId, $courseCode);
    $stmt->execute();

    // $stmt = $conn->prepare("DELETE FROM FinalGradeTable WHERE StudentId=? AND CourseCode=?");
    // $stmt->bind_param("is", $studentId, $courseCode);
    // $stmt->execute();

    $stmt->close();
    $conn->close();
    return true;
}

function handlePostRequest() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        echo json_encode(array("message" => "Invalid request method"));
        return;
    }

    if (!isset($_POST["studentId"])) {
        echo json_encode(array("message" => "Missing student ID"));
        return;
    }

    if (!isset($_POST["type"])) {
        echo json_encode(array("message" => "Missing type"));
        return;
    }

    $studentId = $_POST["studentId"];
    $type = $_POST["type"];

    $databaseUsername = $_SESSION["username"];
    $databasePassword = $_SESSION["password"];
    $DATABASE_HOSTNAME = "localhost";
    $DATABASE_NAME = "cp476";
    $DATABASE_PORT = "3306";

    $success = $type == "s" ?
    deleteFromNameTable($studentId, $DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUsername, $databasePassword)
    : deleteFromCourseTable($studentId, $_POST["courseCode"], $DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUsername, $databasePassword);

    echo json_encode(array("status" => $success));
}

handlePostRequest();
?>
