<?php

namespace App\Http\Service\Teacher;

use App\Repositories\Contracts\CertificateRepository;

class CertificateService
{
    protected $certificate;

    public function __construct(CertificateRepository $certificate)
    {
        $this->certificate = $certificate;
    }

    public function create(array $certificate)
    {
        return $this->certificate->createPhoto($certificate);
    }
    public function getId($id)
    {
        return $this->certificate->find($id);
    }
    public function update(array $certificate, $id)
    {
        return $this->certificate->updatePhoto($certificate, $id);
    }
    public function delete($id)
    {
        return $this->certificate->deletePhoto($id);
    }
}
