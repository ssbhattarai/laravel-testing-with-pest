<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => "talentql pipeline program is top notch",
            "excerpt" => "Building on the success of its technical outsourcing and recruitment service",
            "content" => "The program, which is focused on training and upskilling mid-level software engineers across the continent to Senior Software Engineers",
        ];
    }
}
