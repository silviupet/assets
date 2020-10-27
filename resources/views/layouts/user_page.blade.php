@extends('dashboard')
@section('content')
    {{--    <x-left_sidebar></x-left_sidebar>--}}
    <div class="row">
        <div class="col-sm-2">
            @include('partials._left_sidebar')
        </div>
        <div class="col-sm-10">
            <div class="content" style="padding: 15px">

                @yield('content_page')
            </div>
        </div>
    </div>

@endsection
