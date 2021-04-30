<?php
function connectDb()
{
    $host = "127.0.0.1";
    $dbname = "animal_sanctuary";
    $username = "root";
    $password = "";
    // Creates a PDO object called $db and establishes the MySQL database connection
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $ex) {
        ?>
        <p>Sorry, a database error occurred.</p>
        <p> Error details: <em> <?= $ex->getMessage() ?> </em></p>
        <?php
    }
}