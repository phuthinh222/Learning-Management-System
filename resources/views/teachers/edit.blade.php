@extends('layouts.app')


@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Giáo viên</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('teacher.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('teacher.index') }}">Thông tin giáo viên</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('teacher.update', ['teacher' => $teacher->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <div class="card-title">Cập nhật thông tin cá nhân</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                            <input type="hidden" id="teacher_id" name="teacher_id" value="{{ $teacher->id }}" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh dại diện: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="hiddenImage">
                                    <input id="" type="file" class="form-control" name="avatar"
                                        accept="image/*"
                                        onchange="document.getElementById('photoReview').src = window.URL.createObjectURL(this.files[0])" />
                                </div>
                                <div class="avatar avatar-xxl">
                                    <img id="photoReview"
                                        src="{{ $user->avatar ? asset('storage/users/' . $user->avatar) : asset('assets/img/default.jpg') }}"
                                        alt="User vatar" class="avatar-img ms-3">
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ tên giáo viên <span class="text-danger">*</span></label>
                                    <input type="text" @error('name') class="form-control is-invalid text-truncate" @enderror
                                        class="form-control text-truncate" id="name" name="name"
                                        @error('phone_number') value="{{ old('name') }}" @enderror
                                        value="{{ old('name', $user->name)}}" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="user_name">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-truncate" id="user_name" name="user_name"
                                        value="{{ $user->user_name }}" {{ $user->user_name ? 'readonly' : '' }} />
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control text-truncate" id="email" name="email_address"
                                        value="{{ $user->email_address }}" {{ $user->email_address ? 'readonly' : '' }} />
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Sinh nhật</label>
                                    <input type="text" @error('date_of_birth') class="form-control is-invalid" @enderror
                                        class="form-control text-truncate" id="datepicker" class="datepicker" name="date_of_birth"
                                        @error('date_of_birth') value="{{ old('date_of_birth') }}" @enderror
                                        value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y')}}" />
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" @error('phone_number') class="form-control is-invalid text-truncate" @enderror
                                        class="form-control text-truncate" id="phone" name="phone_number"
                                        @error('phone_number') value="{{ old('phone_number') }}" @enderror
                                        value="{{ $user->phone_number }}" />
                                    @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="department">Phòng ban <span class="text-danger">*</span></label>
                                    <input @error('department') class="form-control is-invalid text-truncate" @enderror type="text"
                                        class="form-control text-truncate" id="department" name="department"
                                        @error('department') value="{{ old('department') }}" @enderror
                                        value="{{ $teacher->department }}" />
                                    @error('department')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="position">Vị trí <span class="text-danger">*</span></label>
                                    <input type="text" @error('position') class="form-control is-invalid text-truncate" @enderror
                                        class="form-control text-truncate" id="position" name="position"
                                        @error('position') value="{{ old('position') }}" @enderror
                                        value="{{ $teacher->position }}" />
                                    @error('position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tình trạng <span class="text-danger">*</span></label><br />
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                id="flexRadioDefault1" {{ $teacher->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Đang dạy
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0"
                                                id="flexRadioDefault2" {{ !$teacher->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Không dạy
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Nơi ở hiện tại <span class="text-danger">*</span></label>
                                    <input type="text" @error('address') class="form-control is-invalid text-truncate" @enderror
                                        class="form-control text-truncate" id="address" name="address"
                                        @error('address') value="{{ old('address') }}" @enderror
                                        value="{{ $user->address }}" />
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <a href="{{ route('teacher.index') }}" class="btn btn-light">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Trở về trang chủ
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Lưu dữ liệu
                                    <i class="fa fa-save ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">Cập nhật thông tin làm việc</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Thư viện chứng chỉ</h4>
                                        <button type="button" class="btn btn-primary btn-round ms-auto" id="createCer">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Hình ảnh</th>
                                                    <th>Chuyên ngành</th>
                                                    <th>Cấp độ</th>
                                                    <th>Trường học/Trung tâm</th>
                                                    <th style="width: 10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($certificates as $item)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ $item->photo ? asset('storage/teachers/' . $item->photo) : asset('assets/img/default.jpg') }}"
                                                                alt="" style="width: 150px">
                                                        </td>
                                                        <td>{{ $item->major }}</td>
                                                        <td>{{ $item->level }}</td>
                                                        <td>{{ $item->school }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button"
                                                                    class="btn btn-link btn-primary btn-lg"
                                                                    id="editCer{{ $item->id }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-link btn-danger"
                                                                    id="delCer{{ $item->id }}">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Thư viện kinh nghiệm</h4>
                                        <button type="button" id="createExc" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="ajaxExc" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Công ty</th>
                                                    <th>Vị trí</th>
                                                    <th>Thời gian (năm) </th>
                                                    <th style="width: 10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($experiences as $item)
                                                    <tr>
                                                        <td>{{ $item->company }}</td>
                                                        <td>{{ $item->position }}</td>
                                                        <td>{{ $item->year }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button"
                                                                    class="btn btn-link btn-primary btn-lg "
                                                                    id="editExc{{ $item->id }}">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-link btn-danger"
                                                                    id="delExc{{ $item->id }}">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal Certificate -->
    <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold" id="titleCer"></span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="" id="cerModal">
                    @csrf
                    <input type="hidden" name="id_teacher" value="{{ $teacher->id }}" />
                    <input type="hidden" id="cer_id" name="cer_id" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Chuyên ngành <span class="text-danger">*</span></label>
                                    <input id="cer_major" name="major" type="text" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_mafor"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Cấp độ <span class="text-danger">*</span></label>
                                    <input id="cer_level" name="level" type="text" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_level"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Trường học/ Trung tâm <span class="text-danger">*</span></label>
                                    <input id="cer_school" name="school" type="text" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_school"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Ảnh minh họa: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="hiddenImage">
                                    <input id="cer_photo" type="file" class="form-control" name="photo"
                                        accept="image/*"
                                        onchange="document.getElementById('photoCertificate').src = window.URL.createObjectURL(this.files[0])" />
                                        <div class="invalid-feedback" >
                                        <p id="invalid_photo"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-sm-10">
                                        <input type="hidden" name="old_photo">
                                        <img src="{{asset('../../assets/img/default.jpg')}}" id="photoCertificate" class="img img-bordered" style="width:200px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Lưu dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Experience -->
    <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="excModal">
                    @csrf
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold" id="titleExc"></span>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id_teacher" value="{{ $teacher->id }}" />
                            <input type="hidden" id="exc_id" name="exc_id" />
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Công ty <span class="text-danger">*</span></label>
                                    <input id="exc_company" type="text" name="company" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_company"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Vị trí <span class="text-danger">*</span></label>
                                    <input id="exc_position" type="text" name="position" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_position"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Thời gian (năm) <span class="text-danger">*</span></label>
                                    <input id="exc_year" type="number" name="year" class="form-control text-truncate" />
                                    <div class="invalid-feedback" >
                                        <p id="invalid_year"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Lưu dữ liệu
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
