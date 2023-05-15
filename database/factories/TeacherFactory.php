<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Teacher;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'email' => $this->faker->safeEmail,
            'gender' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'role' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'phone' => $this->faker->phoneNumber,
            'id_no' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'dob' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'grade_level' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'district' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'province' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'class_course' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'qualification' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'school' => $this->faker->regexify('[A-Za-z0-9]{150}'),
            'tchr_password' => $this->faker->regexify('[A-Za-z0-9]{8}'),
        ];
    }
}
