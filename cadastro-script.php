<?php

include'conexao.php';

if(isset($_POST['nome']) || isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['nome']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha seu nome.</span>';
    } else if(strlen($_POST['email']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha seu e-mail.</span>';
    } else if(strlen($_POST['senha']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha sua senha.</span>';
    } else {
        $nome = $mysqli->real_escape_string($_POST['nome']);
        $telefone = $mysqli->real_escape_string($_POST['telefone']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "INSERT INTO usuarios (is_admin, nome, telefone, email, senha) VALUES (False, '$nome', '$telefone', '$email', '$senha')";
        $sql_query = $mysqli->query($sql_code);

        if($sql_query) {
            echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-success is-medium box">Cadastro efetuado com sucesso.</span>';
        } else {
            die("Falha na execução do código SQL: " . $mysqli->error);
        }
    }
}
?>