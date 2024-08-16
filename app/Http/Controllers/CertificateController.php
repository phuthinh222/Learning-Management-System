<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\CertificationCreateRequest;
use App\Http\Service\Teacher\CertificateService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CertificateController extends Controller
{
    protected $certificate_service;

    public function __construct(CertificateService $certificate_service)
    {
        $this->certificate_service = $certificate_service;
    }
    public function create()
    {
        return response()->json([''], Response::HTTP_OK);
    }
    public function edit($id_teacher, $id_cer)
    {
        $certificate = $this->certificate_service->getId($id_cer);

        if ($certificate->photo) {
            $certificate->photo_path = asset('storage/teachers/' . $certificate->photo);
        } else {
            $certificate->photo_path = asset('assets/img/default.jpg');
        }

        return response()->json($certificate, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $this->certificate_service->create($request->all());
        flash()->success(__('teacher.certificate.create_success'));
        return response()->json([''], Response::HTTP_OK);
    }
    public function update(Request $request)
    {
        $certificate = $this->certificate_service->update($request->all(), $request->cer_id);
        flash()->success(__('teacher.experience.create_success'));
        return response()->json($certificate, Response::HTTP_OK);
    }
    public function destroy($id_teacher, $id_cer)
    {
        $certificate = $this->certificate_service->delete($id_cer);
        flash()->success(__('teacher.experience.delete_success'));
        return response()->json($certificate, Response::HTTP_OK);
    }
}
