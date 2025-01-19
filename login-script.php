<?php

include'conexao.php';

if(isset($_POST['email']) || isset($_POST['senha'])) {
    // Validando se os campos não estão vazios
    if(strlen($_POST['email']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha seu e-mail.</span>';
    } else if(strlen($_POST['senha']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha sua senha.</span>';
    } else {
        // Evitando sql injection
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        // Realizando a consulta sql
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        // Tenta fazer a query, se não conseguir, da kill
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }
            
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['is_admin'] = $usuario['is_admin'];
            
            header("Location: home.php");

        } else {
            echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">E-mail ou senha incorretos.</span>';
        }

    }

}

?>