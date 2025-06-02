<?php

//Verifica se existe uma sessão ativa e se não houver inicia uma
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//Limpa a sessão
$_SESSION = [];

//Limpa os cookies do usuário logado
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

//Destroi a sessão
session_destroy();

//Reincaminha para a tela de login
header("Location: ../index.php");
exit;
