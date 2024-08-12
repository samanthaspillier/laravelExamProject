<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\faq;
use App\Models\ContactMessage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();

        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'bio' => 'Admin user',
            'password' => Hash::make('Password!123'),
        ]);
      
            

       // Post::factory(10)->create(); // create 10 random posts if display of pagination is needed

        Comment::factory(10)->create(); // create 10 random comments to display on the posts

       $this->call(FaqSeeder::class); // call to FAQ seeder. Fixed content
        
        $this->call(ContactMessageSeeder::class); // call to ContactMessage seeder. static content

        $this->call(PostSeeder::class); //call to Post seeder. Static content comming from https://malawiantour.wixsite.com/malawiantour-en

    
    
   
   
    }

  
}
