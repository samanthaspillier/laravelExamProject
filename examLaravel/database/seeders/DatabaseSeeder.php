<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\faq;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(15)->create();
/*
        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!123'),
        ]);

        
        User::factory()->admin()->create();
        */

        Post::factory(10)->create();

        Comment::factory(5)->create();

        DB::table('faqs')->insert([
            [
                'question' => 'What is included in the travel packages?',
                'answer' => 'Our travel packages typically include flights, accommodation, most meals, guided tours and activities. Please check the details of each package for a full list of inclusions.',
            ],
            [
                'question' => 'Do I need to complete the whole trip with you, or can I join for part of it and depart on my own afterwards?',
                'answer' => 'You can choose to join our trip for part of the journey and depart on your own afterwards. Please contact us to discuss your specific needs and we will help tailor the trip to your preferences.',
            ],
        ]);

        

    }

  
}
