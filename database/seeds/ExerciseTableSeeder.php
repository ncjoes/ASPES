<?php

use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\User;
use Carbon\Carbon;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $creator = User::all()->first();
        factory(Exercise::class)->create([
            'title'=>'Best Database Lecturer of the Decade',
            'state'=>Exercise::IS_DRAFT,
            'start_at'=>Carbon::now(),
            'stop_at'=>Carbon::tomorrow(),
            'created_by'=>$creator->id
        ]);

        factory(Exercise::class)->create([
            'title'=>'Best HOD of the Year',
            'state'=>Exercise::IS_LIVE,
            'start_at'=>Carbon::now(),
            'stop_at'=>Carbon::tomorrow(),
            'created_by'=>$creator->id
        ]);

        factory(Exercise::class)->create([
            'title'=>'Female Lecturer of the Year',
            'state'=>Exercise::IS_PUBLISHED,
            'start_at'=>Carbon::now(),
            'stop_at'=>Carbon::tomorrow(),
            'created_by'=>$creator->id
        ]);
    }
}
