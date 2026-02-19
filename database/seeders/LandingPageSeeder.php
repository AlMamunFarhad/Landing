<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('landing_pages')->insert([
            // ===============================
            // Basic Page Info
            // ===============================
            'title'          => 'শাহী মসলা - বিশেষ অফার',
            'slug'           => 'shahi-masala',
            'is_published'   => true,
            'button_text'    => 'অর্ডার করতে চাই',
            'contact_number' => '01869684533',

            // =====================================================
            // Section 1: Hero Section
            // =====================================================
            'hero_title'        => '২০ টি সিক্রেট মশলার সমন্বয়ে তৈরি',
            'hero_subtitle'     => 'আপনি চিটাগাং এর যেকোনো লোক হোক থেকে কেনো পুরান ঢাকার কারিগর কিংবা মগ সাহেবের কলরব টুনা থেকে কেনো যেখানে সব কিছুই একটি একটি রান্নার জন্য আপনার সব নিজে রাখা করতে পারবেন।',
            'hero_youtube_link' => 'https://www.youtube.com/embed/your_video_id',

            // =====================================================
            // Section 2: Products Section
            // =====================================================
            'product_title'    => 'যে সকল উপাদানে তৈরি?',
            'product_subtitle' => 650.00,
            'product_image'    => 'images/product.png',

            // =====================================================
            // Section 3: Why Trust Us Section
            // =====================================================
            'why_trust_us_title'       => 'আমাদের উপর কেন আস্থা রাখবেন?',
            'why_trust_us_description' => 'আমাদের মশলা সম্পূর্ণ প্রাকৃতিক উপাদান দিয়ে তৈরি। কোনো কৃত্রিম রং বা প্রিজারভেটিভ ব্যবহার করা হয় না। আমরা বছরের পর বছর ধরে বিশ্বস্ততার সাথে সেবা দিয়ে আসছি।',
            'why_trust_us_image'       => 'images/why_trust.png',

            // =====================================================
            // Section 4: Why Choose Us Section
            // =====================================================
            'why_choose_title'       => 'শাহী গরম মশলা দিয়ে আপনি রান্না করতে পারবেন',
            'why_choose_description' => 'রান্নাঘরের প্রতিটি রান্নায় শাহী মশলার অনন্য স্বাদ আপনার রান্নাকে করবে অসাধারণ। সহজে ব্যবহারযোগ্য এবং দীর্ঘস্থায়ী সুগন্ধ আপনার রান্নাকে নিয়ে যাবে অন্য মাত্রায়।',

            // =====================================================
            // Products ID (JSON Array)
            // =====================================================
            'product_id' => json_encode([1, 2, 3]),

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
