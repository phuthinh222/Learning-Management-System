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
                                <p class="col-md-4 mb-0 card-text">Tên đăng nhập :  </p>
                                <p class="col-md-4 p-0 card-text">nguyenxuansinh</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Họ tên giáo viên :  </p>
                                <p class="col-md-4 p-0 card-text">Nguyễn Xuân Sinh</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Phòng ban :  </p>
                                <p class="col-md-4 p-0 card-text">Nhân viên</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Số điện thoại :  </p>
                                <p class="col-md-4 p-0 card-text">0123456789</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Sinh nhật :  </p>
                                <p class="col-md-4 p-0 card-text">29/09/2002</p>
                            </div>
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Vị trí :  </p>
                                <p class="col-md-4 p-0 card-text">develop</p>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Giờ vào :</p>
                                <div class="form-control text-danger">12:00</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex p-3">
                                <p class="col-md-4 mb-0 card-text">Giờ ra :</p>
                                <div class="form-control text-danger">12:00</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between mt-5 header_content">
                                        <h4 class="card-title">Danh sách ngày công</h4>
                                        <form action="" method="GET" class="select_seach">
                                            <div class="d-flex">
                                                <select name="month" class="form-control select_month">
                                                    <option value="">Tháng</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option  value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>


                                                <select name="year" class="form-control select_year">
                                                    <option value="">Năm</option>
                                                    @for ($i = now()->year; $i >= 1900; $i--)
                                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }} </option>
                                                    @endfor
                                                </select>
                                                <button type="submit" class="btn btn-info btn-round ms-auto">
                                                    Tìm
                                                </button>
                                            </div>


                                        </form>


                                        <form action="" >
                                            <div>
                                                <button type="submit" class="btn btn-success btn-round ms-auto">
                                                    Vào ca
                                                </button>
                                                <button type="submit" class="btn btn-danger btn-round ms-auto">
                                                    Ra ca
                                                </button>
                                            </div>
                                        </form>

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




