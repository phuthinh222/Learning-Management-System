@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Giáo viên</h3>
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
                <a href="#">Giáo viên</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Thêm giáo viên</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Đăng ký thông tin giáo viên</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_name">Tên đăng nhập <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="user_name" name="user_name"
                                    placeholder="nva123" />
                            </div>
                            <div class="form-group">
                                <label for="name">Họ tên giáo viên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Nguyen123456" />
                            </div>
                            <div class="form-group">
                                <label for="department">Phòng ban <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="department" name="department"
                                    placeholder="Nhà phát triển" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Địa chỉ email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email_address"
                                    placeholder="nguyenvana@gmail.com" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone_number"
                                    placeholder="0123456789" />
                            </div>

                            <div class="form-group">
                                <label for="datepicker">Sinh nhật</label>
                                <input type="text" class="form-control" id="datepicker" class="datepicker"
                                    name="date_of_birth" />
                            </div>
                            <div class="form-group">
                                <label for="position">Vị trí <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Developer" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tình trạng <span class="text-danger">*</span></label><br />
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1" checked />
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Đang dạy
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" />
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
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Thừa Thiên Huế" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Thư viện chứng chỉ</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#certificateModal">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Thêm chứng chỉ</span>
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Chuyên ngành</label>
                                                                    <input id="" type="text"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Cấp độ</label>
                                                                    <input id="addName" type="text"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Trường học/ Trung tâm</label>
                                                                    <input id="addName" type="text"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Ảnh minh họa:</label>
                                                                    <input type="file" class="form-control"
                                                                        name="uploadPhoto" accept="image/*"
                                                                        onchange="document.getElementById('Photo').src = window.URL.createObjectURL(this.files[0])" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-lg-offset-2 col-sm-10">
                                                                        <input type="hidden" name="Photo"
                                                                            value="macbook.png" />
                                                                        <img id="Photo"
                                                                            src="{{ asset('assets/img/default.jpg') }}"
                                                                            class="img img-bordered"
                                                                            style="width:200px" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" id="addRowButton" class="btn btn-primary">
                                                            Add
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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
                                                <tr>
                                                    <td><img src="https://img.pikbest.com/origin/10/25/38/523pIkbEsTVN4.jpg!w700wp"
                                                            alt="" style="width: 150px"></td>
                                                    <td>Công Nghệ Thông Tin</td>
                                                    <td>Cử nhân</td>
                                                    <td>Trường Đại học Khoa Học Huế</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                title="" class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                title="" class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Thư viện kinh nghiệm</h4>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#experienceModal">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="experienceModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold"> Kinh nghiệm làm việc</span>
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Công ty</label>
                                                                    <input id="company" type="text" name="company"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Vị trí</label>
                                                                    <input id="position" type="text" name="position"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Thời gian (năm) </label>
                                                                    <input id="year" type="text" name="year"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" id="addRowButton" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                <tr>
                                                    <td>Công ty cổ phần DEHA Việt Nam</td>
                                                    <td>Devloper</td>
                                                    <td>1</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                title="" class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                title="" class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
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
                </div>
                <div class="card-action ">
                    <button class="btn btn-danger">Back</button>
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection
