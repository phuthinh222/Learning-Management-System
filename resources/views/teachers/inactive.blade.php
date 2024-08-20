@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý giáo viên</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>

            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Quản lý giáo viên</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Phê duyệt tài khoản giáo viên</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tên tài khoản</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 10%">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>ecm01</td>
                                    <td>Name test</td>
                                    <td>ecm01@example.com</td>
                                    <td>01-01-2000</td>
                                    <td>28 Nguyễn Tri Phương, Huế</td>
                                    <td>0123456789</td>
                                    <td>01:01 01-01-2000</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#confirm_teacher_information"
                                               data-idteacher class="btn btn-link btn-primary btn-lg confirm_information">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/teacher/fill_teacher_data.js')
    @include('teachers.confirm_information_modal')
@endsection
