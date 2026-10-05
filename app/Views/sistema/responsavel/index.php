<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Responsáveis</title>
    </head>
    <body>
        <h1>Lista de Responsáveis</h1>

        <form method="POST" action="<?= base_url('responsavel') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($responsavel as $res): ?>
                <tr>
                    <td><?= $res['RES_NOME'] ?></td>
                    <td><?= $res['RES_DATA_NASCIMENTO'] ?></td>
                    <td><a href="<?= base_url('responsavel/editar/'.$res['RES_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('responsavel/excluir/'.$res['RES_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('responsavel/novo') ?>"><button>Cadastrar Responsável</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>