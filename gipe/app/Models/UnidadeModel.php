<?php namespace App\Models;
use CodeIgniter\Model;

class UnidadeModel extends Model {
    protected $table = 'Unidades'; protected $primaryKey = 'id';
    protected $allowedFields = ['id_condominio', 'numero', 'tipo', 'proprietario_id', 'fracao'];
    
    // Validação
    protected $validationRules = [
        'id_condominio' => 'required|numeric',
        'numero'        => 'required|min_length[1]|max_length[10]',
        'tipo'          => 'required',
        'fracao'        => 'required|decimal'
    ];
    
    protected $validationMessages = [
        'numero' => ['required' => 'O número da porta é obrigatório.']
    ];
}