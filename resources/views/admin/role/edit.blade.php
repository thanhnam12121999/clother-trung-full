@extends('admin.layouts.master')
@section('breadcrumb', 'Sửa Vai Trò')
@section('active-role', 'active')
@section('contents')
<form action="{{ route('admin.role.update', ['id'=>$role->id]) }}" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
    @csrf
    @method('PUT')
    <div id="modal-role-edit">
        <div class="modal-dialog modal-xl modal-dialog-style">
            <div class="modal-content">
                <div class="modal-header modal-header-style">
                    <h5 class="modal-title" id="myModalLabel">Edit</h5>
                </div>
                <div class="modal-body-main">
                    <div class="modal-body data-table">
                        {{-- <input type="hidden" name="_token" id="token2" value="{{ csrf_token() }}"> --}}
                        <div class="box-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control name-role" id="name-role-edit" value="{{$role->name}}" name="name">
                                <span class="errors" style="color: red" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Display Name</label>
                                <textarea class="form-control display-name" name="display_name" id="display_name"
                                    rows="3">{{$role->display_name}}</textarea>
                                <span class="errors display-name" style="color: red" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label>
                                        <input type="checkbox" class="checked">
                                    </label> Check All
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                            <div class="card mb-3" style="width: 100%;">
                                <div class="card-header card-header-sty" style="">
                                    <label class="lable-checkbox">
                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                    </label>
                                    Module {{$permission->name}}
                                </div>
                                <div class="card mb-3" style="margin: 0!important">
                                    <div class="row">
                                        @foreach ($permission->permissionsChildrent as $permissionsChildrentItem)
                                        <div class="col col-md-3">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <label class="lable-checkbox">
                                                        <input type="checkbox"
                                                            id="permission{{$permissionsChildrentItem->id}}"
                                                            name="permission_id[]"
                                                            value="{{$permissionsChildrentItem->id}}"
                                                            class="checkbox_childrent"
                                                            @if(in_array($permissionsChildrentItem->id, $role_permissions)) checked @endif>
                                                    </label>
                                                    {{$permissionsChildrentItem->name}}
                                                </h5>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="update-role1" class="btn btn-primary ">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection
@section('custom-script')

@endsection
@section('my-script')

@endsection
