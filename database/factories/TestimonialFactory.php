<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
            'deleted_at' => null,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
