@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Bảng chấm công</h3>
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
                <a href="#">Bảng chấm công</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class ="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class = "d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Bảng Chấm Công - Tháng {{ $month }}/{{ $year }}</h4>
                        <form action="{{ route('teacher.table_timekeeping') }}" method="GET"
                            class="d-flex align-items-center header_content_timekeeping_search">
                            <div class="input-group">
                                <input type="text" id="search_attendance" name="search_attendance"
                                    value="{{ request('search_attendance') ?? \Carbon\Carbon::now()->format('m/Y') }}"
                                    class="form-control" placeholder="mm/yyyy">
                                <div class="btn btn-dark ms-1 icon_calendar">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-nowrap col-md-3">Họ Tên</th>
                                    <th class="text-nowrap col-md-3">Chức Vụ</th>
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        <th>{{ $i }}</th>
                                    @endfor
                                    <th>Tổng Công Làm</th>
                                    <th>Tổng Công Nghỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-nowrap col-md-3">{{Auth::user()->name}}</th>
                                    <th class="text-nowrap col-md-3">Develop</th>
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        <th>
                                            @php
                                                $date = \Carbon\Carbon::create($year, $month, $i)->format('Y-m-d');
                                                echo isset($workingDays[$date]) ? $workingDays[$date] : '';
                                            @endphp
                                        </th>
                                    @endfor
                                    <th>{{ $totalWorkingHours }}</th>
                                    <th>{{ $totalDaysOff }}</th>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
