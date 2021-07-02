<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Smartgig',
                'email' => 'smartgig@yandex.com',
                'password' => '$2y$10$yssDYfMQwaA66jJCA6tDCubjvM2A4IsqG/5gJLC39J1jvTP9J7VqW',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'remember_token' => 'Yq7LazYQ7f9LCqIlpP7JZRSktb76OcVRXpqOvcwgqCjWDokGBeZvMG9g4a86',
                'created_at' => '2019-07-27 04:25:58',
                'updated_at' => '2019-07-27 04:25:58',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'Ime Iteh',
                'email' => 'iteleh97@gmail.com',
                'password' => '$2y$10$NSTsoxN6sjVshUQpt8MH0.R7PDTMYAHTTgHdMW7Wh5wAo8vokFrGO',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => '2019-07-27 11:11:49',
                'remember_token' => NULL,
                'created_at' => '2019-07-26 09:26:15',
                'updated_at' => '2019-07-27 11:11:49',
            ),
            2 => 
            array (
                'id' => 16,
                'name' => 'Bassey Ekpo',
                'email' => 'bassey.ekpo@vksconstruction.com',
                'password' => '$2y$10$dPwBMi99zOUnkuJv46DVcOt7AHI6BdaoGEN7nnstt.1dJZLfPt3ny',
                'active' => 1,
                'role_id' => 3,
                'deleted_at' => NULL,
                'remember_token' => 'TJVVNUG7W7dPEIuRmiU1eDJ9y678ETVl27cQ4vwJa75sPn196Ut32CWPBc13',
                'created_at' => '2019-08-02 09:15:08',
                'updated_at' => '2019-08-02 09:15:08',
            ),
            3 => 
            array (
                'id' => 15,
                'name' => 'Frances Ikeji',
                'email' => 'frances.ikeji@vksconstruction.com',
                'password' => '$2y$10$dm3Ec6jJPZmraSbLr8eQBOxtbQT13jBD1khI.S6eWGXW9At2xpPMO',
                'active' => 1,
                'role_id' => 3,
                'deleted_at' => '2019-09-05 15:17:22',
                'remember_token' => 'p7dTsn3gkk71RW53tIUC9AZp9pvJqcoqtjTIrrD0tjX0m6vtTnZcnNjyoyUW',
                'created_at' => '2019-07-29 16:35:38',
                'updated_at' => '2019-09-05 15:17:22',
            ),
            4 => 
            array (
                'id' => 14,
                'name' => 'DEBORAH   MARK',
                'email' => 'deborah.mark@vksconstruction.com',
                'password' => '$2y$10$P5V.YO5uoYj1ciW4RdR./eUPzscnY8jitrfJpUyjr1ct6ReWOQnuq',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'remember_token' => 'CAcPdPVTt2n526zW8m8GL0LGjyeHNZR6uCixiJi8jAdYxnQadDc1rWaZPLAa',
                'created_at' => '2019-07-29 15:45:21',
                'updated_at' => '2019-07-29 15:45:21',
            ),
            5 => 
            array (
                'id' => 13,
                'name' => 'Abasiodu Jonah',
                'email' => 'abasioduj@gmail.com',
                'password' => '$2y$10$Y0e4ACiFQ1tEsjsIA9vlk.8/7pAc4lOnGrQJvc.2Uh5grzJ1Bv17a',
                'active' => 1,
                'role_id' => 3,
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2019-07-29 15:37:29',
                'updated_at' => '2019-07-29 15:37:29',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => 'Ime Iteh',
                'email' => 'iteh.sunday@vksconstruction.com',
                'password' => '$2y$10$DzGbzWDK18.QlQSDa8FJrenHr4CTJorMg9r5ChI.G0La8pu/Ggl5S',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'remember_token' => 'uv6E1bAFIbwEzPOFHfSuPZIs7FoCZWM1B7oLqK2ZDixvoNhAlR98GAJ9F1RP',
                'created_at' => '2019-07-27 12:47:57',
                'updated_at' => '2019-07-27 12:47:57',
            ),
            7 => 
            array (
                'id' => 17,
                'name' => 'Candas Ustamehmetoglu',
                'email' => 'custamehmetoglu@vksconstruction.com',
                'password' => '$2y$10$cZaKyFAtUKJvm9eGkA2qE.1RjSm9izvII2bUtLd0lCMBzZllXmKgK',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'remember_token' => 'Xf6sz9jDiHcV6UdLzPwv40AjqVLaGOIxnhpfksk6S31fZzlk3vcsO1T4HaZF',
                'created_at' => '2019-08-22 12:42:08',
                'updated_at' => '2019-08-22 12:42:08',
            ),
            8 => 
            array (
                'id' => 18,
                'name' => 'Malcolm Essien Etuk',
                'email' => 'malcolmonix@vksconstruction.com',
                'password' => '$2y$10$n2zcZw5TVI42rLEYsNTaF.CvYQzNB9S5n.WfQBrNchJJeNRyHkJMS',
                'active' => 1,
                'role_id' => 2,
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2019-08-22 12:47:51',
                'updated_at' => '2019-08-22 12:47:51',
            ),
            9 => 
            array (
                'id' => 19,
                'name' => 'Malcolm Essien Etuk',
                'email' => 'malcolm.etuk@vksconstruction.com',
                'password' => '$2y$10$InAb7xosMgP85OVzBfVcnOWda9.vGUs.Zwkj9srV6L7Y.yIFENVXm',
                'active' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2019-09-09 10:21:58',
                'updated_at' => '2019-09-09 10:21:58',
            ),
        ));
        
        
    }
}