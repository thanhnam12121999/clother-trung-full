@extends('user.layouts.master')
@section('title', 'Shop')
@if (empty($slug))
    @section('active-product')
        class="active"
    @endsection
@else
    @section('active-category')
        class="active"
    @endsection
@endif
@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        @if (!empty($slug))
                            <a href="{{ url()->current() }}">Danh mục sản phẩm</a>
                            <span>{{ $category->name }}</span>
                        @else
                            <span>Shop</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
@endsection

@section('content')
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('user.products.components.sidebar')
                @include('user.products.list.product-list')
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection

@section('custom-js')
    <script src="{{ asset('user/custom-js/products/script.js') }}"></script>
@endsection