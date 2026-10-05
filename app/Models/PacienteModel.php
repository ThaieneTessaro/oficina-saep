<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class PacienteModel extends Model
{
    protected $table = 'PACIENTE'; // nome da tabela
    protected $primaryKey = 'PAC_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela PACIENTE do banco
        'PAC_NOME',
        'PAC_DATA_NASCIMENTO',
        'FK_RES_ID'
    ];
}