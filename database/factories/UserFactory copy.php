<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'cin' => $this->faker->unique()->randomNumber(8),
            'date_birth' => $this->faker->date(),
            'cnss' => $this->faker->unique()->randomNumber(8),
            'contrat_date' => $this->faker->date(),
            'contrat_type' => function () {
                return Contrat::factory()->create()->id;
            },
            'position_id' => function () {
                return Position::factory()->create()->id;
            },
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
class ContratFactory extends Factory
{
    protected $model = Contrat::class;
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
        ];
    }
}
