<?php
session_start();

function testDbConnection(): bool {

}

function dbConn($dbo): int
{
    try {
        $dbPDO = new PDO($dbo[0], $dbo[1], $dbo[2]);
    } catch (PDOException $e) {
        return 1;
    }
    $_SESSION["dbUsername"]=$dbo[1];
    $_SESSION["dbPassword"]=$dbo[2];
    // Close connection
    $dbPDO = null;
    return 0;
}

// Scan INI file for database connection information
$iniFile = "database/dbinfo.ini";
$dbInfo = parse_ini_file($iniFile);
$dbHost = $dbInfo['dbhost'];
$dbName = $dbInfo['dbname'];
$dbPort = $dbInfo['dbport'];

// Grab POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure login data from form is present
    if (isset($_POST['dbPass']) && isset($_POST['dbUser'])) {
        $dsn = "mysql:host=$dbHost:$dbPort;dbname=$dbName";
        $dbUser = $_POST['dbUser'];
        $dbPass = $_POST['dbPass'];
        $dbo = [$dsn, $dbUser, $dbPass];
        // Send login data to the db connection test and return response
        if (dbConn($dbo) == 0) {
            echo json_encode(array('connected'=>'true'));
        } else {
            echo json_encode(array('connected'=>'false'));
        }
    } else {
        echo json_encode(array('message' => 'One or more fields was not filled'));
    }
}

?>
