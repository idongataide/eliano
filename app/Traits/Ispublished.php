<?php

namespace App\Traits;

trait Ispublished
{

    public function scopeIspublished($query)
    {
        return $query->where('IsPublished', '=', 'YES');
    }

}