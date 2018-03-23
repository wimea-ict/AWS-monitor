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
        // $this->call(UsersTableSeeder::class);
        factory(station\User::class, 50)->create();

        // // Seed dummy tags
        // factory(station\Station::class, 20)->create();

        // $tagIds = DB::table('stations')->pluck('id')->toArray();

        // // Seed dummy users
        // factory(App\User::class, 10)->create()->each(function($user) use($tagIds)
        // {
        //     // With dummy questions
        //     $user->questions()->saveMany(factory(App\Question::class, 3)
        //     ->create(['user_id' => $user->id])->each(function($question) use($tagIds)
        //     {
        //         // With dummy tags
        //         $question->tags()->sync(array_random($tagIds, mt_rand(1, 5)));
        //     }));
        // });
        
    }
}
