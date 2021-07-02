<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loanschedule extends Model
{
    //
    protected $table = 'loan_schedules';

    public function loan()
    {
        return $this->hasOne(Loan::class, 'id', 'loan_id');
    }

}
