<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Leave;
use App\Models\Teacher;

class LeaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leave::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::factory(),
            'start_date' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'end_date' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'leave_type' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'reason_for_leave' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'status' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
