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
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function delete($id);
}
