<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * use command (php artisan db:seed) to run seedings
     * @return void
     */
    public function run()
    {
        //User factory are built in
        \App\Models\User::factory(5)->create();

        //create dummy data for listing without factory
        \App\Models\Listing::create(
            [
                'user_id' => 1,
                'title' => 'Laravel Senior Developer',
                'tags' => 'laravel, javascript',
                'company' => 'Acme Corp',
                'location' => 'Boston, MA',
                'email' => 'email1@email.com',
                'website' => 'https://www.acme.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
            ]
        );

        \App\Models\Listing::create(
            [
                'user_id' => 1,
                'title' => 'Full-Stack Engineer',
                'tags' => 'laravel, backend ,api',
                'company' => 'Stark Industries',
                'location' => 'New York, NY',
                'email' => 'email2@email.com',
                'website' => 'https://www.starkindustries.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
            ]
        );


         //create dummy data for listing with factory
         //first you have to create factory for listing (ListingFactory)
        // \App\Models\Listing::factory(2)->create();
    }
}
