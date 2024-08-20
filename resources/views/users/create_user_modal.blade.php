<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Thêm tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="create-user-form" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Tên đăng nhập -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="user_name" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-truncate @error('user_name') is-invalid @enderror"
                                    id="user_name" name="user_name" value="{{ old('user_name') }}"/>
                                @error('user_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Họ và tên -->
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-truncate @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mật khẩu -->
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <input id="password" type="password"
                                    class="form-control text-truncate @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Địa chỉ email -->
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Địa chỉ email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control text-truncate @error('email_address') is-invalid @enderror"
                                    id="email" name="email_address" value="{{ old('email_address') }}" />
                                @error('email_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sinh nhật -->
                            <div class="form-group mb-3">
                                <label for="datepicker" class="form-label">Sinh nhật <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-truncate @error('date_of_birth') is-invalid @enderror"
                                    id="datepicker" name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Số điện thoại -->
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control text-truncate @error('phone_number') is-invalid @enderror"
                                    id="phone" name="phone_number" value="{{ old('phone_number') }}" />
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Nơi ở hiện tại -->
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Nơi ở hiện tại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-truncate @error('address') is-invalid @enderror"
                                    id="address" name="address" value="{{ old('address') }}" />
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Chọn vai trò -->
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Chọn vai trò <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <div class="form-check me-3">
                                        <input class="form-check-input @error('role') is-invalid @enderror"
                                            type="radio" name="role" id="role_student" value="student"
                                            {{ old('role', 'student') == 'student' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_student">Học sinh</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input @error('role') is-invalid @enderror"
                                            type="radio" name="role" id="role_teacher" value="teacher"
                                            {{ old('role') == 'teacher' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_teacher">Giáo viên</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('role') is-invalid @enderror"
                                            type="radio" name="role" id="role_employee" value="employee"
                                            {{ old('role') == 'employee' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_employee">Nhân viên</label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                </div>
            </form>
        </div>
    </div>
</div>