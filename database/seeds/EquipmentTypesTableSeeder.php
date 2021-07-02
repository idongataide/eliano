<?php

use Illuminate\Database\Seeder;

class EquipmentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('equipment_types')->delete();
        
        \DB::table('equipment_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'LAPTOPS',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:00:12',
                'updated_at' => '2019-07-26 09:41:02',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'DESKTOP COMPUTER',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:02:35',
                'updated_at' => '2019-07-26 09:40:43',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'WALKIE TALKIE',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:40:23',
                'updated_at' => '2019-07-26 09:40:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'MONITORS',
                'deleted_at' => NULL,
                'created_at' => '2019-07-26 09:42:30',
                'updated_at' => '2019-07-26 09:42:30',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'ACER',
                'deleted_at' => '2019-07-30 11:44:43',
                'created_at' => '2019-07-30 11:35:58',
                'updated_at' => '2019-07-30 11:44:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'MSI',
                'deleted_at' => '2019-07-30 11:44:34',
                'created_at' => '2019-07-30 11:40:55',
                'updated_at' => '2019-07-30 11:44:34',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ASUS',
                'deleted_at' => '2019-07-30 11:44:20',
                'created_at' => '2019-07-30 11:41:43',
                'updated_at' => '2019-07-30 11:44:20',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ARUBAS',
                'deleted_at' => NULL,
                'created_at' => '2019-09-06 11:48:46',
                'updated_at' => '2019-09-06 11:48:46',
            ),
        ));
        
        
    }
}