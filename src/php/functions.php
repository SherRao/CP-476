<?php
    function setup() {
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "myDB";

        $connection = new mysqli($servername, $username, $password, $dbname);
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

    function getData($connection) {
        $stmt = $connection->prepare("SELECT StudentId, StudentName FROM NameTable");
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
            <section>
                <h1>Table Test</h1>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                    </tr>
        <?php
        foreach($result as $row) {
            ?>
                <tr>
                    <td><?php echo $row->StudentId; ?></td>
                    <td><?php echo $row->StudentName; ?></td>
                </tr>
            <?php
        }

        ?>
                </table>
            </section>


        <?php
        echo "Data retrieved successfully";
        $stmt->close();
    }
?>
