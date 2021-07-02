<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Can perform all task',
                'deleted_at' => NULL,
                'created_at' => '2019-07-27 04:57:30',
                'updated_at' => '2019-07-27 04:57:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Manager',
                'description' => 'Can manage every other task except assign role',
                'deleted_at' => NULL,
                'created_at' => '2019-07-27 04:57:50',
                'updated_at' => '2019-07-27 04:57:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Officer',
                'description' => 'can add inventory but can delete or change user',
                'deleted_at' => NULL,
                'created_at' => '2019-07-27 04:58:13',
                'updated_at' => '2019-07-27 04:58:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'New User',
                'description' => 'Any newly signed up user',
                'deleted_at' => NULL,
                'created_at' => '2019-07-27 04:59:16',
                'updated_at' => '2019-07-27 04:59:16',
            ),
        ));
        
        
    }
}