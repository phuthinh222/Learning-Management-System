<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\ExperienceRepository;

class ExperienceService
{
    protected $experience_repository;

    public function __construct(ExperienceRepository $experience_repository)
    {
        $this->experience_repository = $experience_repository;
    }
    public function create(array $attributes)
    {
        return $this->experience_repository->create($attributes);
    }
    public function getId($id)
    {
        return $this->experience_repository->find($id);
    }
    public function update(array $attributes, $id)
    {
        return $this->experience_repository->update($attributes, $id);
    }
    public function destroy($id)
    {
        return $this->experience_repository->delete($id);
    }
}
