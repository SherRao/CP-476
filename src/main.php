<?php
    include 'functions.php';
    if (!isset($_SESSION['username'])) {
        echo "<p>You aren't currently signed in.</p>";
        echo "<p><a href='/php/login.php'>Sign in</a></p>"
        return

    $user = $_SESSION['username'];
    echo "<p>You are currently signed in as $user.</p>";

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
