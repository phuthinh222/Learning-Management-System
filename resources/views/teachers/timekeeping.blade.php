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
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Tên đăng nhập:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Họ tên giáo viên:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Phòng ban:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Số điện thoại:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Sinh nhật:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Vị trí:</div>
                                        <div class="col-md-4 h5">{{ Auth::user()->user_name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="row mb-2 ">
                                        <div class="col-md-6 h4">Giờ vào:</div>
                                        <div class="col-md-4 h5 text-center border text-danger">12:00</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-2">
                                        <div class="col-md-6 h4">Giờ ra:</div>
                                        <div class="col-md-4 h5 text-center border text-danger">12:00</div>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <h4 class="card-title">Danh sách ngày công</h4>
                                <div>
                                    <form action="">
                                        <button type="submit" class="btn btn-success btn-round ms-auto">
                                            Vào ca
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-round ms-auto">
                                            Ra ca
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ngày/Tháng/Năm</th>
                                            <th>Giờ vào ca</th>
                                            <th>Giờ ra ca</th>
                                            <th>Tổng giờ làm</th>
                                            <th>Công làm</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Ngày/Tháng/Năm</th>
                                            <th>Giờ vào ca</th>
                                            <th>Giờ ra ca</th>
                                            <th>Tổng giờ làm</th>
                                            <th>Công làm</th>
                                        </tr>
                                    </tfoot>
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
@endsection
