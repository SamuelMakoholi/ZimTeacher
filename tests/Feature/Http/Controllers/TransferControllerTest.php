<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Teacher;
use App\Models\Transfer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TransferController
 */
class TransferControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $transfers = Transfer::factory()->count(3)->create();

        $response = $this->get(route('transfer.index'));

        $response->assertOk();
        $response->assertViewIs('transfer.index');
        $response->assertViewHas('transfers');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('transfer.create'));

        $response->assertOk();
        $response->assertViewIs('transfer.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransferController::class,
            'store',
            \App\Http\Requests\TransferStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $teacher = Teacher::factory()->create();
        $current_place = $this->faker->word;
        $from_school = $this->faker->word;
        $to_school = $this->faker->word;
        $reason_for_transfer = $this->faker->word;
        $date_of_transfer = $this->faker->word;
        $status = $this->faker->word;

        $response = $this->post(route('transfer.store'), [
            'teacher_id' => $teacher->id,
            'current_place' => $current_place,
            'from_school' => $from_school,
            'to_school' => $to_school,
            'reason_for_transfer' => $reason_for_transfer,
            'date_of_transfer' => $date_of_transfer,
            'status' => $status,
        ]);

        $transfers = Transfer::query()
            ->where('teacher_id', $teacher->id)
            ->where('current_place', $current_place)
            ->where('from_school', $from_school)
            ->where('to_school', $to_school)
            ->where('reason_for_transfer', $reason_for_transfer)
            ->where('date_of_transfer', $date_of_transfer)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $transfers);
        $transfer = $transfers->first();

        $response->assertRedirect(route('transfer.index'));
        $response->assertSessionHas('transfer.id', $transfer->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $transfer = Transfer::factory()->create();

        $response = $this->get(route('transfer.show', $transfer));

        $response->assertOk();
        $response->assertViewIs('transfer.show');
        $response->assertViewHas('transfer');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $transfer = Transfer::factory()->create();

        $response = $this->get(route('transfer.edit', $transfer));

        $response->assertOk();
        $response->assertViewIs('transfer.edit');
        $response->assertViewHas('transfer');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransferController::class,
            'update',
            \App\Http\Requests\TransferUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $transfer = Transfer::factory()->create();
        $teacher = Teacher::factory()->create();
        $current_place = $this->faker->word;
        $from_school = $this->faker->word;
        $to_school = $this->faker->word;
        $reason_for_transfer = $this->faker->word;
        $date_of_transfer = $this->faker->word;
        $status = $this->faker->word;

        $response = $this->put(route('transfer.update', $transfer), [
            'teacher_id' => $teacher->id,
            'current_place' => $current_place,
            'from_school' => $from_school,
            'to_school' => $to_school,
            'reason_for_transfer' => $reason_for_transfer,
            'date_of_transfer' => $date_of_transfer,
            'status' => $status,
        ]);

        $transfer->refresh();

        $response->assertRedirect(route('transfer.index'));
        $response->assertSessionHas('transfer.id', $transfer->id);

        $this->assertEquals($teacher->id, $transfer->teacher_id);
        $this->assertEquals($current_place, $transfer->current_place);
        $this->assertEquals($from_school, $transfer->from_school);
        $this->assertEquals($to_school, $transfer->to_school);
        $this->assertEquals($reason_for_transfer, $transfer->reason_for_transfer);
        $this->assertEquals($date_of_transfer, $transfer->date_of_transfer);
        $this->assertEquals($status, $transfer->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $transfer = Transfer::factory()->create();

        $response = $this->delete(route('transfer.destroy', $transfer));

        $response->assertRedirect(route('transfer.index'));

        $this->assertModelMissing($transfer);
    }
}
