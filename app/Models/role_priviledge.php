<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class role_priviledge extends Model
{
    //
    protected $table = 'role_priviledges';

    public static function getPriviledge($priviledge)
    {
        $cv = self::query('role_priviledges')->where('role_id',Auth::user()->roleid)->where('priviledge_id',$priviledge)->first();

        if (empty($cv))
        {
            $cv = 0;
        }
        else
        {
            $cv = 1;
        }

        return $cv;
    }
}
