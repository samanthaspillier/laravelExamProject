<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run()
    {
        ContactMessage::create([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'subject' => 'Question about booking a tour',
            'message' => 'I would like more information about the available tour packages and their inclusions. Could you please provide details?',
            'category' => 'faq_request',
        ]);

        ContactMessage::create([
            'name' => 'Bob Smith',
            'email' => 'bob.smith@example.com',
            'subject' => 'Special discount for group travel',
            'message' => 'We are a group of 10 planning a trip to Malawi. Are there any special discounts or packages for group travel?',
            'category' => 'faq_request',
        ]);

        ContactMessage::create([
            'name' => 'Charlie Davis',
            'email' => 'charlie.davis@example.com',
            'subject' => 'Feedback on recent tour',
            'message' => 'I recently returned from a tour organized by your agency. I wanted to provide feedback on the experience and suggest improvements.',
            'category' => 'other',
        ]);

        ContactMessage::create([
            'name' => 'Dana Lee',
            'email' => 'dana.lee@example.com',
            'subject' => 'Inquiry about visa requirements',
            'message' => 'Can you provide information on visa requirements for traveling to Malawi? I want to ensure all documentation is in order before my trip.',
            'category' => 'faq_request',
        ]);

        ContactMessage::create([
            'name' => 'Ella Green',
            'email' => 'ella.green@example.com',
            'subject' => 'General inquiry',
            'message' => 'I have a few questions regarding travel insurance and what it covers for trips to Malawi. Could you please provide more details?',
            'category' => 'other',
        ]);
    }
}

