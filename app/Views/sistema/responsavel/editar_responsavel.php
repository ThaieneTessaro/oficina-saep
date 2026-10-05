<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Responsável</title>
    </head>
    <body>
        <h1>Editar Responsável</h1>

        <form action="<?= base_url('responsavel/atualizar/'.$responsavel['RES_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $responsavel['RES_NOME'] ?>" required>
            <br><br>
            <label>Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $responsavel['RES_DATA_NASCIMENTO'] ?>" required>
            <br><br>
            <input type="submit" id="editar_responsavel" name="editar_responsavel" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('responsavel') ?>"><button>Voltar</button></a>
    </body>
</html>