<?php
//Verifica se existe uma sessão ativa e se não houver inicia uma
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $database = "sistema_comidas";

$hostname = "sql211.infinityfree.com";
$username = "if0_39143552";
$password = "vZ6TxFJMzEGhN";
$database = "if0_39143552_sistema_comidas";

$conexao = mysqli_connect($hostname, $username, $password, $database);

if ($conexao->connect_error) {
    die("ERRO! " . $conexao->connect_error);
}
