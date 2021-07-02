<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    //
    protected $table = 'loans';

    public function charges()
    {
        return $this->hasMany(loan_charge::class, 'loan_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(loanschedule::class, 'loan_id', 'id')->orderBy('due_date', 'asc');
    }
    public function transactions()
    {
        return $this->hasMany(loantransaction::class, 'loan_id', 'id')->orderBy('date', 'asc');;
    }
    public function payments()
    {
        return $this->hasMany(loanrepayment::class, 'loan_id', 'id')->orderBy('collection_date', 'asc');;
    }

    public function loan_product()
    {
        return $this->hasOne(loan_product::class, 'id', 'loan_product_id');
    }
}
