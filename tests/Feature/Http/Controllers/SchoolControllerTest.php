<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SchoolController
 */
class SchoolControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $schools = School::factory()->count(3)->create();

        $response = $this->get(route('school.index'));

        $response->assertOk();
        $response->assertViewIs('school.index');
        $response->assertViewHas('schools');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('school.create'));

        $response->assertOk();
        $response->assertViewIs('school.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SchoolController::class,
            'store',
            \App\Http\Requests\SchoolStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('school.store'), [
            'name' => $name,
        ]);

        $schools = School::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $schools);
        $school = $schools->first();

        $response->assertRedirect(route('school.index'));
        $response->assertSessionHas('school.id', $school->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $school = School::factory()->create();

        $response = $this->get(route('school.show', $school));

        $response->assertOk();
        $response->assertViewIs('school.show');
        $response->assertViewHas('school');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $school = School::factory()->create();

        $response = $this->get(route('school.edit', $school));

        $response->assertOk();
        $response->assertViewIs('school.edit');
        $response->assertViewHas('school');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SchoolController::class,
            'update',
            \App\Http\Requests\SchoolUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $school = School::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('school.update', $school), [
            'name' => $name,
        ]);

        $school->refresh();

        $response->assertRedirect(route('school.index'));
        $response->assertSessionHas('school.id', $school->id);

        $this->assertEquals($name, $school->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $school = School::factory()->create();

        $response = $this->delete(route('school.destroy', $school));

        $response->assertRedirect(route('school.index'));

        $this->assertModelMissing($school);
    }
}
