@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Chấm công</h3>
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
                <a href="#">Quản lý ngày công</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Công làm việc</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Tên đăng nhập : </p>
                                <p class="col-md-4 p-0 card-text">{{Auth::user()->user_name}}</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Họ tên giáo viên : </p>
                                <p class="col-md-4 p-0 card-text">{{Auth::user()->name}}</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Phòng ban : </p>
                                <p class="col-md-4 p-0 card-text">
                                    @if ($teacher)
                                        {{$teacher->department}}
                                    @else
                                        Chưa có phòng ban
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Số điện thoại : </p>
                                <p class="col-md-4 p-0 card-text">{{Auth::user()->phone_number}}</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Sinh nhật : </p>
                                <p class="col-md-4 p-0 card-text">{{Auth::user()->date_of_birth}}</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Vị trí : </p>
                                <p class="col-md-4 p-0 card-text">
                                    @if ($teacher)
                                        {{$teacher->position}}
                                    @else
                                        Chưa có vị trí
                                    @endif
                                </p>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Giờ vào :</p>
                                <div class="form-control text-danger">{{$attendance ? $attendance->time_check_in : "00:00"}}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Giờ ra :</p>
                                <div class="form-control text-danger">{{$attendance ? $attendance->time_check_out : "00:00"}}</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between mt-5 header_content_timekeeping">
                                        <h4 class="card-title">Danh sách ngày công</h4>
                                        <form action="{{ route('attendance.search') }}" method="GET" class="d-flex align-items-center header_content_timekeeping_search">
                                            <div class="input-group">
                                                <input type="text" id="search_attendance" name="search_attendance" value="{{ old('search_attendance') }}" class="form-control" placeholder="mm/yyyy">
                                                <div class="btn btn-dark ms-1 icon_calendar">
                                                    <i class="fa-regular fa-calendar"></i>
                                                </div>
                                            </div>
                                        </form>
                                        


                                        <div class="d-flex">
                                            @if ($attendance && $attendance->time_check_out=="00:00:00")
                                                <form action="{{ route('teacher.checkout_teacher') }}" method="GET">
                                                    <button type="submit" class="btn btn-danger btn-round ms-auto">
                                                        Ra ca
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('teacher.checkin_teacher') }}" method="GET">
                                                    <button type="submit" class="btn btn-success btn-round ms-auto">
                                                        Vào ca
                                                    </button>
                                                </form>
                                            @endif
                                        </div>


                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Ngày/Tháng/Năm</th>
                                                    <th>Giờ vào ca</th>
                                                    <th>Giờ ra ca</th>
                                                    <th>Tổng giờ làm</th>
                                                    <th>Công làm</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>7/8/2024</td>
                                                    <td>8:00</td>
                                                    <td>17:00</td>
                                                    <td>9</td>
                                                    <td>đủ công</td>
                                                </tr>
                                                <tr>
                                                    <td>8/8/2024</td>
                                                    <td>13:00</td>
                                                    <td>17:00</td>
                                                    <td>9</td>
                                                    <td>nửa công</td>
                                                </tr>
                                                <tr>
                                                    <td>8/8/2024</td>
                                                    <td>13:00</td>
                                                    <td>00:00</td>
                                                    <td>>9</td>
                                                    <td>không công</td>
                                                </tr>
                                                <tr>
                                                    <td>8/8/2024</td>
                                                    <td>00:00</td>
                                                    <td>17:00</td>
                                                    <td>>9</td>
                                                    <td>không công</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
