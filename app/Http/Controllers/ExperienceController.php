<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\ExperiencesCreateRequest;
use App\Http\Service\Teacher\ExperienceService;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExperienceController extends Controller
{
    protected $experience_service;

    public function __construct(ExperienceService $experience_service)
    {
        $this->experience_service = $experience_service;
    }
    public function index() {}
    public function create()
    {
        return response()->json([''], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $exc = $this->experience_service->create($request->all());
        flash()->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->success(__('teacher.experience.create_success'));
        return response()->json($exc);
    }
    public function edit($id_teacher, $id_exc)
    {
        $exc = $this->experience_service->getId($id_exc);
        return response()->json($exc, Response::HTTP_OK);
    }

    public function update(Request $request, $id_teacher, $id_exc)
    {
        $this->experience_service->update($request->all(), $id_exc);
        flash()->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->success(__('teacher.experience.update_success'));
        return response()->json(Response::HTTP_OK);
    }

    public function destroy($id_teacher, $id_exc)
    {
        $this->experience_service->destroy($id_exc);
        flash()->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->success(__('teacher.experience.delete_success'));
        return response()->json([], Response::HTTP_OK);
    }
}
