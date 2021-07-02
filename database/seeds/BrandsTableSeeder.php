<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'DELL',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:54:03',
                'updated_at' => '2019-07-29 15:54:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'HP',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:54:15',
                'updated_at' => '2019-07-29 15:54:15',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'MOTOROLA',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:54:49',
                'updated_at' => '2019-07-29 15:54:49',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'UBIQUITI',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:54:59',
                'updated_at' => '2019-07-29 15:54:59',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'RADWIN',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:55:07',
                'updated_at' => '2019-07-29 15:55:07',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'SAMSUNG',
                'deleted_at' => NULL,
                'created_at' => '2019-07-29 15:55:19',
                'updated_at' => '2019-07-29 15:55:19',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ASUS',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 10:43:02',
                'updated_at' => '2019-07-30 10:43:02',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ACER',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 10:43:25',
                'updated_at' => '2019-07-30 10:43:25',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'MSI',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 10:43:39',
                'updated_at' => '2019-07-30 10:43:39',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'TOSHIBA',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 13:25:55',
                'updated_at' => '2019-07-30 13:25:55',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'ALIENWARE',
                'deleted_at' => NULL,
                'created_at' => '2019-07-30 15:41:43',
                'updated_at' => '2019-07-30 15:41:43',
            ),
        ));
        
        
    }
}