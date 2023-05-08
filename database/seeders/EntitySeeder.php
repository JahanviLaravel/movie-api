<?php

namespace Database\Seeders;

use App\Models\Entities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entities = [
          'movies',
          'books'        ];

        foreach($entities as $entity) {
            Entities::create(['entityType' => $entity]);
        }
    }
}
