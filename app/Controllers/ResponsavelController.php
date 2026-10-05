<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ResponsavelModel;

class ResponsavelController extends BaseController
{
    // Exibe a listagem de responsavel
    public function index()
    {
        // Instancia o Model responsável pela tabela RESPONSAVEL
        $model = new ResponsavelModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca responsaveis que possuem o termo informado
            // no nome ou data de nascimento
            $dados['responsavel'] = $model
                ->like('RES_NOME', $pesquisar)
                ->orLike('RES_DATA_NASCIMENTO', $pesquisar)
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os responsaveis cadastrados
            $dados['responsavel'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os responsáveis encontrados
        return view('sistema/responsavel/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo responsavel
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/responsavel/novo_responsavel');
    }


    // Insere um novo responsavel no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ResponsavelModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'RES_NOME' => $this->request->getPost('nome'),
            'RES_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Insere o novo responsavel no banco
        $model->insert($dados);

        // Redireciona para a listagem de responsavel
        return redirect()
            ->to(base_url('responsavel'))
            ->with('success', 'Responsavel cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um responsavel
    public function editar($id)
    {
        // Instancia o Model
        $model = new ResponsavelModel();

        // Busca o responsavel pelo ID recebido na URL
        $dados['responsavel'] = $model->find($id);

        // Carrega a View de edição enviando os dados do responsavel
        return view('sistema/responsavel/editar_responsavel', $dados);
    }


    // Atualiza os dados de um responsavel
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ResponsavelModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'RES_NOME' => $this->request->getPost('nome'),
            'RES_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('responsavel'))
            ->with('success', 'Responsavel atualizado com sucesso!');
    }


    // Exclui um responsavel
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ResponsavelModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('responsavel'))
            ->with('success', 'Responsavel excluído com sucesso!');
    }
}