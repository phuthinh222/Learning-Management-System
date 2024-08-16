<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\TeacherRepository;
use App\Repositories\Contracts\UserRepository;

class TeacherService
{
    protected $teacher;
    protected $user;
    public function __construct(TeacherRepository $teacher, UserRepository $user)
    {
        $this->teacher = $teacher;
        $this->user = $user;
    }
    public function getId($id)
    {
        return $this->user->find($id);
    }
    public function update(array $attributes, $id)
    {
        $user = $this->user->find($id);
        if ($user->user_name == $attributes['user_name'] && $user->email_address == $attributes['email_address']) {
            $user = $this->user->update($attributes, $id);
            $teacher = $user->userable;
            $teacher->update($attributes);
            return true;
        } else {
            return false;
        }
    }
}
