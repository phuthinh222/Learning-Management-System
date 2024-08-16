<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\CertificateRepository;

class CertificateService
{
    protected $certificate_repository;

    public function __construct(CertificateRepository $certificate_repository)
    {
        $this->certificate_repository = $certificate_repository;
    }

    public function create(array $attributes)
    {
        return $this->certificate_repository->create($attributes);
    }
    public function getId($id)
    {
        return $this->certificate_repository->find($id);
    }
    public function update(array $attributes, $id)
    {
        return $this->certificate_repository->update($attributes, $id);
    }
    public function delete($id)
    {
        return $this->certificate_repository->delete($id);
    }
}
