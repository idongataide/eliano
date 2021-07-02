<?php

use Illuminate\Database\Seeder;

class SituationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('situations')->delete();
        
        \DB::table('situations')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'FAULTY',
                'deleted_at' => '2019-07-26 10:50:49',
                'created_at' => '2019-07-26 09:26:15',
                'updated_at' => '2019-07-26 10:50:49',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'IN-STOCK',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:26:15',
                'updated_at' => '2019-07-26 10:45:36',
            ),
            2 => 
            array (
                'id' => 1,
                'name' => 'ASSIGNED',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:26:15',
                'updated_at' => '2019-07-26 09:26:15',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'RETURNED',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 13:13:17',
                'updated_at' => '2019-07-26 13:13:17',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'LOST',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 16:00:27',
                'updated_at' => '2019-07-30 16:00:27',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'DAMAGE',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 16:00:45',
                'updated_at' => '2019-07-30 16:00:45',
            ),
        ));
        
        
    }
}