<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::beginTransaction();
            User::insert([
                'role_id' => 1,
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'gender' => 'male',
                'dob' => Carbon::now(),
                'email' => 'admin@admin.com​',
                'password' => bcrypt('password'),
                'email_verified_at'=>Carbon::now(),
            ]);
            DB::commit();
        } catch (Exception $e) {
            Log::error('Error to run seeder -> '.$e->getMessage());
        }
    }
}
