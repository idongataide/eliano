<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loantransaction extends Model
{
    //
    protected $table = 'loan_transactions';


    public function loan_repayment_method()
    {
        return $this->hasOne(loan_repayment_method::class, 'id', 'repayment_method_id');
    }

    public function loan()
    {
        return $this->hasOne(Loan::class, 'id', 'loan_id');
    }
}
