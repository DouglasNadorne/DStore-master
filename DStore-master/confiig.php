<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_dstore');
if (mysqli_connect_errno()) {
    exit("Erro ao conectar-se ao banco de dados." . mysqli_connect_error());
}
