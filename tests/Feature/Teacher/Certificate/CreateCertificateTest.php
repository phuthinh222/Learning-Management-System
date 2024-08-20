<?php

namespace Tests\Feature\Teacher\Certificate;

use App\Models\Certificate;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCertificateTest extends TestCase
{
    #[Test]
    public function user_can_created_certificate(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create(
            [
                'id_teacher' => $teacher->id,
            ]
        )->toArray();
        // dd($certificate);
        $response = $this->actingAs($this->getTeacherId())->post(route('certificates.store', ['teacher' => $teacher->id]), $certificate);
        $this->assertDatabaseHas('certificates', $certificate);
        $response->assertStatus(Response::HTTP_OK);
    }

    #[Test]
    public function user_cannot_created_certificate_when_not_logged_in(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->get(route('certificates.create', ['teacher' => $teacher->id]));
        $response->assertRedirect(route('login'));
    }
    #[Test]
    public function user_can_view_created_certificate(): void
    {
        $teacher = Teacher::factory()->create();
        $response = $this->actingAs($this->getTeacherId())->get(route('certificates.create', ['teacher' => $teacher->id]));

        $response->assertStatus(200);
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }
}
