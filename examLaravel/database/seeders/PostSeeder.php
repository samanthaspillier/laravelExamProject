<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

  

    public function run(): void
    {

        // Create an instance of Faker
        $faker = Faker::create();

        Post::create([
        'title' => 'Magnificent landscapes in Nyika National Park',
        'content' => "LThe largest and oldest of Malawi's nature reserves, Nyika National Park is perched more than 2,300 m high on the Nyika Plateau. Its hilly landscape is composed of grassy savannah and tree savanna. This is an ideal habitat for many antelopes and zebras. Leopards and hyenas are not uncommon. For lodging, Chelinda Lodge will welcome you to its luxurious rooms while Chelinda Camp will offer you proximity to nature and animals.",
        'cover_image' => 'images/covers/Nyika.png',
        'published_at' => $faker->dateTimeBetween('-1 month', 'now'),
    
        ]);
        Post::create([
            'title' => 'Wild nature on the banks of Lake Kazuni - Vwaza Marsh Wildlife Reserve',
            'content' => "Small reserve of the North with undeniable charm, the Vwaza Marsh Wildlife Reserve is very little equipped. Yet on the shores of Lake Kazuni, right at the entrance to the park, is a charming host infrastructure. A friendly and dedicated staff will go out of their way to make your stay enjoyable. Elephants pass by on a regular basis to bathe in the lake. The lake is home to many birds, but mostly a plethora of hippos.",
            'cover_image' => 'images/covers/Vwaza.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

        
            ]);
        Post::create([
            'title' => 'The calm of the Viphya Forest Reserve',
            'content' => "Immerse yourself in the calm of the Viphya Forest Reserve. A relaxing stay with some walks in the forest to observe monkeys and animals. For your accommodation, Luwawa Forest Lodge offers reasonably priced rooms and a campsite. A small restaurant offers decent meals at an affordable price. Otherwise, the barbecue is at your disposal to prepare your meals.",
            'cover_image' => 'images/covers/Viphya.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

    
        ]);
        Post::create([
            'title' => 'A growing city, Mzuzu',
            'content' => "Chief town of the Northern Region, Mzuzu is a small city in full development. Its economy remains based on agriculture but some industries are present. Moreover, the coffee of Mzuzu, as well as its honey, are of excellent quality. You will also be able to visit the market, lively and colorful place of the city",
            'cover_image' => 'images/covers/Mzuzu.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

    
        ]);

        Post::create([
            'title' => 'Touristy Mkhata Bay',
            'content' => "Nkhata Bay is the most touristic city in the Northern Region. It must be said that it does not lack of attraction with its superb views on the bay. You can also visit the busy port, a place of human and commercial exchanges. With Ilala, a ferry that winds along the lake, you can also reach the islands of Likoma and Chizumulu, near the Mozambican coast. Random of your walks, you will be able to fill up of memories in the stalls of the artists and craftsmen of Nkhata Bay.",
            'cover_image' => 'images/covers/MkhataBay.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),
       
        ]);

        Post::create([
            'title' => 'Livingstonia, a city full of history perched on the Nyika Plateau',
            'content' => "The city of Livingstonia is perched on the flanks of the Nyika Plateau. Two possibilities to reach it: the walk or the car. In both cases, the road will be hard and you will have deserved your day of relaxation with the visit of the superb church and the university of Victorian style, but also Manchewe Falls with all their legends",
            'cover_image' => 'images/covers/Livingstonia.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

        
        ]);

        Post::create([
            'title' => 'Karonga, a city of human history',
            'content' => "CDistrict capital, Karonga is a small quiet town in the north, close to the lake. You will discover an interesting museum about the history of man and the archaeological discoveries of Malawi. The visit lasts an hour, during which you will have the opportunity to see many fossils as well as the reconstruction of a dinosaur in real size.",
            'cover_image' => 'images/covers/Karonga.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

        ]);

        Post::create([
            'title' => 'The small village of Misuku, experts on coffee',
            'content' => "Perched on the flanks of Misuku Hill, Misuku is a small village whose economy is essentially based on coffee culture. You can visit the plantations and see the whole process before roasting. But Misku is also access to a primary forest still largely preserved in which you will plunge with happiness to listen to the song of the monkeys, brought to that of the hornbills and other birds. You will discover trees with dimensions unknown to us and a flora like no other.",
            'cover_image' => 'images/covers/Misuku.png',
            'published_at' => $faker->dateTimeBetween('-1 month', 'now'),

        ]);
    }
}
