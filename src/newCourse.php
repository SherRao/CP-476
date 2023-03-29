<?php
session_start();

function storeData($studentId, $courseCode, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade, $host, $name, $port, $user, $pass): bool {
    $conn = new mysqli($host, $user, $pass, $name);
    if ($conn->connect_error)
        return false;

    $stmt = $conn->prepare("INSERT INTO CourseTable (StudentId, CourseCode, Test1Grade, Test2Grade, Test3Grade, FinalTestGrade) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiii", $studentId, $courseCode, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade);
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

    if (!isset($_POST["studentId"])) {
        echo json_encode(array("message" => "Missing student ID"));
        return;
    }

    if (!isset($_POST["studentName"])) {
        echo json_encode(array("message" => "Missing student name"));
        return;
    }

    $studentId = $_POST["studentId"];
    $courseCode = $_POST["courseCode"];
    $test1Grade = $_POST["test1Grade"];
    $test2Grade = $_POST["test2Grade"];
    $test3Grade = $_POST["test3Grade"];
    $finalTestGrade = $_POST["finalTestGrade"];

    $databaseUsername = $_SESSION["username"];
    $databasePassword = $_SESSION["password"];
    $DATABASE_HOSTNAME = "localhost";
    $DATABASE_NAME = "cp476";
    $DATABASE_PORT = "3306";

    $success = storeData($studentId, $studentName, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade,
    $DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUsername, $databasePassword);
    echo json_encode(array("status" => $success));
}

handlePostRequest();
?>
