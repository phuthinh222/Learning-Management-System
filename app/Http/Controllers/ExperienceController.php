<?php

namespace App\Http\Controllers;

use App\Http\Service\Teacher\ExperienceService;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExperienceController extends Controller
{
    protected $experience;

    public function __construct(ExperienceService $experience)
    {
        $this->experience = $experience;
    }
    public function index() {}
    public function create()
    {
        return response()->json([''], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $exc = $this->experience->create($request->all());
        flash()->success('Thêm thành công');
        return response()->json($exc);
    }
    public function edit($id_teacher, $id_exc)
    {
        $exc = $this->experience->getId($id_exc);
        return response()->json($exc, Response::HTTP_OK);
    }

    public function update(Request $request, $id_teacher, $id_exc)
    {
        $this->experience->update($request->all(), $id_exc);
        flash()->success('Cập nhật thành công');
        return response()->json(Response::HTTP_OK);
    }

    public function destroy($id_teacher, $id_exc)
    {
        $this->experience->destroy($id_exc);
        flash()->success('Xóa thành công');
        return response()->json([], Response::HTTP_OK);
    }
}
