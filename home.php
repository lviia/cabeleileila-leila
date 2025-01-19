<?php

include'protect.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial | Cabeleileila Leila</title>
    <link rel="stylesheet" href="css/bulma.min.css">
    <style>
        html, body {
            height: 100%; 
        }
        .full-height {
            height: 100%; 
        }
        .card {
            width: 300px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05); 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<section class="section full-height">
    <h1 class="title has-text-centered m-0"> Bem vindo(a), <?php echo $_SESSION['nome']; ?>! </h1>
    <a href="logout.php" style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-hoverable is-danger is-large box">Sair</a>
    <div class="container is-flex is-justify-content-center is-align-items-center full-height">
        <div class="card m-3">
            <a href="agendamento-page.php">
                <div class="card-image">
                    <figure class="image is-square">
                        <img
                            src="https://img.freepik.com/vetores-gratis/ilustracao-de-desenho-animado-de-cabeleireiro-desenhada-a-mao_23-2151102968.jpg"
                            alt="Ilustração Cabeleireira"
                        />
                    </figure>
                </div>
                <div class="card-content">
                    <div class="content">
                        Agendamento
                    </div>
                </div>
            </a>
        </div>
        <div class="card m-3">
            <a href="alterar-agendamento-page.php">
                <div class="card-image">
                    <figure class="image is-square">
                        <img
                            src="https://img.freepik.com/free-vector/flat-spring-time-forward-illustration_23-2151191338.jpg?t=st=1737082924~exp=1737086524~hmac=c5fa1e27522ea5aae61e699792213c466dd161f54a4e254609867f7ce80e9646&w=740"
                            alt="Ilustração Relógio com flores"
                        />
                    </figure>
                </div>
                <div class="card-content">
                    <div class="content">
                        Alterar Agendamento
                    </div>
                </div>
            </a>
        </div>
        <div class="card m-3">
            <a href="historico-agendamento-page.php">
                <div class="card-image">
                    <figure class="image is-square">
                        <img
                            src="https://img.freepik.com/free-vector/appointment-booking-with-woman-smartphone_23-2148564096.jpg?t=st=1737083331~exp=1737086931~hmac=2dc2631caca80bffb10d1daad7997e9f09b7ab041ae99ee3000104d3b8c6a062&w=740"
                            alt="Ilustração Cabeleireira"
                        />
                    </figure>
                </div>
                <div class="card-content">
                    <div class="content">
                    Histórico de Agendamentos
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
</body>
</html>

