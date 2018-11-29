<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    //tabela posts
    protected $table = 'agendamentos';
    //chave primaria do banco
    protected $primarykey = 'id';
    //cada um representa uma coluna no banco
    protected $fillable = [
        'data',
        'hora',
        'cliente_id',
        'servico_id',
        'cabeleireiro_id',
        'nomecliente',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'cliente_id', 'id');
    }
    public function servicoagendamento()
    {
        return $this->belongsTo(Servico::class, 'servico_id', 'id');
    }
    public function cabeleireiroagendamento()
    {
        return $this->belongsTo(Cabeleireiro::class, 'cabeleireiro_id', 'id');
    }

}
