<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Pacientes</title>
    </head>
    <body>
        <h1>Lista de Pacientes</h1>

        <form method="POST" action="<?= base_url('paciente') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Responsável</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($paciente as $pac): ?>
                <tr>
                    <td><?= $pac['PAC_NOME'] ?></td>
                    <td><?= $pac['PAC_DATA_NASCIMENTO'] ?></td>
                    <td><?= $pac['RES_NOME'] ?></td>
                    <td><a href="<?= base_url('paciente/editar/'.$pac['PAC_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('paciente/excluir/'.$pac['PAC_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('paciente/novo') ?>"><button>Cadastrar Paciente</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>