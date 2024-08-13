@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Trang chủ</h3>
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
                <a href="#">Trang chủ</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <h1>Chào mừng bạn đến với trang Quản trị giáo dục ECM!</h1>
    </div>
@endsection
