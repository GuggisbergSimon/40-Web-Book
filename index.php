
<?php
$servername = "localhost";
$username = 'root';
$password  = 'root';

try {
    $sql = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";

    $query = $sql->prepare("select * from t_user");
    $query->execute();
    $canInsert = true;

    //check if the username is already used or no
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row['usePseudo'] == $username) {
            $canInsert = false;
            break;
        }
    }

    //create an account if the username is not used
    if ($canInsert) {
        $query = $sql->query("insert into t_user (usePseudo, usePassword) values ('$username', '$password')");
        echo "created accounts !";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>