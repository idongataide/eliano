<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(BrandsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(EquipmentsTableSeeder::class);
        $this->call(EquipmentTypesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SituationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InventoryHistoriesTableSeeder::class);
    }
}
