<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Responsável</title>
    </head>
    <body>
        <h1>Novo Responsável</h1>
        <form action="<?= base_url('responsavel/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
            
            <label>Data de Nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <br><br>

            <input type="submit" id="cadastrar_responsavel" name="cadastrar_responsavel" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('responsavel') ?>"><button>Voltar</button></a>
    </body>
</html>