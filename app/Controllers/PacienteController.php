<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ResponsavelModel;
use App\Models\PacienteModel;

// Vincula o Paciente com seu respectivo Responsavel (FK_RES_ID)
class PacienteController extends BaseController
{
    // Exibe a listagem de paciente
    public function index()
    {
        // Instancia o Model de paciente
        $model = new PacienteModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os pacientes juntamente com o nome do responsavel
            // responsável por cada paciente
            $dados['paciente'] = $model
                ->select('PACIENTE.*, RESPONSAVEL.RES_NOME')

                // Relaciona PACIENTE com RESPONSAVEL pela chave estrangeira
                ->join(
                    'RESPONSAVEL',
                    'RESPONSAVEL.RES_ID = PACIENTE.FK_RES_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pelo nome
                    ->like('PAC_NOME', $pesquisar)

                    // Pesquisa pela data de nascimento
                    ->orLike('PAC_DATA_NASCIMENTO', $pesquisar)

                    // Também permite pesquisar pelo nome do responsavel
                    ->orLike('RESPONSAVEL.RES_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os pacientes
            // juntamente com o nome dos respectivos responsaveis
            $dados['paciente'] = $model
                ->select('PACIENTE.*, RESPONSAVEL.RES_NOME')
                ->join(
                    'RESPONSAVEL',
                    'RESPONSAVEL.RES_ID = PACIENTE.FK_RES_ID'
                )
                ->findAll();
        }

        // Carrega a View de paciente
        return view('sistema/paciente/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo paciente
    public function novo()
    {
        // Instancia o Model de responsavel
        $responsavelModel = new ResponsavelModel();

        // Busca todos os responsavel cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['responsavel'] = $responsavelModel->findAll();

        // Carrega o formulário de cadastro do veículo
        return view('sistema/paciente/novo_paciente', $dados);
    }


    // Insere um novo paciente
    public function inserir()
    {
        // Instancia o Model de paciente
        $model = new PacienteModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'PAC_NOME' => $this->request->getPost('nome'),
            'PAC_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento'),

            // Guarda o ID do responsavel escolhido no formulário
            // como chave estrangeira do paciente
            'FK_RES_ID' => $this->request->getPost('responsavel')
        ];

        // Insere o paciente no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('paciente'))
            ->with('success', 'Paciente cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de Paciente
        $pacienteModel = new PacienteModel();

        // Instancia o Model de responsavel
        $responsavelModel = new ResponsavelModel();

        // Busca o paciente que será editado
        $dados['paciente'] = $pacienteModel->find($id);

        // Busca todos os responsáveis para preencher o SELECT
        $dados['responsavel'] = $responsavelModel->findAll();

        // Carrega a View de edição
        return view('sistema/paciente/editar_paciente', $dados);
    }


    // Atualiza um paciente
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new PacienteModel();

        // Recupera os novos dados do formulário
        $dados = [
            'PAC_NOME' => $this->request->getPost('nome'),
            'PAC_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento'),

            // Guarda o ID do responsavel escolhido no formulário
            // como chave estrangeira do paciente
            'FK_RES_ID' => $this->request->getPost('responsavel')
        ];

        // Atualiza o paciente pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('paciente'))
            ->with('success', 'Paciente atualizado com sucesso!');
    }


    // Exclui um paciente
    public function excluir($id)
    {
        // Instancia o Model
        $model = new PacienteModel();

        // Exclui o veículo pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('paciente'))
            ->with('success', 'Paciente excluído com sucesso!');
    }
}