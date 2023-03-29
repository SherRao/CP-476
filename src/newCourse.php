<?php
session_start();

function storeData($studentId, $courseCode, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade, $host, $name, $port, $user, $pass): bool {
    $conn = new mysqli($host, $user, $pass, $name);
    if ($conn->connect_error)
        return false;

    $stmt = $conn->prepare("INSERT INTO CourseTable (StudentId, CourseCode, Test1Grade, Test2Grade, Test3Grade, FinalTestGrade) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiii", $studentId, $courseCode, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT StudentName FROM NameTable WHERE StudentId=?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($studentName);
    $stmt->fetch();

    $stmt = $conn->prepare("INSERT INTO FinalGradeTable (StudentId, StudentName, CourseCode, FinalGrade) VALUES (?, ?, ?, ?)");
    $finalGrade = ($test1Grade * .2) + ($test2Grade * .2) + ($test3Grade * .2) + ($finalTestGrade * .4);
    $stmt->bind_param("issi", $studentId, $studentName, $courseCode, $finalGrade);
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

    if (!isset($_POST["studentId-course"]) || strlen((string) $_POST["studentId-course"]) != 9) {
        echo json_encode(array("message" => "Missing or invalid student ID"));
        return;
    }

    if (!isset($_POST["courseCode"]) || strlen((string) $_POST["courseCode"]) != 5) {
        echo json_encode(array("message" => "Missing course code"));
        return;
    }

    if (!isset($_POST["test1Grade"])) {
        echo json_encode(array("message" => "Missing test 1 grade"));
        return;
    }

    if ($_POST["test1Grade"] < 0 || $_POST["test1Grade"] > 100) {
        echo json_encode(array("message" => "Invalid test 1 grade"));
        return;
    }

    if (!isset($_POST["test2Grade"])) {
        echo json_encode(array("message" => "Missing test 2 grade"));
        return;
    }

    if ($_POST["test2Grade"] < 0 || $_POST["test2Grade"] > 100) {
        echo json_encode(array("message" => "Invalid test 2 grade"));
        return;
    }

    if (!isset($_POST["test3Grade"])) {
        echo json_encode(array("message" => "Missing test 3 grade"));
        return;
    }

    if ($_POST["test3Grade"] < 0 || $_POST["test3Grade"] > 100) {
        echo json_encode(array("message" => "Invalid test 3 grade"));
        return;
    }

    if (!isset($_POST["finalTestGrade"])) {
        echo json_encode(array("message" => "Missing final test grade"));
        return;
    }

    if ($_POST["finalTestGrade"] < 0 || $_POST["finalTestGrade"] > 100) {
        echo json_encode(array("message" => "Invalid final test grade"));
        return;
    }

    $studentId = $_POST["studentId-course"];
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

    $success = storeData(
        $studentId, $courseCode, $test1Grade, $test2Grade, $test3Grade, $finalTestGrade,
        $DATABASE_HOSTNAME, $DATABASE_NAME, $DATABASE_PORT, $databaseUsername, $databasePassword
    );

    echo json_encode(array("status" => $success));
}

handlePostRequest();
?>
