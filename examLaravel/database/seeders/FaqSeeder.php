<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I book a tour?',
                'category' => 'Booking and Reservations',
                'answer' => 'Our travel packages typically include flights, accommodation, most meals, guided tours and activities. Please check the details of each package for a full list of inclusions.',
            ],
            [
                'question' => 'Can I modify or cancel my booking?',
                'category' => 'Booking and Reservations',
                'answer' => 'You can choose to join our trip for part of the journey and depart on your own afterwards. Please contact us to discuss your specific needs and we will help tailor the trip to your preferences.',
            ],
            [
                'question' => 'Are there any special discounts or packages available?',
                'category' => 'Booking and Reservations',
                'answer' => 'We offer a range of discounts and special offers for our tours. Please check our website for the latest deals and promotions.',
            ],
            [
                'question' => 'What is the best time of year to visit Malawi?',
                'category' => 'About Malawi',
                'answer' => 'The best time to visit Malawi is during the dry season, from May to October. This is when the weather is warm and sunny, and the wildlife is most active.',
            ],
            [
                'question' => 'What is the currency in Malawi?',
                'category' => 'About Malawi',
                'answer' => 'The currency in Malawi is the Malawian Kwacha (MWK). US dollars and British pounds are also widely accepted in major tourist areas.',
            ],
            [
                'question' => 'What is the official language of Malawi?',
                'category' => 'About Malawi',
                'answer' => 'The official language of Malawi is English. Chichewa is also widely spoken throughout the country.',
            ],
            [
                'question' => 'Do I need a visa to travel to Malawi?',
                'category' => 'Travel Requirements & Recommendations',
                'answer' => 'Most visitors to Malawi require a visa to enter the country. Visas can be obtained on arrival at the airport or at the border, or in advance from a Malawian embassy or consulate.',
            ],
            [
                'question' => 'What vaccinations do I need for Malawi?',
                'category' => 'Travel Requirements & Recommendations',
                'answer' => 'All visitors to Malawi should be up-to-date on routine vaccinations, including measles-mumps-rubella (MMR), diphtheria-tetanus-pertussis, varicella (chickenpox), polio, and influenza. Most travelers should also be vaccinated against hepatitis A and typhoid.',
            ],
            [
                'question' => 'What should I pack for my trip to Malawi?',
                'category' => 'Travel Requirements & Recommendations',
                'answer' => 'You should pack lightweight, breathable clothing for warm weather, as well as a sweater or jacket for cooler evenings. A hat, sunglasses, and sunscreen are essential to protect against the strong African sun. You should also bring insect repellent, a first aid kit, and any prescription medications you require. In some villages where contact with Westerners is less common, inhabitants may feel uncomfortable with revealing clothing. It is recommended to wear long pants and long sleeves in these areas.',
            ],
        ];
        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }

        
    }
}
