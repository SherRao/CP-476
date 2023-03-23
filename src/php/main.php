<?php
    include 'functions.php';
    ?>
    <section>
        <h1>Table Test</h1>
    <?php

    $connection = setup();
    storeData($connection);
    getData($connection);
    $connection->close();
?>
