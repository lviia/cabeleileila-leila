<?php

// Revivendo a sessão
if(!isset($_SESSION)) {
    session_start();
}
// Destruindo as variáveis de sessão
session_destroy();
// Redirecionando pra tela de login
header("Location: login-page.php");