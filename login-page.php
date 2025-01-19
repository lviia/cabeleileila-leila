<?php
include'login-script.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Acesse sua conta</h1>
                    <form action="" method="post">

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
                                <button class="button is-primary is-medium" type="submit">Entrar</button>
                            </div>
                            <div class="control is-align-content-center">
                                <a href="cadastro-page.php" class="tag">Ainda não tem uma conta? Cadastre-se!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>