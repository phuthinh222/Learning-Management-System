<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\CertificationCreateRequest;
use App\Http\Service\Teacher\CertificateService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CertificateController extends Controller
{
    protected $certificate;

    public function __construct(CertificateService $certificate)
    {
        $this->certificate = $certificate;
    }
    public function create()
    {
        return response()->json([''], Response::HTTP_OK);
    }
    public function edit($id_teacher, $id_cer)
    {
        $certificate = $this->certificate->getId($id_cer);

        if ($certificate->photo) {
            $certificate->photo_path = asset('storage/teachers/' . $certificate->photo);
        } else {
            $certificate->photo_path = asset('assets/img/default.jpg');
        }

        return response()->json($certificate, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $this->certificate->create($request->all());
        flash()->success('Thêm chứng chỉ thành công');
        return response()->json([''], Response::HTTP_OK);
    }
    public function update(Request $request)
    {
        $certificate = $this->certificate->update($request->all(), $request->cer_id);
        flash()->success('Cập nhật chứng chỉ thành công');
        return response()->json($certificate, Response::HTTP_OK);
    }
    public function destroy($id_teacher, $id_cer)
    {
        $certificate = $this->certificate->delete($id_cer);
        flash()->success('Xóa chứng chỉ thành công');
        return response()->json($certificate, Response::HTTP_OK);
    }
}
