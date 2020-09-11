
<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $sql = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";

    $query = $sql->query("insert into t_user (usePseudo, usePassword) values ('root', 'root')");

    $query = $sql->prepare("select * from t_user");
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo $row['usePseudo'];
    }
    //TODO create a user only one time
    $query = "insert into t_user (usePseudo, usePassword) values ('root', 'root')";
    //echo $conn->query($sql);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>