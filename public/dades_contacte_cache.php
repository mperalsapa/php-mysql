<?php
// Dades de connexio amb la base de dades MySQL
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
    // Temps de vida de la cache
    $ttl = 20; //Second

    //Generacio de la clau memcacue (ha de ser unica)
    $cacheKey = md5($sql); 

    // Inicialitzacio de la connexio amb Memcached
    $cache = new Memcached();
    $cache->addServer('localhost',11211);
        // Comprovacio del registre a memcached
        if(($data = $cache->get($cacheKey)) != null) {
            // Si existeix mostrem les dades amb un "CACHED" devant
            echo("CACHED<br>");
            $dades = $cache->get($cacheKey);
        } else {
            // Si no exieteix mostrem les dades amb un "NO CACHED" devant
            // i les passem al Memcached per guardar-les
            echo("NO CACHED<br>");
            // Executem la consulta
            $result = $conn->query($sql);
            // Tanquem la connexio
            $conn->close();
            // Agafem els resultats de la consulta
            $dades = $result->fetch_assoc();
            // Guardem les dades de la consulta MySQL en Memcache
            $cache->set($cacheKey, $dades, $ttl);
        }
    
    // Mostre els noms dels camps
    // i els valors d'aquestos
    foreach ($dades as $k => $v) {
        echo $k.' : '.$v.'<br>';
    }
}
?>