<?php

namespace Tests\Feature\Teacher\Certificate;

use App\Models\Certificate;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCertificateTest extends TestCase
{
    #[Test]
    public function user_can_see_view_updated_certificate(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getTeacherId())->get(route('certificates.edit', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]));

        $response->assertStatus(Response::HTTP_OK);
    }
    #[Test]
    public function user_can_not_see_view_certificate_when_not_log_in(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->get(route('certificates.edit', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]));

        $response->assertRedirect(route('login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }
    #[Test]
    public function user_can_not_see_view_certificate_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getStudendId())->get(route('certificates.edit', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    #[Test]
    public function user_can_not_see_view_certificate_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getAdminId())->get(route('certificates.edit', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    #[Test]
    public function user_can_update_certificate(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $data = [
            'major' => 'Updated major',
            'level' => 'Updated level',
            'school' => 'Academy'
        ];
        $response = $this->actingAs($this->getTeacherId())->put(route('certificates.update', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]), $data);

        $this->assertDatabaseHas('certificates', $data);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function getTeacherId()
    {
        $user = User::factory()->create()->assignRole('Teacher');
        return $user;
    }
    public function getStudendId()
    {
        $user = User::factory()->create()->assignRole('Student');
        return $user;
    }
    public function getAdminId()
    {
        $user = User::factory()->create()->assignRole('Admin');
        return $user;
    }
}
