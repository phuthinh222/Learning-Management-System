@extends('layouts.app')

@section('breadcrumbs')
<div class="page-header">
    <h3 class="fw-bold mb-3">Phê duyệt tài khoản giáo viên</h3>
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
            <a href="#">Phê duyệt tài khoản giáo viên</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <!-- <h4 class="card-title">Phê duyệt tài khoản giáo viên</h4> -->
                    <div class="right-top-section">
                        <form action="" method="" class="search">
                            <input type="search" class="form-control text-truncate" name="search" id="search" placeholder="Search...">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="list">
                    @include('admin.partials.list_accounts')
                </div>
                <div id="paginate">
                    @include('admin.partials.paginate')
                </div>
            </div>
        </div>
    </div>
</div>
@vite('resources/js/teacher/fill_teacher_data.js')
@include('teachers.confirm_information_modal')
@endsection