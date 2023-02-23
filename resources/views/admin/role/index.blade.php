@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
@endsection
@section('active-role', 'active')
@section('breadcrumb', 'Phân Quyền')
@section('contents')
<div class="breadcrumb">
    <div class="btn-add">
        <a href="{{ route('admin.role.form_create') }}" id="btn-form-add" class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-plus"></span>Thêm Mới
        </a>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" id="view">
                <div class="box-header with-border">
                    <div class="box-body">
                        <div class="row row-table">
                            <div id="render-list-product" style="width: 98%;margin: auto;">
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="permission-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Tên Vai Trò</th>
                                                <th class="text-center">Mô Tả</th>
                                                <th class="text-center">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form id="fixx" action="">
                                                @foreach ($roles as $role)
                                                <tr>
                                                    <td class="text-center">{{$role->id}}</td>
                                                    <td class="text-center">{{$role->name}}</td>
                                                    <td class="text-center">{{$role->display_name}}</td>
                                                    <td class="text-center">
                                                        <a type="button" href="{{ route('admin.role.edit', ['id'=>$role->id]) }}"
                                                            data-url="up"
                                                            class="btn btn-success btn-xs btn-edit-product"><i class="fa fa-plus"
                                                                aria-hidden="true"></i>Sửa</a>
                                                        <button type="button" data-url="{{ route('admin.role.delete', $role->id) }}"
                                                        class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        Xóa</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        $(function() {
            //   $("#example1").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#permission-list').DataTable({
                "paging": true,
                // "lengthChange": false,
                // "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('.btn-delete').click(function (e) {
                e.preventDefault();
                let url = $(this).attr('data-url');
                Swal.fire({
                    title: 'Bạn chắc chắn muốn xóa vai trò này?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#42c119',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            });
        });
    </script>
@endsection
