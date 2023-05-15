<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Leave;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LeaveController
 */
class LeaveControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $leaves = Leave::factory()->count(3)->create();

        $response = $this->get(route('leave.index'));

        $response->assertOk();
        $response->assertViewIs('leave.index');
        $response->assertViewHas('leaves');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('leave.create'));

        $response->assertOk();
        $response->assertViewIs('leave.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveController::class,
            'store',
            \App\Http\Requests\LeaveStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $teacher = Teacher::factory()->create();
        $start_date = $this->faker->word;
        $end_date = $this->faker->word;
        $leave_type = $this->faker->word;
        $reason_for_leave = $this->faker->word;
        $status = $this->faker->word;

        $response = $this->post(route('leave.store'), [
            'teacher_id' => $teacher->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'leave_type' => $leave_type,
            'reason_for_leave' => $reason_for_leave,
            'status' => $status,
        ]);

        $leaves = Leave::query()
            ->where('teacher_id', $teacher->id)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->where('leave_type', $leave_type)
            ->where('reason_for_leave', $reason_for_leave)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $leaves);
        $leave = $leaves->first();

        $response->assertRedirect(route('leave.index'));
        $response->assertSessionHas('leave.id', $leave->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $leave = Leave::factory()->create();

        $response = $this->get(route('leave.show', $leave));

        $response->assertOk();
        $response->assertViewIs('leave.show');
        $response->assertViewHas('leave');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $leave = Leave::factory()->create();

        $response = $this->get(route('leave.edit', $leave));

        $response->assertOk();
        $response->assertViewIs('leave.edit');
        $response->assertViewHas('leave');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LeaveController::class,
            'update',
            \App\Http\Requests\LeaveUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $leave = Leave::factory()->create();
        $teacher = Teacher::factory()->create();
        $start_date = $this->faker->word;
        $end_date = $this->faker->word;
        $leave_type = $this->faker->word;
        $reason_for_leave = $this->faker->word;
        $status = $this->faker->word;

        $response = $this->put(route('leave.update', $leave), [
            'teacher_id' => $teacher->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'leave_type' => $leave_type,
            'reason_for_leave' => $reason_for_leave,
            'status' => $status,
        ]);

        $leave->refresh();

        $response->assertRedirect(route('leave.index'));
        $response->assertSessionHas('leave.id', $leave->id);

        $this->assertEquals($teacher->id, $leave->teacher_id);
        $this->assertEquals($start_date, $leave->start_date);
        $this->assertEquals($end_date, $leave->end_date);
        $this->assertEquals($leave_type, $leave->leave_type);
        $this->assertEquals($reason_for_leave, $leave->reason_for_leave);
        $this->assertEquals($status, $leave->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $leave = Leave::factory()->create();

        $response = $this->delete(route('leave.destroy', $leave));

        $response->assertRedirect(route('leave.index'));

        $this->assertModelMissing($leave);
    }
}
