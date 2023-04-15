<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {

            if ($i == 1) {


                //CREATEING SUPER-ADMIN
                $superadmin = User::create([
                    'first_name' => 'Super-admin',
                    'email' => 'superadmin@superadmin.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'Super-Admin',
                    'date_of_birth' => '2023/01/17',
                    'gender' => "male",
                    'employee_id' => 'super-admin1',
                ]);
                $superadmin->assignRole('Super-Admin');
            } elseif ($i == 2) {

                //CREATEING ADMIN
                $admin = User::create([
                    'first_name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'admin',
                    'date_of_birth' => '2023/01/17',
                    'gender' => "male",
                    'employee_id' => 'admin',
                ]);

                $admin->assignRole('admin');
            } elseif ($i == 3) {

                //CREATEING USERs
                $normaluser = User::create([
                    'first_name' => 'user' . $i,
                    'email' => 'user' . $i . '@user.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'user',
                    'date_of_birth' => '2023/01/17',
                    'gender' => "male",
                    'employee_id' => 'user',
                ]);

                $normaluser->assignRole('user');
            } elseif ($i == 4) {

                //CREATEING Doctor
                $normaluser = User::create([
                    'first_name' => 'Monojit',
                    'email' => 'Monojit@doctor.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'Doctor',
                    'date_of_birth' => '2023/01/17',
                    'gender' => "male",
                    'employee_id' => 'doctor',
                ]);

                $normaluser->assignRole('Doctor');
            }
            elseif ($i == 5) {

                //CREATEING Nurse
                $normaluser = User::create([
                    'first_name' => 'Ayoni',
                    'email' => 'Ayoni@doctor.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'Nurse',
                    'date_of_birth' => '2023/01/17',
                    'gender' => "male",
                    'employee_id' => 'nurse',
                ]);

                $normaluser->assignRole('Nurse');
            }
           

        }
    }
}
