<div class="modal fade" id="confirm_teacher_information" tabindex="-1" aria-labelledby="confirmTeacherInformationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirmTeacherInformationLabel">Phê duyệt thông tin Giáo Viên </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('teacher.confirmation', 1)}}" method="POST">
                @csrf()
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="user_name" class="form-label">Họ tên:</label>
                                <input type="text" class="form-control text-truncate"
                                    id="user_name" value="Nguyễn Trần Trung Quân" readonly/>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" class="form-control text-truncate"
                                    id="email" value="trungquan@gmail.com" readonly/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone_number" class="form-label">Email:</label>
                                <input type="text" class="form-control text-truncate"
                                    id="phone_number" value="0336482918" readonly/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Địa chỉ:</label>
                                <input type="text" class="form-control text-truncate"
                                    id="address" value="Thừa Thiên Huế" readonly/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Chứng chỉ</h4>
                                    </div>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="teacher_certificates">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Kinh nghiệm</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Vị trí</th>
                                                    <th>Số năm kinh nghiệm</th>
                                                    <th>Công ty</th>
                                                </tr>
                                            </thead>
                                            <tbody id="teacher_experiences">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Phê duyệt</button>
                </div>
            </form>
                
        </div>
    </div>
</div>