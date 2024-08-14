@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý người dùng</h3>
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
                <a href="#">Quản lý người dùng</a>
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
                        <h4 class="card-title">Quản lý người dùng</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Thêm tài khoản
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12 col-md-1">
                            <div class="filter-container">

                                <button id="filter-button" class="filter-button">
                                    Lọc
                                    <i class="bi bi-funnel-fill"></i>
                                </button>
                                <div id="filter-options" class="filter-options">
                                    <form id="filter-form">
                                        <div class="form-group">
                                            <label for="type-select">Chọn chức vụ:</label>
                                            <select id="type-select" name="type">
                                                <option value="">Tất cả chức vụ</option>
                                                <option value="student">Sinh viên</option>
                                                <option value="teacher">Giáo viên</option>
                                                <option value="accountant">Kế toán</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="detail-select">Chi tiết:</label>
                                            <select id="detail-select" name="detail">
                                                <option value="">Chọn chi tiết</option>
                                                <!-- Options will be populated based on the selection in type-select -->
                                            </select>
                                        </div>
                                        <button type="submit" class="submit-button">Áp dụng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="input-group mb-3">

                                <input type="text" placeholder="Search ..." class="form-control" id="basic-addon1" />
                                <span class="input-group-text btn btn-search" id="basic-addon1">
                                    <i class="fa fa-search search-icon"></i>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tên tài khoản</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th style="width: 10%">Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 8%">Chức vụ</th>
                                    <th style="width: 8%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email_address }}</td>
                                        <td>{{ $user->date_of_birth }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->email_verified_at }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $roleTranslations[$role->name] ?? $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
