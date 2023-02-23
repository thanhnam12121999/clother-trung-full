<div class="col-lg-9 order-1 order-lg-2">
{{--    <div class="product-show-option">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-7 col-md-7">--}}
{{--                <div class="select-option">--}}
{{--                    <select class="sorting">--}}
{{--                        <option value="">Default Sorting</option>--}}
{{--                    </select>--}}
{{--                    <select class="p-show">--}}
{{--                        <option value="">Show:</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-5 col-md-5 text-right">--}}
{{--                <p>Show 01- 09 Of 36 Product</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="product-list">
        <div class="row">
            @if ($products && !$products->total())
                <div class="col-12">
                    <h3 class="text-center">Không có sản phẩm nào</h3>
                </div>
            @else
                @foreach ($products as $product)
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-item">
                            @php
                                $isUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                            @endphp
                            <div class="pi-pic">
                                <img src="{{ $isUrl ? $product->feature_image : $product->feature_image_path }}" alt="">
                                {{-- <div class="sale pp-sale">Sale</div> --}}
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active">
                                        <a href="#"><i class="icon_bag_alt"></i></a>
                                    </li>
                                    <li class="quick-view"><a href="{{ route('products.slug', [ 'slug' => $product->slug ]) }}">+ Chi tiết</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $product->category->name }}</div>
                                <a href="#">
                                    <h5>{{ $product->name }}</h5>
                                </a>
                                {{-- <div class="product-price">
                                    $14.00
                                    <span>$35.00</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ asset('user/img/products/product-1.jpg') }}" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="#">+ Quick View</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">Towel</div>
                        <a href="#">
                            <h5>Pure Pineapple</h5>
                        </a>
                        <div class="product-price">
                            $14.00
                            <span>$35.00</span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4 pagination-section">
        {{ $products->links('user.layouts.components.pagination') }}
    </div>
{{--    <div class="loading-more">--}}
{{--        <i class="icon_loading"></i>--}}
{{--        <a href="#">--}}
{{--            Loading More--}}
{{--        </a>--}}
{{--    </div>--}}
</div>
