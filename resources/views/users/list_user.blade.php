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
                            data-bs-target="#createUserModal">
                            <i class="fa fa-plus"></i>
                            Thêm tài khoản
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-3">
                            <form action="{{route('user.listuser')}}">
                                <div class="d-flex" >
                                <div class="col-3">
                                <div class="filter-container">
                                    <button type="button" id="filter-button" class="filter-button">
                                        Lọc
                                        <i class="bi bi-funnel-fill"></i>
                                    </button>
                                    <div id="filter-options" class="filter-options">
                                            <div class="form-group">
                                                <label for="type-select">Chọn chức vụ:</label>
                                                <select id="type-select" name="type" >
                                                    <option value="">Tất cả chức vụ</option>
                                                    <option value="Student" {{old('type') == 'Student' ? 'selected' : ''}}>Học sinh</option>
                                                    <option value="Teacher" {{old('type') == 'Teacher' ? 'selected' : ''}}>Giáo viên</option>
                                                    <option value="Employee" {{old('type') == 'Employee' ? 'selected' : ''}}>Nhân viên</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="detail-select">Chi tiết:</label>
                                                <select id="detail-select" name="detail" data-old-value="{{ old('detail', '') }}">
                                                    <option value="">Chọn chi tiết</option>
                                                    <!-- Options will be populated based on the selection in type-select -->
                                                </select>
                                            </div>
                                            <button class="submit-button">Áp dụng</button>
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="input-group">
                                    <input name="search_string" value="{{request('search_string')}}" type="text" placeholder="Search ..." class="form-control" id="basic-addon1" />
                                    <button class="input-group-text btn btn-search" id="basic-addon1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tên tài khoản</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng Thái</th>
                                    <th style="width: 8%">Chức vụ</th>
                                    <th style="width: 8%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->total() == 0)
                                    <tr>
                                        <td  colspan="9">
                                            <h5 class="d-flex justify-content-center align-items-center">
                                                <strong>
                                                    Không tìm thấy kết quả cho từ khóa "{{old('search_string')}}"
                                                </strong>
                                            </h5>
                                        </td>
                                    </tr>    
                                @endif
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email_address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->userable_type == 'App\Models\Teacher')
                                                {{$user->userable->status == '1' ? 'Đang làm việc' : 'Đã nghỉ việc'}}
                                            @endif
                                            @if ($user->userable_type == 'App\Models\Employees')
                                                {{$user->userable->status == '1' ? 'Đang làm việc' : 'Đã nghỉ Việc'}}
                                            @endif
                                            @if ($user->userable_type == 'App\Models\Student')
                                                Bình thường
                                            @endif
                                        </td>
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
                        {{ $users->appends(['type' => old('type'), 'detail' => old('detail'), 'search_string' => old('search_string'), ])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create user -->
    @include('users.create_user_modal')

@endsection
