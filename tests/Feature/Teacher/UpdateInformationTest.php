<?php

namespace Tests\Feature\Teacher;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateInformationTest extends TestCase
{
    public function getUrlTest(Teacher $teacher)
    {
        return route('teacher.edit', $teacher->id);
    }
    public function postUrlTest(Teacher $teacher)
    {
        return route('teacher.update', ['teacher' => $teacher->id]);
    }

    public function postCertificateUrl(Teacher $teacher)
    {
        return route('certificates.store', $teacher->id);
    }

    public function postExperienceUrl(Teacher $teacher)
    {
        return route('experiences.store', $teacher->id);
    }
    #[Test]
    public function guest_user_can_not_access_update_teacher_information_page()
    {
        $teacher = $this->createTeacherUser();
        $response = $this->getTest($this->getUrlTest($teacher->userable));
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertRedirect(route('login'));
    }

    #[Test]
    public function auth_teacher_user_can_access_update_teacher_information_page()
    {
        $teacher = $this->createTeacherUser();
        $response = $this->getTestWithAuth($this->getUrlTest($teacher->userable), $teacher);
        $response->assertStatus(Response::HTTP_OK)
        ->assertViewIs('teachers.edit');
    }
    #[Test]
    public function auth_student_user_can_not_access_update_teacher_information_page()
    {
        $student = $this->createStudentUser();
        $teacer = $this->createTeacherUser();
        $response = $this->getTestWithAuth($this->getUrlTest($teacer->userable), $student);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    #[Test]
    public function auth_employee_user_can_not_access_update_teacher_information_page()
    {
        $employee = $this->createEmployeeUser();
        $teacher = $this->createTeacherUser();
        $response = $this->getTestWithAuth($this->getUrlTest($teacher->userable), $employee);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_invalid_phone_number()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'department' => 'Developper',
            'date_of_birth' => '1999-07-07',
            'position' => 'Developper',
            'address' => '76 Vũ Lập',
            //Phone number must be at least 
            'phone_number' => '098009877'
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['phone_number' => __('validation.teacher_phone_number.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_invalid_name()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => '====',
            'department' => 'Developper',
            'date_of_birth' => '1999-07-07',
            'position' => 'Developper',
            'address' => '76 Vũ Lập', 
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['name' => __('validation.teacher_name.regex')]);
    }

     #[Test]
     public function auth_teacher_user_can_not_update_information_not_send_name()
     {
         $teacher = $this->createTeacherUser();
         $data = [
             'department' => 'Developper',
             'date_of_birth' => '1999-07-07',
             'position' => 'Developper',
             'address' => '76 Vũ Lập', 
             'phone_number' => $teacher->phone_number,
         ];
         $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
         $response->assertStatus(Response::HTTP_FOUND)
         ->assertSessionHasErrors(['name' => __('validation.teacher_name.required')]);
     }
    #[Test]
    public function auth_teacher_user_can_not_update_information_send_invalid_department()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'department' => 'Invalid Department @@##',
            'date_of_birth' => '1999-07-07',
            'position' => 'Developper',
            'address' => '76 Vũ Lập', 
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['department' => __('validation.teacher_department.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_not_send_department()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'date_of_birth' => '1999-07-07',
            'position' => 'Developper',
            'address' => '76 Vũ Lập', 
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['department' => __('validation.teacher_department.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_invalid_position()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'date_of_birth' => '1999-07-07',
            'department' => 'Developper',
            //position could not contain special character
            'position' => 'Developper===@@',
            'address' => '76 Vũ Lập', 
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['position' => __('validation.teacher_position.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_not_send_position()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'date_of_birth' => '1999-07-07',
            'department' => 'Developper',
            'address' => '76 Vũ Lập', 
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['position' => __('validation.teacher_position.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_not_send_address()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            'date_of_birth' => '1999-07-07',
            'department' => 'Developper',
            'position' => 'Developper',
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['address' => __('validation.teacher_address.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_invalid_birthday()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            //date of birth must be yyyy-mm-dd
            'date_of_birth' => '07-07-2002',
            'department' => 'Developper',
            'position' => 'Developper',
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['date_of_birth' => __('validation.teacher_date_of_birth.date_format')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_too_small_birthday()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            //date of birth must be older than 18 years old
            'date_of_birth' => '2024-07-07',
            'department' => 'Developper',
            'position' => 'Developper',
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['date_of_birth' => __('validation.teacher_date_of_birth.before')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_information_send_too_big_birthday()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'name' => $teacher->name,
            //date of birth must be younger than 70 years old
            'date_of_birth' => '1800-07-07',
            'department' => 'Developper',
            'position' => 'Developper',
            'phone_number' => $teacher->phone_number,
        ];
        $response = $this->putTestWithAuth($this->postUrlTest($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['date_of_birth' => __('validation.teacher_date_of_birth.after')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_not_send_major()
    {
        $teacher = $this->createTeacherUser();
        $exemple_file = UploadedFile::fake()->image('certificate.jpg');
        $data = [
            'level' => 'Middle',
            'school' => 'Đại học ',
            'photo' => $exemple_file
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['major' => __('validation.teacher_certificate.major.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_send_invalid_major()
    {
        $teacher = $this->createTeacherUser();
        $exemple_file = UploadedFile::fake()->image('certificate.jpg');
        $data = [
            //Valid major not contain special characters but -
            'major' => 'Công Nghệ Thông Tin @@@',
            'level' => 'Middle',
            'school' => 'Đại học ',
            'photo' => $exemple_file
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['major' => __('validation.teacher_certificate.major.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_not_send_level()
    {
        $teacher = $this->createTeacherUser();
        $exemple_file = UploadedFile::fake()->image('certificate.jpg');
        $data = [
            'major' => 'Công Nghệ Thông Tin',
            'school' => 'Đại học ',
            'photo' => $exemple_file
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['level' => __('validation.teacher_certificate.level.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_send_invalid_level()
    {
        $teacher = $this->createTeacherUser();
        $exemple_file = UploadedFile::fake()->image('certificate.jpg');
        $data = [
            'major' => 'Công Nghệ Thông Tin',
            'school' => 'Đại học ',
            //Valid level not contain special characters but -
            'level' => 'Middle @@@',
            'photo' => $exemple_file
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['level' => __('validation.teacher_certificate.level.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_send_invalid_certificate_image()
    {
        $teacher = $this->createTeacherUser();
        $exemple_file = UploadedFile::fake()->image('certificate.docx');
        $data = [
            'major' => 'Công Nghệ Thông Tin',
            'school' => 'Đại học ',
            'level' => 'Middle',
            //files type allowed: jpeg,jpg,png,gif,svg,webp
            'photo' => $exemple_file
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['photo' => __('validation.teacher_certificate.certificate_image.mimes')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_certificate_not_send_certificate_image()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'major' => 'Công Nghệ Thông Tin',
            'school' => 'Đại học ',
            'level' => 'Middle',
        ];
        $response = $this->postTestWithAuth($this->postCertificateUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['photo' => __('validation.teacher_certificate.certificate_image.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_not_send_company()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'position' => 'Lập trình viên',
            'year' => 2,5
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['company' => __('validation.teacher_experiences.company.required')]);
    }
    
    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_invalid_company()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            //Valid company name not contain special characters but -
            'company' => 'Công ty DEHA 1234 @@@@',
            'position' => 'Lập trình viên',
            'year' => 2,5
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['company' => __('validation.teacher_experiences.company.regex')]);
    }
    
    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_invalid_position()
    {
        $teacher = $this->createTeacherUser();
        $data = [
     
            'company' => 'Công ty DEHA 1234',
            //Valid position name not contain special characters but -
            'position' => 'Lập trình viên @@@@',
            'year' => 2,5
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['position' => __('validation.teacher_experiences.position.regex')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_too_long_position()
    {
        $randomString = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', ceil(256/52))), 1, 256);

        $teacher = $this->createTeacherUser();
        $data = [
     
            'company' => 'Công ty DEHA 1234',
            //Valid position name maximun 255 characters
            'position' => $randomString,
            'year' => 2,5
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['position' => __('validation.teacher_experiences.position.max')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_not_send_year()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'company' => 'Công ty DEHA 1234',
            'position' => 'Lập trình viên',
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['year' => __('validation.teacher_experiences.year.required')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_too_many_year()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'company' => 'Công ty DEHA 1234',
            'position' => 'Lập trình viên',
            'year' => 100
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['year' => __('validation.teacher_experiences.year.max')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_too_less_year()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'company' => 'Công ty DEHA 1234',
            'position' => 'Lập trình viên',
            'year' => -2
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['year' => __('validation.teacher_experiences.year.min')]);
    }

    #[Test]
    public function auth_teacher_user_can_not_update_experiences_send_invalid_year()
    {
        $teacher = $this->createTeacherUser();
        $data = [
            'company' => 'Công ty DEHA 1234',
            'position' => 'Lập trình viên',
            'year' => 'aa'
        ];
        $response = $this->postTestWithAuth($this->postExperienceUrl($teacher->userable), $teacher, $data);
        $response->assertStatus(Response::HTTP_FOUND)
        ->assertSessionHasErrors(['year' => __('validation.teacher_experiences.year.numeric')]);
    }
}
