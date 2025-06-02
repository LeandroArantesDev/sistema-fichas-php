<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/registrar.css">
    <link rel="stylesheet" href="assets/css/mensagem.css">
    <title>Sistema de Fichas | Registrar-se</title>
</head>

<body>
    <div class="interface">
        <div class="logo">
            <div class="icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="nome">
                <p>Sistemas de Fichas</p>
            </div>
        </div>
        <p class="acesse">Registre sua conta</p>
        <form action="database/usuario/registrar.php" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Seu nome completo">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
            </div>
            <div class="form-group">
                <label for="confirmarsenha">Confirme a senha</label>
                <input type="password" name="confirmarsenha" id="confirmarsenha"
                    placeholder="Digite sua senha novamente">
            </div>
            <button type="submit">Registrar-se</button>
            <p>Já tem uma conta? <a href="entrar.php" target="_self">Entrar</a></p>
        </form>
        <a href="index.php" target="_self" class="voltar"><i class="fa-solid fa-arrow-left"></i>Voltar ao início</a>
    </div>
    <?php
    include("includes/mensagem.php");
    ?>
</body>

</html>