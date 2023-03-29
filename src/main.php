<?php
    function getData($connection) {
        $stmt = $connection->prepare("SELECT StudentId, StudentName FROM NameTable");
        $stmt->execute();
        $result = $stmt->get_result();
            ?>
            <div class="tables-container" style="overflow: scroll">
                <div>
                    <h2>Name Table</h1>
                    <div id="name-table-error-message"></div>
                    <table id="name-table">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Delete Row</th>
                        </tr>
                        <?php
                        foreach($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row["StudentId"]; ?></td>
                            <td><?php echo $row["StudentName"]; ?></td>
                            <td><?php
                                $id = "s" . (string) $row["StudentId"];
                                $result = '<button id=' . $id . '>Delete</button>';
                                echo $result;
                            ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <table>
                        <tr>
                        <form id="name-table-form" method="POST">
                            <div>
                                <td>
                                    <label for="studentId-name">ID</label>
                                    <input id="studentId-name" name="studentId-name" type="number" required>
                                </td>
                                <td>
                                    <label for="studentName">Name</label>
                                    <input id="studentName" name="studentName" type="text" required>
                                </td>
                                <td>
                                    <input id="submit-name" value="Add" type="submit">
                                </td>
                            </div>
                        </form>
                        </tr>
                    </table>
                </div>
            <?php

        $stmt = $connection->prepare("SELECT StudentId, CourseCode, Test1Grade, Test2Grade, Test3Grade, FinalTestGrade FROM CourseTable");
        $stmt->execute();
        $result = $stmt->get_result();
                ?>
                <div>
                    <h2>Course Table</h2>
                    <div id="course-table-error-message"></div>
                    <table id="course-table">
                        <tr>
                            <th>Student ID</th>
                            <th>Course Code</th>
                            <th>Test 1 Grade</th>
                            <th>Test 2 Grade</th>
                            <th>Test 3 Grade</th>
                            <th>Final Test Grade</th>
                            <th>Delete Row</th>
                        </tr>
                        <tr>
                        <?php
                        foreach($result as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row["StudentId"]; ?></td>
                                <td><?php echo $row["CourseCode"]; ?></td>
                                <td><?php echo $row["Test1Grade"]; ?></td>
                                <td><?php echo $row["Test2Grade"]; ?></td>
                                <td><?php echo $row["Test3Grade"]; ?></td>
                                <td><?php echo $row["FinalTestGrade"]; ?></td>
                                <td><?php
                                    $id = "c" . (string) $row["StudentId"] . (string) $row["CourseCode"];
                                    $result = '<button id=' . $id . '>Delete</button>';
                                    echo $result;
                                ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                        </tr>
                    </table>
                    <table>
                    <tr>
                        <form id="course-table-form" method="POST">
                            <div>
                                <td>
                                    <label for="studentId-course">ID</label>
                                    <input id="studentId-course" name="studentId-course" type="text" required>
                                </td>
                                <td>
                                    <label for="courseCode">Course Code</label>
                                    <input id="courseCode" name="courseCode" type="text" required>
                                </td>
                                <td>
                                    <label for="test1Grade">Test 1 Grade</label>
                                    <input id="test1Grade" name="test1Grade" type="number" required>
                                </td>
                                <td>
                                    <label for="test2Grade">Test 2 Grade</label>
                                    <input id="test2Grade" name="test2Grade" type="number" required>
                                </td>
                                <td>
                                    <label for="test3Grade">Test 3 Grade</label>
                                    <input id="test3Grade" name="test3Grade" type="number" required>
                                </td>
                                <td>
                                    <label for="finalTestGrade">Final Test Grade</label>
                                    <input id="finalTestGrade" name="finalTestGrade" type="number" required>
                                </td>
                                <td>
                                    <input id="submit-course" value="Add" type="submit">
                                </td>
                            </div>
                        </form>
                    </tr>
                    </table>
                </div>
            </div>
            <?php

        $stmt = $connection->prepare("SELECT StudentId, StudentName, CourseCode, FinalGrade FROM FinalGradeTable");
        $stmt->execute();
        $result = $stmt->get_result();
               ?>
                <div>
                    <h2>Final Grade Table</h2>
                    <table id="final-grade-table">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Course Code</th>
                            <th>Final Test Grade</th>
                        </tr>
                        <tr>
                    <?php
                    foreach($result as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row["StudentId"]; ?></td>
                            <td><?php echo $row["StudentName"]; ?></td>
                            <td><?php echo $row["CourseCode"]; ?></td>
                            <td><?php echo $row["FinalGrade"]; ?></td>
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

    function x() {
        $stmt = $connection->prepare("SELECT StudentId, StudentName, CourseCode, FinalGrade FROM FinalGradeTable");
        $stmt->execute();
        $result = $stmt->get_result();
               ?>
                <div>
                    <h2>Final Grade Table</h2>
                    <table id="final-grade-table">
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Course Code</th>
                            <th>Final Grade</th>
                        </tr>
                        <tr>
                    <?php
                    foreach($result as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row["StudentId"]; ?></td>
                            <td><?php echo $row["StudentName"]; ?></td>
                            <td><?php echo $row["CourseCode"]; ?></td>
                            <td><?php echo $row["FinalGrade"]; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
            <?php
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

    $connection = setup();
    $username = $_SESSION['username'];
    echo "<p>You are currently signed in as $username!</p>";
    getData($connection);
    $connection->close();
?>
