<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Topic;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user_ids=User::all()->pluck('id')->toArray();
        $topics_ids=Topic::all()->pluck('id')->toArray();

        $faker=app(Faker\Generator::class);

        $replys=factory(Reply::class)
                        ->times(1000)
                        ->make()
                        ->each(function($reply,$index)
                        use($user_ids,$topics_ids,$faker)
        {
           $reply->user_id=$faker->randomElement($user_ids);
           $reply->topic_id=$faker->randomElement($topics_ids);
        });

        Reply::insert($replys->toArray());

    }
}
