<?php

namespace TomatoPHP\FilamentFormBuilder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TomatoPHP\FilamentFormBuilder\Models\Form;

/**
 * @extends Factory<Form>
 */
class FormFactory extends Factory
{
    protected $model = Form::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['page', 'modal', 'slideover']),
            'title' => ['en' => ucfirst($this->faker->words(2, true))],
            'description' => ['en' => $this->faker->sentence()],
            'key' => $this->faker->unique()->slug(2),
            'endpoint' => '/',
            'method' => 'POST',
            'is_active' => true,
        ];
    }
}
