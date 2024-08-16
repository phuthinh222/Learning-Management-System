<?php

namespace Tests\Feature\Teacher\Certificate;

use App\Models\Certificate;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteCertificateTest extends TestCase
{
    #[Test]
    public function user_can_delete_certificate(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getTeacherId())->delete($this->getRouteDestroy($teacher, $certificate));

        $response->assertStatus(200);
    }
    #[Test]
    public function user_can_not_delete_certificate_when_not_log_in(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->delete($this->getRouteDestroy($teacher, $certificate));

        $response->assertRedirect(route('login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }
    #[Test]
    public function user_can_not_delete_certificate_if_role_of_student(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getStudendId())->delete($this->getRouteDestroy($teacher, $certificate));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    #[Test]
    public function user_can_not_delete_certificate_if_role_of_admin(): void
    {
        $teacher = Teacher::factory()->create();
        $certificate = Certificate::factory()->create([
            'id_teacher' => $teacher->id,
        ]);
        $response = $this->actingAs($this->getAdminId())->delete($this->getRouteDestroy($teacher, $certificate));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
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
    public function getRouteDestroy(Teacher $teacher, Certificate $certificate)
    {
        return route('certificates.destroy', [
            'teacher' => $teacher->id,
            'certificate' => $certificate->id,
        ]);
    }
}
