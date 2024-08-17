<?php

namespace Tests\Unit;

use App\Http\Requests\Student\UpdateInformationRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateInformationTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    public function rules_of_student_information()
    {
        $request = new UpdateInformationRequest();
        return $request->rules();
    }
    public function editStudentInformationRoute($id)
    {
        return route('student.edit', $id);
    }
    public function updateInformationStudentRoute($id)
    {
        return route('student.update', $id);
    }
    public function createStudentAccount()
    {
        return $this->createUser()->assignRole('Student');
    }

    /** @test */
    public function unauth_user_can_not_access_form_update()
    {
        $user = $this->createUser()->assignRole('Admin');
        $response = $this->getTestWithAuth($this->editStudentInformationRoute($user->id), $user);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
    /** @test */
    public function unauth_user_can_not_update_form()
    {
        $user = $this->createUser()->assignRole('Teacher');
        $response = $this->getTestWithAuth($this->editStudentInformationRoute($user->id), $user);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function auth_user_can_access_form_update()
    {
        $user = $this->createStudentAccount();
        $response = $this->getTestWithAuth($this->editStudentInformationRoute($user->id), $user);

        $response->assertStatus(Response::HTTP_OK)->assertViewIs('students.update_information');
    }
    /** @test */
    public function auth_user_can_not_update_if_invalid_name()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'Invalid@@@',
            'address' => 'valid address',
            'phone_number' => '+84911111111',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['name' => __('validation.custom.name.regex')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_null_name()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => '',
            'address' => 'valid address',
            'phone_number' => '+84911111111',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['name' => __('validation.custom.name.required')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_null_address()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => '',
            'phone_number' => '+84911111111',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['address' => __('validation.custom.address.required')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_invalid_address()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'invalid @@@',
            'phone_number' => '+84911111111',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['address' => __('validation.custom.address.regex')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_too_long_address()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => str_repeat('Thua thien hue, ', 15),
            'phone_number' => '+84911111111',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['address' => __('validation.custom.address.max')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_null_phone()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => '',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['phone_number' => __('validation.custom.phone_number.required')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_invalid_phone()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => 'Invalid phone number',
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['phone_number' => __('validation.custom.phone_number.regex')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_exists_phone()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $user1 = User::factory()->create(['phone_number' => '+84911111111']);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => $user1->phone_number,
            'date_of_birth' => $this->faker->date
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['phone_number' => __('validation.custom.phone_number.unique')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_invalid_date_of_birth()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => '+84911111111',
            'date_of_birth' => 'invalid date'
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['date_of_birth' => __('validation.custom.date_of_birth.date')]);
    }
    /** @test */
    public function auth_user_can_not_update_if_too_young_date_of_birth()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => '+84911111111',
            'date_of_birth' => Carbon::now()->subYears(10)->format('Y-m-d')
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND)->assertSessionHasErrors(['date_of_birth' => __('validation.custom.date_of_birth.before')]);
    }
    /** @test */
    public function auth_user_can_update_if_valid_data()
    {
        $user = $this->createStudentAccount();
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => '+84911111111',
            'date_of_birth' => Carbon::now()->subYears(13)->format('Y-m-d')
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', $data);
        $response->assertRedirect(route('student.index'));
    }
    /** @test */
    public function auth_user_can_update_if_same_phone_and_null_date_of_birth()
    {
        $user = User::factory()->create(['phone_number' => '0911111111'])->assignRole('Student');
        $this->actingAs($user);
        $data = [
            'name' => 'valid name',
            'address' => 'valid address',
            'phone_number' => $user->phone_number,
            'date_of_birth' => null
        ];
        $response = $this->putTest($this->updateInformationStudentRoute($user->id), $data);
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', $data);
        $response->assertRedirect(route('student.index'));
    }
}
