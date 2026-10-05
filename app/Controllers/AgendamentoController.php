<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentoModel;
use App\Models\PacienteModel;
use App\Models\ResponsavelModel;

// Vincula o Agendamento ao Paciente (FK_PAC_ID) com seu respectivo Responsável (FK_RES_ID)
class AgendamentoController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamento
        $model = new AgendamentoModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do paciente e do responsável
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    PACIENTE.PAC_NOME,
                    RESPONSAVEL.RES_NOME'
                )

                // Relaciona o agendamento ao paciente
                ->join(
                    'PACIENTE',
                    'PACIENTE.PAC_ID = AGENDAMENTO.FK_PAC_ID'
                )

                // Relaciona o agendamento ao responsável
                ->join(
                    'RESPONSAVEL',
                    'RESPONSAVEL.RES_ID = AGENDAMENTO.FK_RES_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do paciente
                    ->like('PACIENTE.PAC_NOME', $pesquisar)

                    // Pesquisa pelo nome do responsável
                    ->orLike('RESPONSAVEL.RES_NOME', $pesquisar)

                    // Pesquisa pelo motivo
                    ->orLike('AGE_MOTIVO', $pesquisar)

                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    PACIENTE.PAC_NOME,
                    RESPONSAVEL.RES_NOME'
                )

                // Relaciona o paciente ao agendamento
                ->join(
                    'PACIENTE',
                    'PACIENTE.PAC_ID = AGENDAMENTO.FK_PAC_ID'
                )

                // Relaciona o responsável ao agendamento
                ->join(
                    'RESPONSAVEL',
                    'RESPONSAVEL.RES_ID = AGENDAMENTO.FK_RES_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamento/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de paciente
        $pacienteModel = new PacienteModel();

        // Instancia o Model de responsável
        $responsavelModel = new ResponsavelModel();

        // Busca todos os pacientes para preencher o SELECT
        $dados['paciente'] = $pacienteModel->findAll();

        // Busca todos os responsáveis para preencher o SELECT
        $dados['responsavel'] = $responsavelModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamento/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // Paciente escolhido no formulário
            'FK_PAC_ID' => $this->request->getPost('paciente'),

            // Responsável escolhido no formulário
            'FK_RES_ID' => $this->request->getPost('responsavel')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentoModel = new AgendamentoModel();
        $pacienteModel = new PacienteModel();
        $responsavelModel = new ResponsavelModel();

        // Busca o agendamento pelo ID
        $dados['agendamento'] = $agendamentoModel->find($id);

        // Busca os pacientes para preencher o SELECT
        $dados['paciente'] = $pacienteModel->findAll();

        // Busca os responsáveis para preencher o SELECT
        $dados['responsavel'] = $responsavelModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamento/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_PAC_ID' => $this->request->getPost('paciente'),
            'FK_RES_ID' => $this->request->getPost('responsavel')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}