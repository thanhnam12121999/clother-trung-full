@extends('admin.layouts.master')
@section('breadcrumb', 'Chỉnh Sửa nhân viên')
@section('active-manager', 'active')
@section('contents')
<form action="{{ route('admin.managers.update', $account->id) }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    @method('PUT')
    <section class="content-header">
        <div class="breadcrumb">
            <button type = "submit" class="btn btn-primary btn-sm mr-3">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Cập nhật]
            </button>
            <a class="btn btn-default btn-sm" href="{{ route('admin.manager.index') }}" role="button">
                <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
            </a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="view">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên người dùng <span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:100%" value="{{ $account->name }}">
                                </div>
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Email<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="email" style="width:100%"  value="{{ $account->email }}">
                                </div>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Tài khoản<span class = "text-danger">(*)</span></label>
                                    <input type="text" class="form-control" name="username" style="width:100%"  value="{{ $account->username }}">
                                </div>
                                @error('username')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number" style="width:100%"  value="{{ $account->phone_number }}">
                                </div>
                                @error('phone_number')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feature-image">Ảnh đại diện</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label">Chọn ảnh đại diện</label>
                                        </div>
                                    </div>
                                    @error('avatar')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @error('avatar')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    @php
                                        $disableSelect = getAccountInfo()->role == $account->accountable->role ? 'disabled' : '';
                                    @endphp
                                    <label>Quyền</label>
                                    <select {{ $disableSelect }} name="status" class="form-control">
                                        <option value="">Chọn quyền</option>
                                        @foreach ($roles as $role)
                                            <option {{$account->accountable->roles->id == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <select name="gender" class="form-control">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                        @error('gender')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </select>
                                </div>
                                @error('gender')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Ngày sinh<span class = "text-danger">(*)</span></label>
                                    <input type="date" class="form-control" name="date_of_birth" style="width:100%"  value="{{$account->date_of_birth}}">
                                </div>
                                @error('date_of_birth')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
@endsection
@section('custom-script')
<script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        bsCustomFileInput.init();
    </script>
@endsection
