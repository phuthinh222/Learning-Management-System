<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CourseRepository;
use App\Validators\CourseValidator;
use Illuminate\Support\Facades\Storage;

/**
 * Class CourseRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class CourseRepositoryEloquent extends BaseRepository implements CourseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Course::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        if (isset($attributes['photo'])) {
            $file = $attributes['photo'];
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/courses', $filename);
                $data = [
                    'title' => $attributes['title'],
                    'description' => $attributes['description'],
                    'id_teacher' => $attributes['id_teacher'],
                ];
                $data['photo'] = $filename;
                return $this->model->create($data);
            }
        }
    }

    public function update(array $attribute, $id) {}
    public function delete($id)
    {
        $course = $this->find($id);
        $filePath = 'public/courses/' . $course->photo;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return $this->model->destroy($id);
    }
}
