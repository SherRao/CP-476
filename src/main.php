<?php
    $username = $_SESSION['username'];
    echo "<p>You are currently signed in as $username!</p>";

    function getData($connection) {
        $stmt = $connection->prepare("SELECT StudentId, StudentName FROM NameTable");
        $stmt->execute();
        $result = $stmt->get_result();
            ?>
            <div class="tables-container">
                <div>
                    <h2>Name Table</h1>
                    <table>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                        </tr>
                    <?php
                    foreach($result as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row["StudentId"] ?></td>
                            <td><?php echo $row["StudentName"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php

        $stmt = $connection->prepare("SELECT StudentId, CourseCode, Test1Grade, Test2Grade, Test3Grade, FinalTestGrade FROM CourseTable");
        $stmt->execute();
        $result = $stmt->get_result();
                ?>
                <div>
                    <h1>Course Table</h1>
                    <table>
                        <tr>
                            <th>Student ID</th>
                            <th>Course Code</th>
                            <th>Test 1 Grade</th>
                            <th>Test 2 Grade</th>
                            <th>Test 3 Grade</th>
                            <th>Final Test Grade</th>
                        </tr>
                    <?php
                    foreach($result as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row["StudentId"] ?></td>
                            <td><?php echo $row["CourseCode"] ?></td>
                            <td><?php echo $row["Test1Grade"] ?></td>
                            <td><?php echo $row["Test2Grade"] ?></td>
                            <td><?php echo $row["Test3Grade"] ?></td>
                            <td><?php echo $row["FinalTestGrade"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
            <?php

        $stmt->close();
    }

    function setup() {
        $databaseUsername = $_SESSION['username'];
        $databasePassword = $_SESSION["password"];
        $DATABASE_HOSTNAME = "localhost";
        $DATABASE_NAME = "cp476";
        $DATABASE_PORT = "3306";
        $connection = new mysqli($DATABASE_HOSTNAME, $databaseUsername, $databasePassword, $DATABASE_NAME);
        if ($connection->connect_errno) {
            die("Error! Connection failed: " . $connection->connect_errno);
        }

        return $connection;
    }

    function storeData($connection) {
        $stmt = $connection->prepare("INSERT INTO NameTable (StudentId, StudentName) VALUES (?, ?)");
        $stmt->bind_param("ss", $studentId, $studentName);

        $studentId = "123456789";
        $studentName = "John Hay";
        $stmt->execute();

        $studentId = "223456789";
        $studentName = "Mary Smith";
        $stmt->execute();

        echo "New records created successfully";
        $stmt->close();
    }

    $connection = setup();
    getData($connection);
    $connection->close();
?>
