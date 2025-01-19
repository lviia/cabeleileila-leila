<?php

include 'cadastro-script.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Cadastro de usuário</h1>
                    <form action="" method="post">
                        <div class="field">
                            <label class="label">Nome *</label>
                            <div class="control">
                                <input name="nome" class="input" type="text" placeholder="Seu nome">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Telefone</label>
                            <div class="control">
                                <input name="telefone" class="input" type="tel" placeholder="99 99999-9999">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">E-mail *</label>
                            <p class="control has-icons-left has-icons-right">
                                <input name="email" class="input" type="email" placeholder="exemplo@gmail.com" />
                                <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                                </span>
                                <span class="icon is-small is-right">
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <label class="label">Senha *</label>
                            <p class="control has-icons-left">
                                <input name="senha" class="input" type="password" placeholder="********" />
                                <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-primary is-medium" type="submit">Cadastrar</button>
                            </div>
                            <div class="control is-align-content-center">
                                <a href="login-page.php" class="tag">Já tem uma conta? Faça Login!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>