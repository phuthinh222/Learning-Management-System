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
                        <h4 class="card-title">Bảng Chấm Công Của Giáo Viên - Tháng {{ $month }}/{{ $year }}</h4>
                        <form action="{{ route('admin.table_timekeeping') }}" method="GET"
                            class="d-flex align-items-center header_content_timekeeping_search">
                            <div class="input-group">
                                <input type="text" id="search_attendance" name="search_attendance"
                                    value="{{ request('search_attendance') ?? \Carbon\Carbon::now()->format('m/Y') }}"
                                    class="form-control" placeholder="mm/yyyy">
                                <div class="btn btn-dark ms-1 icon_calendar z-0">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center fixed-col1 width">Họ Tên</th>
                                    <th class="text-center fixed-col2 width">Chức Vụ</th>
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        <th class="text-center">{{ $i }}</th>
                                    @endfor
                                    <th class="text-center">Tổng Công Làm</th>
                                    <th class="text-center">Tổng Công Nghỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workingDays as $teacherName => $attendanceData)
                                   
                                        <tr>
                                            <td class="text-center fixed-col1 width">{{ $teacherName }}</td>
                                            <td class="text-center fixed-col2 width">{{ $attendanceData['position'] ?? '' }}</td>
                                            @for ($i = 1; $i <= $daysInMonth; $i++)
                                                @php
                                                    $date = \Carbon\Carbon::create($year, $month, $i)->format('Y-m-d');
                                                @endphp
                                                <td class="text-center">{{ $attendanceData[$date] ?? 'N' }}</td>
                                            @endfor
                                            <td class="text-center">{{ $attendanceData['totalWorkingHours'] ?? 0 }}</td>
                                            <td class="text-center">{{ $attendanceData['totalDaysOff'] ?? $daysInMonth }}</td>
                                        </tr>
                                  
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
