<?php
include 'conexao.php';

// Verificando se todos os campos foram declarados e não estão nulos
if (isset($_POST['procedimento']) || isset($_POST['horario']) || isset($_POST['data'])) {
    if (strlen($_POST['procedimento']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha o procedimento.</span>';
    } else if (strlen($_POST['horario']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha o horário.</span>';
    } else if (strlen($_POST['data']) == 0) {
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Preencha a data.</span>';
    } else {
        // Armazenando dados do forms em variáveis de sessão
        $_SESSION['procedimento'] = $mysqli->real_escape_string($_POST['procedimento']);
        $_SESSION['horario'] = $mysqli->real_escape_string($_POST['horario']);
        $_SESSION['data'] = $mysqli->real_escape_string($_POST['data']);
        $_SESSION['id'] = $_SESSION['id'];
        $_SESSION['nome'] = $_SESSION['nome']; 

        // Colocando em variáveis
        $procedimento = $_SESSION['procedimento'];
        $horario = $_SESSION['horario'];
        $data = $_SESSION['data'];
        $id = $_SESSION['id'];
        $nome = $_SESSION['nome'];

        // Verificação de agendamento na mesma semana
        // Consulta que traz o último agendamento na mesma semana
        $sql_code_agend = "
            SELECT * 
            FROM agendamentos 
            WHERE id = ?
            AND data_agendamento BETWEEN DATE_SUB(?, INTERVAL WEEKDAY(?) DAY) 
            AND DATE_ADD(DATE_SUB(?, INTERVAL WEEKDAY(?) DAY), INTERVAL 6 DAY)
            AND data_agendamento != ?
            ORDER BY id_agendamento DESC
            LIMIT 1;";

        // Preparando a consulta
        $sql_query_agend = $mysqli->prepare($sql_code_agend);

        // Verificando se deu certo a consulta
        if (!$sql_query_agend) {
            die("Erro na preparação da consulta: " . $mysqli->error);
        }

        // Passando os parâmetros pra consulta de agendamento (tipo string, (?) -> variável)
        $sql_query_agend->bind_param("ssssss", $id, $data, $data, $data, $data, $data);
        // Executando a consulta
        $sql_query_agend->execute();
        // Armazenando resultado da consulta
        $result = $sql_query_agend->get_result();

        // Se resultado da consulta retornar mais que 0 linhas, quer dizer que há mais agendamentos na mesma semana
        if ($result->num_rows > 0) {
            // Pegando array associativo da consults
            $row = $result->fetch_assoc();
            // Armazenando cada valor do array em variáveis de sessão 
            $_SESSION['data_agend_existente'] = $row['data_agendamento'];
            $_SESSION['procedimento_existente'] = $row['procedimento'];
            $_SESSION['horario_existente'] = $row['horario_agendamento'];

            // Formatando o campo data para exibir melhor na página
            $data_formatada = date('d/m/Y', strtotime($_SESSION['data_agend_existente']));

            // Exibindo o modal
            echo '
                <div id="agendamentoModal" class="modal is-active">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Informativo</p>
                        </header>
                        <section class="modal-card-body">
                            <p>' . $_SESSION['nome'] . ', você já marcou um procedimento na semana escolhida.</p>
                            <br>
                            <p>Se deseja alterar o agendamento atual para a mesma data, clique em sim.</p>
                            <br>
                            <p>Se deseja permanecer com o agendamento atual, clique em não.</p>
                            <br>
                            <p><b>PRIMEIRO AGENDAMENTO</b></p>
                            <p><b>Procedimento: </b>' . $_SESSION['procedimento_existente'] . '</p>
                            <p><b>Data: </b>' . $data_formatada . '</p>
                            <p><b>Horário: </b>' . $_SESSION['horario_existente'] . 'h</p>
                        </section>
                        <footer class="modal-card-foot">
                            <form method="POST" action="">
                                <button type="submit" name="resposta" value="sim" class="button is-link">Sim</button>
                                <button type="submit" name="resposta" value="nao" class="button is-danger">Não</button>
                            </form>
                        </footer>
                    </div>
                </div>';
        } else {
            // Se não tiver mais agendamentos na mesma semana, cadastrar normalmente o agendamento
            $sql_code_insert = "INSERT INTO agendamentos (horario_agendamento, data_agendamento, procedimento, id, nome_agendamento) VALUES ('$horario', '$data', '$procedimento', '$id', '$nome')";
            // Validando se query funcionou como esperado
            if ($mysqli->query($sql_code_insert)) {
                echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-success is-medium box">Horário agendado com sucesso!</span>';
            } else {
                echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-danger is-medium box">Erro ao realizar o agendamento: ' . $mysqli->error . '</span>';
            }
        }
    }
}
    // Pegando resposta do modal (sim ou nao)
    if (isset($_POST['resposta'])) {
        if ($_POST['resposta'] === 'sim') {
            // Se sim, insere com a data agendamento igual a que já existe  
            $sql_code_insert_novo = "INSERT INTO agendamentos (horario_agendamento, data_agendamento, procedimento, id, nome_agendamento) VALUES ('{$_SESSION['horario']}', '{$_SESSION['data_agend_existente']}', '{$_SESSION['procedimento']}', '{$_SESSION['id']}', '{$_SESSION['nome']}')";
            $mysqli->query($sql_code_insert_novo);
    // Se não, insere normalmente na tabela        
    } elseif ($_POST['resposta'] === 'nao') {
        $sql_code_insert_normal = "INSERT INTO agendamentos (horario_agendamento, data_agendamento, procedimento, id, nome_agendamento) VALUES ('{$_SESSION['horario']}', '{$_SESSION['data']}', '{$_SESSION['procedimento']}', '{$_SESSION['id']}', '{$_SESSION['nome']}')";
        $mysqli->query($sql_code_insert_normal);
    }
        echo '<span style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-success is-medium box">Agendamento realizado com sucesso!</span>';
    }

?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        function openModal($el) {
            $el.classList.add('is-active');
        }

        function closeModal($el) {
            $el.classList.remove('is-active');
        }

        function closeAllModals() {
            (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                closeModal($modal);
            });
        }

        const closeButton = document.getElementById('closeModal');
        if (closeButton) {
            closeButton.addEventListener('click', () => {
                const modal = document.getElementById('agendamentoModal');
                if (modal) {
                    closeModal(modal);
                }
            });
        }
    });
</script>
