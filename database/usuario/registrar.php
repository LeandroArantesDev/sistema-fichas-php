<?php
include_once("../conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Recebendo os dados do formulários de criar usuário
    $nome = mb_convert_case(trim(strip_tags($_POST["nome"])), MB_CASE_TITLE, "UTF-8");
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = trim(strip_tags($_POST["senha"]));
    $confirmarsenha = trim(strip_tags($_POST["confirmarsenha"]));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['resposta'] = "Email inválido!";
        header("Location: ../../registrar.php");
        exit;
    }

    // Verificar se os dados chegaram com sucesso para continuar
    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarsenha)) {

        // Verificar se as senhas são iguais e criptografa-la
        if ($senha === $confirmarsenha) {
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        } else {
            $_SESSION['resposta'] = "As senhas não estão iguais!";
            header("Location: ../../registrar.php");
            exit;
        }

        try {

            // Faz a inserção no banco de dados
            $insert = "INSERT INTO usuarios (nome, email, senha) VALUES (?,?,?)";

            $stmt = $conexao->prepare($insert);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            // Se funcionar a inserção no banco ele retorna para a tela do index falando que funcionou, se não ele retorna erro
            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Usuário cadastrado com sucesso!";
                header("Location: ../../entrar.php");
                exit;
            } else {
                $_SESSION['resposta'] = "Usuário deu erro!";
                header("Location: ../../registrar.php");
                exit;
            }
        } catch (Exception $erro_email) {

            // Caso houver erro ele retorna
            switch ($erro_email->getCode()) {
                // erro de email duplicado código 1062
                case 1062:
                    $_SESSION['resposta'] = "Email já cadastrado!";
                    header("Location: ../../registrar.php");
                    exit;

                    // erro de quantidade de paramêtros erro
                case 1136:
                    $_SESSION['resposta'] = "Quantidade de dados inseridos inválida!";
                    header("Location: ../../registrar.php");
                    exit;

                default:
                    $_SESSION['resposta'] = "error" . $erro_email->getCode();
                    header("Location: ../../registrar.php");
                    exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../registrar.php");
$stmt = null;
exit;
