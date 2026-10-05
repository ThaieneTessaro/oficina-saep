<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ResponsavelModel extends Model
{
    protected $table = 'RESPONSAVEL'; // nome da tabela
    protected $primaryKey = 'RES_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela RESPONSAVEL do banco
        'RES_NOME',
        'RES_DATA_NASCIMENTO'
    ];
}