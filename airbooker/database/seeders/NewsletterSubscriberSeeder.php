<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscribers = [
            ['email' => 'subscriber1@example.com'],
            ['email' => 'subscriber2@example.com'],
            ['email' => 'subscriber3@example.com'],
        ];

        foreach ($subscribers as $subscriberData) {
            NewsletterSubscriber::create($subscriberData);
        }
    }
}
