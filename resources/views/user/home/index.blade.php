@extends('user.layouts.master')
@section('title', 'Trang chủ')
@section('active-home')
    class="active"
@endsection
@section('content')
    @include('user.home.components.slider')
    @include('user.home.components.categories')
    @include('user.home.components.featured-products')

   {{-- <!-- Deal Of The Week Section Begin-->--}}
   {{-- <section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
       <div class="container">
           <div class="col-lg-6 text-center">
               <div class="section-title">
                   <h2>Deal Of The Week</h2>
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                       consectetur adipisicing elit </p>
                   <div class="product-price">
                       $35.00
                       <span>/ HanBag</span>
                   </div>
               </div>
               <div class="countdown-timer" id="countdown">
                   <div class="cd-item">
                       <span>56</span>
                       <p>Days</p>
                   </div>
                   <div class="cd-item">
                       <span>12</span>
                       <p>Hrs</p>
                   </div>
                   <div class="cd-item">
                       <span>40</span>
                       <p>Mins</p>
                   </div>
                   <div class="cd-item">
                       <span>52</span>
                       <p>Secs</p>
                   </div>
               </div>
               <a href="#" class="primary-btn">Shop Now</a>
           </div>
       </div>
   </section> --}}
{{--    <!-- Deal Of The Week Section End --> --}}
@endsection
