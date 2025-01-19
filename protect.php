<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    echo '<!DOCTYPE html>';
    echo '<html lang="pt-BR">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Erro - Acesso Negado</title>';
    echo '<link rel="stylesheet" href="css/bulma.min.css">';
    echo '</head>';
    echo '<body>';
    echo '<section class="section">';
    echo '<div class="container">';
    echo '<div class="notification is-danger">';
    echo '<h1 class="title">Acesso Negado</h1>';
    echo '<p>Você não pode acessar essa página porque não está logado.</p>';
    echo '<br>';
    echo '<a href="login-page.php" class="button is-link">Entrar</a>';
    echo '</div>';
    echo '</div>';
    echo '</section>';
    echo '</body>';
    echo '</html>';
    exit;
}

?>
