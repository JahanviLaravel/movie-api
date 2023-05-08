<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actors = [
          'Robert De Niro',
          'Jack Nicholson',
          'Marlon Brando',
          'Denzel Washington',
          'Katharine Hepburn',
          'Humphrey Bogart',
          'Meryl Streep'
        ];

        foreach($actors as $actor) {
            Actor::create(['name' => $actor]);
        }
    }
}
