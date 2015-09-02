<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 20; $i++) {

            $cinema = App\Cinema::create(array(
                'name' => 'Cinema ' . $faker->lastName,
                'address' => $faker->address,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude
            ));

            $movie = App\Movie::create(array(
                'title' => $faker->sentence($nbWords = 4)
            ));

            // might want to make this a little more mixed up, add a couple of sessions for each movie
            $session = App\SessionTime::create(array(
                'movie_id' => $movie->id,
                'cinema_id' => $cinema->id,
                'session_time' => $faker->dateTimeThisMonth
            ));
        }

        Model::reguard();
    }
}
