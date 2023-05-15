<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TeacherController
 */
class TeacherControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $teachers = Teacher::factory()->count(3)->create();

        $response = $this->get(route('teacher.index'));

        $response->assertOk();
        $response->assertViewIs('teacher.index');
        $response->assertViewHas('teachers');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('teacher.create'));

        $response->assertOk();
        $response->assertViewIs('teacher.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeacherController::class,
            'store',
            \App\Http\Requests\TeacherStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $full_name = $this->faker->word;
        $email = $this->faker->safeEmail;
        $gender = $this->faker->word;
        $role = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $id_no = $this->faker->word;
        $dob = $this->faker->word;
        $grade_level = $this->faker->word;
        $district = $this->faker->word;
        $province = $this->faker->word;
        $class_course = $this->faker->word;
        $qualification = $this->faker->word;
        $school = $this->faker->word;
        $tchr_password = $this->faker->word;

        $response = $this->post(route('teacher.store'), [
            'full_name' => $full_name,
            'email' => $email,
            'gender' => $gender,
            'role' => $role,
            'phone' => $phone,
            'id_no' => $id_no,
            'dob' => $dob,
            'grade_level' => $grade_level,
            'district' => $district,
            'province' => $province,
            'class_course' => $class_course,
            'qualification' => $qualification,
            'school' => $school,
            'tchr_password' => $tchr_password,
        ]);

        $teachers = Teacher::query()
            ->where('full_name', $full_name)
            ->where('email', $email)
            ->where('gender', $gender)
            ->where('role', $role)
            ->where('phone', $phone)
            ->where('id_no', $id_no)
            ->where('dob', $dob)
            ->where('grade_level', $grade_level)
            ->where('district', $district)
            ->where('province', $province)
            ->where('class_course', $class_course)
            ->where('qualification', $qualification)
            ->where('school', $school)
            ->where('tchr_password', $tchr_password)
            ->get();
        $this->assertCount(1, $teachers);
        $teacher = $teachers->first();

        $response->assertRedirect(route('teacher.index'));
        $response->assertSessionHas('teacher.id', $teacher->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teacher.show', $teacher));

        $response->assertOk();
        $response->assertViewIs('teacher.show');
        $response->assertViewHas('teacher');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teacher.edit', $teacher));

        $response->assertOk();
        $response->assertViewIs('teacher.edit');
        $response->assertViewHas('teacher');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeacherController::class,
            'update',
            \App\Http\Requests\TeacherUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $teacher = Teacher::factory()->create();
        $full_name = $this->faker->word;
        $email = $this->faker->safeEmail;
        $gender = $this->faker->word;
        $role = $this->faker->word;
        $phone = $this->faker->phoneNumber;
        $id_no = $this->faker->word;
        $dob = $this->faker->word;
        $grade_level = $this->faker->word;
        $district = $this->faker->word;
        $province = $this->faker->word;
        $class_course = $this->faker->word;
        $qualification = $this->faker->word;
        $school = $this->faker->word;
        $tchr_password = $this->faker->word;

        $response = $this->put(route('teacher.update', $teacher), [
            'full_name' => $full_name,
            'email' => $email,
            'gender' => $gender,
            'role' => $role,
            'phone' => $phone,
            'id_no' => $id_no,
            'dob' => $dob,
            'grade_level' => $grade_level,
            'district' => $district,
            'province' => $province,
            'class_course' => $class_course,
            'qualification' => $qualification,
            'school' => $school,
            'tchr_password' => $tchr_password,
        ]);

        $teacher->refresh();

        $response->assertRedirect(route('teacher.index'));
        $response->assertSessionHas('teacher.id', $teacher->id);

        $this->assertEquals($full_name, $teacher->full_name);
        $this->assertEquals($email, $teacher->email);
        $this->assertEquals($gender, $teacher->gender);
        $this->assertEquals($role, $teacher->role);
        $this->assertEquals($phone, $teacher->phone);
        $this->assertEquals($id_no, $teacher->id_no);
        $this->assertEquals($dob, $teacher->dob);
        $this->assertEquals($grade_level, $teacher->grade_level);
        $this->assertEquals($district, $teacher->district);
        $this->assertEquals($province, $teacher->province);
        $this->assertEquals($class_course, $teacher->class_course);
        $this->assertEquals($qualification, $teacher->qualification);
        $this->assertEquals($school, $teacher->school);
        $this->assertEquals($tchr_password, $teacher->tchr_password);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->delete(route('teacher.destroy', $teacher));

        $response->assertRedirect(route('teacher.index'));

        $this->assertModelMissing($teacher);
    }
}
