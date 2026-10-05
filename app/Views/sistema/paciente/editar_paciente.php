<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Paciente</title>
    </head>
    <body>
        <h1>Editar Paciente</h1>

        <form action="<?= base_url('paciente/atualizar/'.$paciente['PAC_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $paciente['PAC_NOME'] ?>" required>
            <br><br>
            <label>Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $paciente['PAC_DATA_NASCIMENTO'] ?>" required>
            <br><br>

            <label>Responsável:</label><br>
            <select id="responsavel" name="responsavel" required>
                <?php foreach($responsavel as $res): ?>
                    <option value="<?= $res['RES_ID'] ?>"
                        <?= $res['RES_ID'] == $paciente['FK_RES_ID'] ? 'selected' : '' ?>>
                        <?= $res['RES_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="editar_paciente" name="editar_paciente" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('paciente') ?>"><button>Voltar</button></a>
    </body>
</html>