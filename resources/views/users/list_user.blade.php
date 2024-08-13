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
                                    <th>Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày tạo</th>
                                    <th>Chức vụ</th>
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
                                    <td>Teacher</td>
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
                                <tr>
                                    <td>ecm01</td>
                                    <td>Name test</td>
                                    <td>ecm01@example.com</td>
                                    <td>01-01-2000</td>
                                    <td>28 Nguyễn Tri Phương, Huế</td>
                                    <td>0123456789</td>
                                    <td>01:01 01-01-2000</td>
                                    <td>Student</td>
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
                                <tr>
                                    <td>ecm01</td>
                                    <td>Name test</td>
                                    <td>ecm01@example.com</td>
                                    <td>01-01-2000</td>
                                    <td>28 Nguyễn Tri Phương, Huế</td>
                                    <td>0123456789</td>
                                    <td>01:01 01-01-2000</td>
                                    <td>Employee</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>


    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterButton = document.getElementById('filter-button');
            const filterOptions = document.getElementById('filter-options');
            const typeSelect = document.getElementById('type-select');
            const detailSelect = document.getElementById('detail-select');

            const options = {
                student: [{
                        value: 'khoa1',
                        text: 'Khóa 1'
                    },
                    {
                        value: 'khoa2',
                        text: 'Khóa 2'
                    },
                    {
                        value: 'khoa3',
                        text: 'Khóa 3'
                    }
                ],
                teacher: [{
                        value: 'lop1',
                        text: 'Lớp 1'
                    },
                    {
                        value: 'lop2',
                        text: 'Lớp 2'
                    },
                    {
                        value: 'lop3',
                        text: 'Lớp 3'
                    }
                ],
                accountant: [{
                        value: 'dang-lam-viec',
                        text: 'Đang làm việc'
                    },
                    {
                        value: 'da-nghi',
                        text: 'Đã nghỉ'
                    }
                ]
            };

            filterButton.addEventListener('click', () => {
                filterOptions.classList.toggle('show');
            });

            typeSelect.addEventListener('change', () => {
                const selectedType = typeSelect.value;
                detailSelect.innerHTML = '<option value="">Chọn chi tiết</option>'; // Reset detail select

                if (selectedType && options[selectedType]) {
                    options[selectedType].forEach(option => {
                        const optionElement = document.createElement('option');
                        optionElement.value = option.value;
                        optionElement.textContent = option.text;
                        detailSelect.appendChild(optionElement);
                    });
                }
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!filterButton.contains(event.target) && !filterOptions.contains(event.target)) {
                    filterOptions.classList.remove('show');
                }
            });
        });
    </script>
@endsection
