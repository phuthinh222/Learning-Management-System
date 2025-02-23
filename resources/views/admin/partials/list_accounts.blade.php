<div class="table-responsive">
    <table id="add-row" class="display table table-striped table-hover">
        <thead>
            <tr>
                <th>Tên tài khoản</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Ngày tạo</th>
                <!-- <th>Quyền</th> -->
                <th style="width: 10%">Thao tác</th>
            </tr>
        </thead>
        @if(isset($message))
        <tbody>
            <tr>
                <td colspan="5" class="text-center">
                    <h5> {{$message}} </h5>
                </td>
            </tr>
        </tbody>
        @else
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->user_name}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email_address}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <div class="form-button-action">
                        <button id="confirmInf{{$user->id}}" type="button" data-bs-toggle="modal" data-bs-target="#modalConfirm-{{$user->userable_id}}"
                            data-idteacher="{{$user->userable_id}}" class="btn btn-link btn-success btn-lg confirm_information">
                            <i class="fa fa-check"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
</div>