<div class="modal fade" id="AddUserModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content add-user">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Thêm user mới</h1>
                </div>
                <div class="modal-body">                  
                        <div class="form-group">
                            <div class="">
                                <input type="text" class="form-control form-control-user" id='addname' name="txtname"
                                    placeholder="Nhập họ tên">
                            </div>
                            <p style="color:red" class="help is-danger">{{ $errors->first('txtname') }}</p>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id='addemail' name="email"
                                placeholder="Nhập Email">
                                <p style="color:red" class="help is-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="password" id='addpassword' placeholder="Tạo mật khẩu mới">
                            </div>
                            <p style="color:red" class="help is-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="password" class="form-control form-control-user"
                                    name="repass" id='addrepass' placeholder="Xác nhận lại mật khẩu">
                                <p style="color:red" class="help is-danger">{{ $errors->first('repass') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control " id="addgroup_role" name="group_role" >
                                <option disabled selected hidden>Chọn nhóm</option>
                                <option value="1">Admin</option>
                                <option value="2">Employee</option>
                            </select>
                            <p style="color:red" class="help is-danger">{{ $errors->first('group_role') }}</p>
                        </div>
                        <div class="form-group custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="addactive" name="addactive">  
                            <label class="custom-control-label" for="addactive">Trạng thái hoạt động</label>                      
                        </div>
                        <div class="form-group">
                            <input type='submit' class="btn btn-success btn-user btn-block btSubmitAdd" value="Thêm mới"> 
                        </div>
                </div>
            </div>
        </div>
    </div>