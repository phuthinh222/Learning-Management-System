<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\ExperienceRepository;

class ExperienceService
{
    protected $experience;

    public function __construct(ExperienceRepository $experience)
    {
        $this->experience = $experience;
    }
    public function create(array $experience)
    {
        return $this->experience->create($experience);
    }
    public function getId($id)
    {
        return $this->experience->find($id);
    }
    public function update(array $experience, $id)
    {
        return $this->experience->update($experience, $id);
    }
    public function destroy($id)
    {
        return $this->experience->delete($id);
    }
}
