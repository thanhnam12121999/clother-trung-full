<!-- Hero Section Begin -->


<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($slides as $slide)
        <div class="single-hero-items set-bg" data-setbg="{{ asset('storage/images/slides/'.$slide->image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">

                        <h1 style="color: #2a2a2a">{{$slide->title}}</h1>
                        <p style="color: #d31010;">{!!$slide->content!!}</p>
                        <a href="{{ route('products.index') }}" class="primary-btn">Mua Ngay</a>
                    </div>
                </div>
                <div class="off-card">
                    <h2>Sale <span>50%</span></h2>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->