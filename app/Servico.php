<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //tabela servico
    protected $table = 'servicos';
    //chave primaria do banco
    protected $primarykey = 'id';
    //cada um representa uma coluna do banco
    protected $fillable = [
        'tipo_servico'
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
