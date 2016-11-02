<?php

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Test abilities
        factory(Ability::class)->create();
        factory(Ability::class)->create(['key' => 'test-ability2']);
        factory(Ability::class)->create(['key' => 'test-ability3']);
    }
}
