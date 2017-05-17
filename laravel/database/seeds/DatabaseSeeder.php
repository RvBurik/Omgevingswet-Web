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
        //$this->call(ProjectSeeder::class);
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
            'geboortedatum' => '1996-08-01',
            'geslacht' => 'M',
            'MAILADRES' => 'rvburik@hotmail.com',
            'WACHTWOORD' => bcrypt('tmp123'),
        ]);

		\App\User::create([
			'gebruikersnaam' => 'omgevingswet',
            'voornaam' => 'Omgevings',
            'tussenvoegsel' => null,
            'achternaam' => 'Wet',
            'geboortedatum' => '1970-01-01',
            'geslacht' => 'M',
            'mailadres' => 'test@omgevingswet.net',
            'wachtwoord' => bcrypt('omgevingswet'),
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
