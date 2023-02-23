<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <base href="{{ asset('') }}" />

    @include('user.layouts.components.stylesheet')
</head>

<body>
{{-- <!-- Page Preloder -->
@if(!session()->has('success') || !session()->has('errors'))
    <div id="preloder">
        <div class="loader"></div>
    </div>
@endif --}}
<div class="loader"></div>
@include('user.layouts.components.header')

@yield('breadcrumb')
@yield('content')

@include('user.layouts.components.footer')

@include('user.layouts.components.script')
</body>

</html>
