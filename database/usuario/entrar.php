<?php
session_start();
require_once("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = trim(strip_tags($_POST["senha"]));

    // Verificar o email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['resposta'] = "Email inválido!";
        header("Location: ../../entrar.php");
        exit;
    }

    if (!empty($email) && !empty($senha)) {
        try {

            // Faz a verificação no banco de dados
            $select = "SELECT id, nome, email, senha, admin FROM usuarios WHERE email = ?";

            $stmt = $conexao->prepare($select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $nome, $email, $senha_db, $admin);
            $stmt->fetch();

            // Se verificar que email e senha existe e batem no banco de dados ele loga o usuário;
            if (!empty($nome) && !empty($senha) && password_verify($senha, $senha_db)) {
                $_SESSION["id"] = $id;
                $_SESSION["nome"] = $nome;
                $_SESSION["email"] = $email;
                $_SESSION["admin"] = $admin;
                header("Location: ../../admin/dashboard.php");
                exit;
            } else {
                $_SESSION['resposta'] = "E-mail ou senha inválidos!";
                header("Location: ../../entrar.php");
                exit;
            }
        } catch (Exception $erro_email) {

            // Caso houver erro ele retorna
            switch ($erro_email->getCode()) {
                // erro de quantidade de paramêtros erro
                case 1136:
                    $_SESSION['resposta'] = "Quantidade de dados inseridos inválida!";
                    header("Location: ../../entrar.php");
                    exit;

                default:
                    $_SESSION['resposta'] = "error" . $erro_email->getCode();
                    header("Location: ../../entrar.php");
                    exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../entrar.php");
$stmt = null;
exit;
