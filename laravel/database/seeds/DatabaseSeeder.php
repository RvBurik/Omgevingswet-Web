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
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);
    }
}

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'gebruikersnaam' => 'RvBurik',
            'voornaam' => 'Ricardo',
            'tussenvoegsel' => 'van',
            'achternaam' => 'Burik',
            'geboortedatum' => '1996\08\01',
            'geslacht' => 'M',
            'email' => 'rvburik@hotmail.com',
            'password' => bcrypt('tmp123'),
        ]);

        factory(App\User::class, 3)->create();
    }
}

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Project::class, 15)->create();
    }
}
