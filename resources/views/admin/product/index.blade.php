@extends('admin.layouts.master')
@section('custom-css')
    @include('admin.components.css.datatables')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('active-products', 'active')
@section('breadcrumb', 'Sản Phẩm')
@section('contents')
<div class="breadcrumb">
    @if (checkPermission('product-add'))
    <div class="btn-add">
        <a id="" href="{{ route('admin.products.form_create') }}" class="btn btn-primary btn-sm" role="button">
            <span class="glyphicon glyphicon-plus"></span>Thêm Mới
        </a>
    </div>
    @endif
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" id="view">
                <div class="box-header with-border">
                    <div class="box-body">
                        <div class="row row-table"  data-url="list">
                            <div id="render-list-product" style="width: 98%;margin: auto;">
                                <div id="table-responsive1" class="table-responsive">
                                    <table id="product-list" class="table table-hover table-bordered table-content">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="5%">ID</th>
                                                <th class="text-center" width="15%">Tên</th>
                                                <th class="text-center" width="10%">Hình Ảnh</th>
                                                <th class="text-center" width="10%">Danh Mục</th>
                                                <th class="text-center" width="15%">Tóm lược</th>
                                                <th class="text-center" width="5%">Trạng Thái</th>
                                                <th class="text-center" width="15%">Thời gian tạo</th>
                                                <th class="text-center" width="15%">Thời gian tạo gần nhất</th>
                                                <th class="text-center" width="15%">Thao Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr id="id-product">
                                                @php
                                                    $isUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                                                @endphp
                                                <td class="text-center">{{$product->id}}</td>
                                                <td class="text-center">{{$product->name}}</td>
                                                <td class="text-center">
                                                    <img style="max-height: 200px; width: 100px;" src="{{ $isUrl ? $product->feature_image : $product->feature_image_path }}">
                                                </td>
                                                <td class="text-center">{{$product->category->name}}</td>
                                                <td class="text-center">{{$product->summary}}</td>
                                                <td class="text-center">
                                                    @if ($product->status == 1)
                                                    <i style="color: green" class="fa fa-check" aria-hidden="true"></i>
                                                    @else
                                                    <i style="color: red" class="fa fa-times" aria-hidden="true"></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{$product->created_at}}</td>
                                                <td class="text-center">{{$product->updated_at}}</td>
                                                <td class="text-center">
                                                    @if (checkPermission('product-show'))
                                                        <a href="{{ route('admin.products.show', $product->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>Xem</a>
                                                    @endif
                                                    @if (checkPermission('product-edit'))
                                                        <a href="{{ route('admin.products.edit', $product->id) }}" type="button"
                                                        class="btn btn-success btn-xs btn-edit-psroduct"><i class="fa fa-plus"
                                                            aria-hidden="true"></i>Sửa</a>
                                                    @endif
                                                    @if (checkPermission('product-delete'))
                                                        <button data-url="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash" aria-hidden="true"></i>
                                                            Xóa</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-script')
    @include('admin.components.js.datatables')
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endsection
@section('my-script')
    <script>
        $(function() {
            $('#product-list').DataTable({
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
                    title: 'Bạn chắc chắn muốn xóa sản phẩm này?',
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
