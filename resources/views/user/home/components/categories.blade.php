<!-- Banner Section Begin -->
<div class="banner-section spad">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="filter-control">
                    <h2 class="category-title" style="font-family: monospace">Danh mục sản phẩm</h2>
                </div>
            </div>
            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="col-lg-2">
                        <div class="single-banner h-100">
                            <img class="h-100 catalog-image" data-slug="{{ $category->slug }}"
                                src="{{ $category->image_path }}" alt="">
                            <div class="inner-text">
                                <h4>{{ $category->name }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="filter-control">
                    <h3>Chưa có danh mục sản phẩm</h3>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Banner Section End -->
