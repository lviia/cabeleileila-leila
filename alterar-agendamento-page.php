<?php

include 'conexao.php';
include 'protect.php';

$id = $_SESSION['id'];
$admin = $_SESSION['is_admin'];

if ($admin == 1) {
    $sql = "SELECT id_agendamento, horario_agendamento, data_agendamento, procedimento, nome_agendamento FROM agendamentos";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id_agendamento, horario_agendamento, data_agendamento, procedimento, nome_agendamento FROM agendamentos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Agendamentos</title>
    <link rel="stylesheet" href="css/bulma.min.css">
</head>
<body>
<a href="home.php" style="position: absolute; right: 0; top: 0; margin: 30px;" class="tag is-hoverable is-link is-large box">Voltar</a>
<section class="section">
    <div class="container">
        <h1 class="title">Seus Agendamentos</h1>
        <table class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Procedimento</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): 
                $data_formatada = date('d/m/Y', strtotime($row['data_agendamento']));    
                ?>
                <tr>
                    <td><?= htmlspecialchars($data_formatada) ?></td>
                    <td><?= htmlspecialchars($row['horario_agendamento']) ?></td>
                    <td><?= htmlspecialchars($row['procedimento']) ?></td>
                    <td><?= htmlspecialchars($row['nome_agendamento']) ?></td>
                    <td>
                        <a href="alterar-agendamento-script?id=<?= $row['id_agendamento'] ?>" class="button is-small is-info">Editar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
