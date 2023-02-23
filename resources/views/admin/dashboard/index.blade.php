@extends('admin.layouts.master')
@section('active-dashboard', 'active')
@section('breadcrumb', 'Bảng Điều Khiển')
@section('contents')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Thông Báo</span>
                <span class="info-box-number">
                {{ $adminNoti->total() }}
                {{-- <small>100</small> --}}
                </span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Số Đơn Hàng</span>
                <span class="info-box-number">{{ number_format($ordersCount) }}</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Số Thành Viên</span>
                <span class="info-box-number">{{ number_format($membersCount) }}</span>
            </div>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
