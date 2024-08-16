<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CertificateRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface CertificateRepository extends RepositoryInterface
{
    public function createPhoto(array $attributes);
    public function updatePhoto(array $attributes, $id);
    public function deletePhoto($id);
}
