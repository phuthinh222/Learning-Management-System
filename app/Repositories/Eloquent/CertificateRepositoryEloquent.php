<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CertificateRepository;
use App\Entities\Certificate;
use App\Models\Certificate as ModelsCertificate;
use App\Validators\CertificateValidator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Class CertificateRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CertificateRepositoryEloquent extends BaseRepository implements CertificateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ModelsCertificate::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function createPhoto(array $attributes)
    {
        if (isset($attributes['photo_cer'])) {
            $file = $attributes['photo_cer'];
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/teachers', $filename);
                $data = [
                    'major' => $attributes['major'],
                    'level' => $attributes['level'],
                    'school' => $attributes['school'],
                    'id_teacher' => $attributes['id_teacher'],
                ];
                $data['photo'] = $filename;
                return $this->model->create($data);
            }
        }
    }
    public function updatePhoto(array $attributes, $id)
    {
        $certificate = $this->model->find($id);
        $filePath = 'public/teachers/' . $certificate->photo;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        if (isset($attributes['photo_cer']) && is_file($attributes['photo_cer'])) {
            $file = $attributes['photo_cer'];
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/teachers', $filename);
                $data = [
                    'major' => $attributes['major'],
                    'level' => $attributes['level'],
                    'school' => $attributes['school'],
                    'id_teacher' => $attributes['id_teacher'],
                ];
                $attributes['photo'] = $filename;
            } else {
                $data['photo'] = '123.jpg';
            }
        } else {
            $attributes['photo'] = '123.jpg';
        }
        $certificate->update($attributes);
        return $certificate;
    }
    public function deletePhoto($id)
    {
        $certificate = $this->model->find($id);
        $filePath = 'public/teachers/' . $certificate->photo;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return $this->model->destroy($id);
    }
}
