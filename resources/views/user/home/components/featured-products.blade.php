<!-- Women Banner Section Begin -->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-3"> --}}
            {{-- <div class="product-large set-bg" data-setbg="{{ asset('user/img/products/women-large.jpg') }}"> --}}
            {{-- <h2>Women’s</h2> --}}
            {{-- <a href="#">Discover More</a> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <div class="col-lg-12">
                <div class="filter-control">
                    <h2 style="font-family: monospace">Sản phẩm nổi bật</h2>
                </div>
                @if ($products->isNotEmpty())
                    <div class="product-slider owl-carousel">
                        @foreach ($products as $product)
                            @php
                                $isFeatureImageUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                            @endphp
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ $isFeatureImageUrl ? $product->feature_image : $product->feature_image_path }}"
                                        alt="">
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a
                                                href="{{ route('products.slug', ['slug' => $product->slug]) }}">+
                                                Chi tiết</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{ $product->category->name }}</div>
                                    <a href="#">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
                                    @php
                                        $price = 0;
                                        foreach ($product->variants as $variant) {
                                            $price += $variant->unit_price;
                                        }
                                    @endphp
                                    <div class="product-price">
                                        {{ number_format($product->variants->min('unit_price'), 0, ',', '.') }}đ
                                        {{-- <span>&nbsp;</span><span style="font-size: 13px">vnđ</span> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="filter-control">
                        <h3>Chưa có sản phẩm</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->
