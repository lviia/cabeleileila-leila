<?php

include'protect.php';
include'agendamento-script.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <link rel="stylesheet" href="css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                    <h1 class="title has-text-centered">Agende um horário com a Leila</h1>
                    <form action="" method="post">
                        <div class="field">
                            <label class="label">Nome</label>
                            <div class="control">
                                <input name="nome" class="input" type="text" placeholder="<?php echo $_SESSION['nome']; ?>" disabled />
                            </div>
                        </div>
                        
                        <div class="field">
                            <label class="label">Procedimento *</label>
                            <div class="control">
                                <input name="procedimento" class="input" type="text" placeholder="Corte, Luzes, Hidratação...">
                            </div>
                        </div>
                        

                        <div class="field">
                            <label class="label">Horário *</label>
                            <div class="control">
                                <input name="horario" class="input" type="text" placeholder="09:00 - 17:00">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Data *</label>
                            <div class="control">
                                <input 
                                name="data"
                                class="input" 
                                type="date" 
                                id="date-input" 
                                >
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-primary is-medium" type="submit">Agendar</button>
                        </div>
                            <a href="home.php" class="button is-link is-medium">Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>