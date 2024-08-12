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
        // User::factory(15)->create();
/*
        User::factory()->admin()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!123'),
        ]);

        
        User::factory()->admin()->create();
        */

       // Post::factory(10)->create();

        //Comment::factory(5)->create();

       // $this->call(FaqSeeder::class);
        
        // $this->call(ContactMessageSeeder::class);
        $this->call(PostSeeder::class);

    
    
   
   
    }

  
}
