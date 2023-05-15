<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Teacher;
use App\Models\Transfer;

class TransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transfer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::factory(),
            'current_place' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'from_school' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'to_school' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'reason_for_transfer' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'date_of_transfer' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'status' => $this->faker->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
