<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan_product extends Model
{
    //
    protected $table = 'loan_products';
    public function charges()
    {
        return $this->hasMany(loan_product_charge::class, 'loan_product_id', 'id');
    }
}
