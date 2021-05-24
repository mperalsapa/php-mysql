<?php
// Dades de connexio amb la base de dades
$servername = "192.168.217.187";
$username = "agenda";
$password = "P@t@t@";
$dbname = "agenda";

// Agafem el id de la URL
if (isset($_GET['id'])){
    $user_id = $_GET['id'];
    
    // Creem la connexio
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Comprovem que la connexio funciona
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Formem la consulta
    $sql = "SELECT * FROM persona WHERE id = $user_id";
    // Executem la consulta
    $result = $conn->query($sql);
    // Agafem els resultats de la consulta
    $dades = $result->fetch_assoc();
    
    // Mostre els noms dels camps
    // i els valors d'aquestos
    foreach ($dades as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }

    // tanquem la connexio amb la base de dades
    $conn->close();
}
?>