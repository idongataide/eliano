<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan_charge extends Model
{
    //
    protected $table = 'loan_charges';
    public function charge()
    {
        return $this->hasOne(charge::class, 'id', 'charge_id');
    }
}
