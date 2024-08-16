@extends('layouts.app')


@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Giáo viên</h3>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('teacher.update', ['teacher' => $teacher->id]) }}">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <div class="card-title">Cập nhật thông tin giáo viên</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_name">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name"
                                        value="{{ $user->user_name }}" {{ $user->user_name ? 'readonly' : '' }} />
                                </div>
                                <div class="form-group">
                                    <label for="name">Họ tên giáo viên <span class="text-danger">*</span></label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror class="form-control" id="name" name="name"
                                    @error('phone_number') value="{{old('name')}}" @enderror value="{{ $user->name }}" />
                                    @error('name') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                           
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Địa chỉ email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email_address"
                                        value="{{ $user->email_address }}" {{ $user->email_address ? 'readonly' : '' }} />
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Sinh nhật</label>
                                    <input type="text" @error('date_of_birth') class="form-control is-invalid" @enderror class="form-control" id="datepicker" class="datepicker"
                                        name="date_of_birth" @error('date_of_birth') value="{{old('date_of_birth')}}" @enderror value="{{ $user->date_of_birth }}" />
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
                                    <input type="tel" @error('phone_number') class="form-control is-invalid" @enderror class="form-control" id="phone" name="phone_number"
                                    @error('phone_number') value="{{old('phone_number')}}" @enderror value="{{ $user->phone_number }}" />
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
                                    <input @error('department') class="form-control is-invalid" @enderror type="text" class="form-control" id="department" name="department"
                                    @error('department') value="{{old('department')}}" @enderror value="{{ $teacher->department }}" />
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
                                    <input type="text" @error('position') class="form-control is-invalid" @enderror  class="form-control" id="position" name="position"
                                    @error('position') value="{{old('position')}}" @enderror value="{{ $teacher->position }}" />
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
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" {{ $teacher->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Đang dạy
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
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
                                    <input type="text" @error('address') class="form-control is-invalid" @enderror class="form-control" id="address" name="address"
                                    @error('address') value="{{old('address')}}" @enderror value="{{ $user->address }}" />
                                    @error('address') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                           
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Thư viện chứng chỉ</h4>
                                            <button type="button" class="btn btn-primary btn-round ms-auto"
                                                data-bs-toggle="modal" data-bs-target="#certificateModal" id="addBtn">
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
                                                                <img src="{{ $item->photo ? asset('assets/img/profile.jpg') : asset('assets/img/default.jpg') }}"
                                                                    alt="" style="width: 150px">
                                                            </td>
                                                            <td>{{ $item->major }}</td>
                                                            <td>{{ $item->level }}</td>
                                                            <td>{{ $item->school }}</td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <button type="button" data-bs-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-original-title="Edit Task" id="editCer">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" data-bs-toggle="tooltip"
                                                                        title="" class="btn btn-link btn-danger"
                                                                        data-original-title="Remove" id=delCer>
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
                                            <button type="button" class="btn btn-primary btn-round ms-auto"
                                                data-bs-toggle="modal" data-bs-target="#experienceModal">
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
                                                                    <button type="button" data-bs-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-original-title="Edit Task" id=editExc>
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" data-bs-toggle="tooltip"
                                                                        title="" class="btn btn-link btn-danger"
                                                                        data-original-title="Remove" id = "delExc">
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
                    <div class="card-action ">
                        <button type="button" class="btn btn-danger">Trở lại</button>
                        <button type="submit" class="btn btn-success">Lưu dữ liệu</button>
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
                        <span class="fw-mediumbold">Thêm chứng chỉ</span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Chuyên ngành</label>
                                    <input id="" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Cấp độ</label>
                                    <input id="addName" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Trường học/ Trung tâm</label>
                                    <input id="addName" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Ảnh minh họa:</label>
                                    <input type="file" class="form-control" name="uploadPhoto" accept="image/*"
                                        onchange="document.getElementById('Photo').src = window.URL.createObjectURL(this.files[0])" />
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-sm-10">
                                        <input type="hidden" name="Photo" value="macbook.png" />
                                        <img id="Photo" src="{{ asset('assets/img/default.jpg') }}"
                                            class="img img-bordered" style="width:200px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" id="addRowButton" class="btn btn-primary">
                            Thêm
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
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Kinh nghiệm làm việc</span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" action="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Công ty</label>
                                    <input id="company" type="text" name="company" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Vị trí</label>
                                    <input id="position" type="text" name="position" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Thời gian (năm) </label>
                                    <input id="year" type="text" name="year" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" id="addRowButton" class="btn btn-primary">
                        Thêm
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection