<?php
require_once("../conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = strip_tags(trim($_POST["nome"]));


    $insert = "INSERT INTO categorias (nome) VALUE (?)";
    $stmt = $conexao->prepare($insert);

    if ($stmt) {
        $stmt->bind_param("s", $nome);
        $resultado = $stmt->execute();
        $stmt->close();

        $_SESSION['resposta'] = "Categoria cadastrada com sucesso!";
        header("Location: ../../admin/categorias/categorias.php");
        $stmt = null;
        exit;
    } else {
        $_SESSION['resposta'] = "Ocorreu um erro!";
        header("Location: ../../admin/categorias/categorias.php");
        $stmt = null;
        exit;
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/categorias/categorias.php");
$stmt = null;
exit;
