<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    public function pagamento(){
        return $this->hasMany('App\Models\Pagamento');
    }
}
