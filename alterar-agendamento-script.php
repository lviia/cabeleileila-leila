<?php
include 'conexao.php';
include 'protect.php';

$id = $_SESSION['id'];
$admin = $_SESSION['is_admin'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_agendamento = $_POST['id_agendamento'];
    $novo_horario = $_POST['horario_agendamento'];
    $nova_data = $_POST['data_agendamento'];
    $novo_procedimento = $_POST['procedimento'];

    if ($admin == 1) {
        $sql = "UPDATE agendamentos SET horario_agendamento = ?, data_agendamento = ?, procedimento = ? WHERE id_agendamento = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $novo_horario, $nova_data, $novo_procedimento, $id_agendamento);
        if ($stmt->execute()) {
            header("Location: alterar-agendamento-page.php");
            exit;
        } else {
            echo "Erro ao atualizar: " . $mysqli->error;
        }
    } else {
        $sql = "SELECT data_agendamento FROM agendamentos WHERE id_agendamento = ? AND id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $id_agendamento, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Agendamento não encontrado ou você não tem permissão para editá-lo.";
        } else {
            $data_atual = $result->fetch_assoc()['data_agendamento'];
            $diferenca_dias = (new DateTime())->diff(new DateTime($data_atual))->days;
            $hoje = new DateTime();
            $data_agendamento = new DateTime($data_atual);

            if ($hoje > $data_agendamento || $diferenca_dias < 2) {
                echo '<!DOCTYPE html>';
                echo '<html lang="pt-BR">';
                echo '<head>';
                echo '<meta charset="UTF-8">';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
                echo '<title>Edição Não Permitida</title>';
                echo '<link rel="stylesheet" href="css/bulma.min.css">';
                echo '<script>
                    let countdown = 10;
                    function updateCountdown() {
                        const countdownElement = document.getElementById("countdown");
                        countdownElement.textContent = countdown;
                        if (countdown === 0) {
                            window.history.back();
                        } else {
                            countdown--;
                            setTimeout(updateCountdown, 1000);
                        }
                    }
                    window.onload = updateCountdown;
                </script>';
                echo '</head>';
                echo '<body>';
                echo '<section class="section">';
                echo '<div class="container">';
                echo '<div class="notification is-danger">';
                echo '<h1 class="title">Erro</h1>';
                echo '<p>Não é possível editar agendamentos com menos de 2 dias de antecedência, somente via telefone.</p>';
                echo '<p>Você será redirecionado automaticamente em <span id="countdown">10</span> segundos.</p>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
                echo '</body>';
                echo '</html>';                
                exit;
            } else {
                $sql = "UPDATE agendamentos SET horario_agendamento = ?, data_agendamento = ?, procedimento = ? WHERE id_agendamento = ? AND id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("sssii", $novo_horario, $nova_data, $novo_procedimento, $id_agendamento, $id);
                if ($stmt->execute()) {
                    header("Location: alterar-agendamento-page.php");
                    exit;
                } else {
                    echo "Erro ao atualizar: " . $mysqli->error;
                }
            }
        }
    }
} else {
    $id_agendamento = $_GET['id'];
    if ($admin == 1) {
        $sql = "SELECT * FROM agendamentos WHERE id_agendamento = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id_agendamento);
    } else {
        $sql = "SELECT * FROM agendamentos WHERE id_agendamento = ? AND id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $id_agendamento, $id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Agendamento não encontrado ou você não tem permissão para editá-lo.";
        exit;
    }

    $agendamento = $result->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="css/bulma.min.css">
</head>
<body>
<a href="alterar-agendamento-page.php" style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-hoverable is-link is-large box">Voltar</a>
<section class="section">
    <div class="container"> 
        <h1 class="title">Editar Agendamento</h1>
        <form method="post">
            <input type="hidden" name="id_agendamento" value="<?= isset($agendamento['id_agendamento']) ? htmlspecialchars($agendamento['id_agendamento']) : '' ?>">
            <div class="field">
                <label class="label">Data</label>
                <div class="control">
                    <input class="input" type="date" name="data_agendamento" value="<?= isset($agendamento['data_agendamento']) ? htmlspecialchars($agendamento['data_agendamento']) : '' ?>">
                </div>
            </div>
            <div class="field">
                <label class="label">Horário</label>
                <div class="control">
                    <input class="input" type="time" name="horario_agendamento" value="<?= isset($agendamento['horario_agendamento']) ? htmlspecialchars($agendamento['horario_agendamento']) : '' ?>">
                </div>
            </div>
            <div class="field">
                <label class="label">Procedimento</label>
                <div class="control">
                    <input class="input" type="text" name="procedimento" value="<?= isset($agendamento['procedimento']) ? htmlspecialchars($agendamento['procedimento']) : '' ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</section>
</body>
</html>
