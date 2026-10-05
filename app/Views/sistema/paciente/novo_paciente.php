<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Paciente</title>
    </head>
    <body>
        <h1>Novo Paciente</h1>
        <form action="<?= base_url('paciente/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
            
            <label>Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <br><br>

            <label>Responsável:</label><br>
            <select id="responsavel" name="responsavel" required>
                <option value="">Selecione um responsável</option>
                <?php foreach($responsavel as $res): ?>
                    <option value="<?= $res['RES_ID'] ?>">
                        <?= $res['RES_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="cadastrar_paciente" name="cadastrar_paciente" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('paciente') ?>"><button>Voltar</button></a>
    </body>
</html>