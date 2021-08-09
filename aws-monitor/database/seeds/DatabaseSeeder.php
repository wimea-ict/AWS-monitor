<?php

use Illuminate\Database\Seeder;
use station\Models\User;
use station\Models\Node;
use station\Models\Sensor;
use station\Station;
use station\Models\NodeStatus;
use station\Models\NodeStatusConfiguration;

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
        User::factory()->count(50)->create();

        // factory(Station::class, 5)->create()->each(function($station)
        // {

        // $station->nodes()->saveMany(
        //     factory(Node::class, 5)->create()->each(function($node)
        //     {
        //         // With dummy questions
        //         $node->sensors()->saveMany(factory(Sensor::class, 4)
        //         ->create(['node_id' => $node->node_id])->each(function($sensor)
        //         {
        //             // With dummy tags
        //         // $question->tags()->sync(array_random($tagIds, mt_rand(1, 5)));
        //         }));
        //     })
        // );
        $stations = Station::factory()->count(30)->create();
        foreach ($stations as $station) {
            //factory(Node::class,5)->create(['station_id' => $station->station_id]);
            $nodes = $station->nodes()->saveMany(Node::factory()->count(3)->make());
            foreach ($nodes as $node) {
                $sensors = $node->sensors()->saveMany(Sensor::factory()->count(5)->make());
            }
        }
    }
}
