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
        $this->call(AbilitiesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ExerciseTableSeeder::class);
        $this->call(InvitationTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(EvaluatorTableSeeder::class);
        $this->call(FactorTableSeeder::class);
        $this->call(FCVTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(ComparisonTableSeeder::class);
        $this->call(EvaluationTableSeeder::class);
    }
}
