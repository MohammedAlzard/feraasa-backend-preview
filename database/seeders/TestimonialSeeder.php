<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::create([
           'image' => '/uploads/admin/testimonials/testimonial-1.png',
           'order_by' => 1,
           'is_active' => true,
            'en' => [
                'name' => 'Edward Collind',
                'job' => 'CTO at Nitbee',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,  scrambled it to make a type specimen book.',
            ],
            'ar' => [
                'name' => 'Edward Collind',
                'job' => 'CTO at Nitbee',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,  scrambled it to make a type specimen book.',
            ],
        ]);
    }
}
