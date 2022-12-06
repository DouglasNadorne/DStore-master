<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_dstore";

try {
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    //echo "Conectado com sucesso";
} catch (PDOException $err) {
    //echo "Erro ao conectar. Erro gerado" . $err->getMessage();
}
