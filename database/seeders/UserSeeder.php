<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Director Test',
            'email' => 'DirectorTest001@test.com',
            'group_id' => 0,
            'position_id' => 0,
            'password' => bcrypt("123456"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Group Leader Test',
            'email' => 'GroupLeaderTest001@test.com',
            'group_id' => 0,
            'position_id' => 1,
            'password' => bcrypt("123456"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Leader Test',
            'email' => 'LeaderTest001@test.com',
            'group_id' => 0,
            'position_id' => 2,
            'password' => bcrypt("123456"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Member Test',
            'email' => 'MemberTest001@test.com',
            'group_id' => 0,
            'position_id' => 3,
            'password' => bcrypt("123456"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Director Test',
            'email' => 'DirectorTest002@test.com',
            'group_id' => 0,
            'position_id' => 0,
            'password' => bcrypt("1234567"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Group Leader Test',
            'email' => 'GroupLeaderTest002@test.com',
            'group_id' => 0,
            'position_id' => 1,
            'password' => bcrypt("1234567"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Leader Test',
            'email' => 'LeaderTest002@test.com',
            'group_id' => 0,
            'position_id' => 2,
            'password' => bcrypt("1234567"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);

        User::create([
            'name' => 'Member Test',
            'email' => 'MemberTest002@test.com',
            'group_id' => 0,
            'position_id' => 3,
            'password' => bcrypt("1234567"),
            'started_date' => Carbon::now(),
            'created_date' => Carbon::now(),
            'updated_date' => Carbon::now()
        ]);
    }
}
