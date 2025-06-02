<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "root";
$database = "sistema_comidas";

$conexao = mysqli_connect($hostname, $username, $password, $database);

if ($conexao->connect_error) {
    die("ERRO! " . $conexao->connect_error);
}
