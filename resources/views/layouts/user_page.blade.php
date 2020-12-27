@extends('dashboard')
@section('content')
    {{--    <x-left_sidebar></x-left_sidebar>--}}
    <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                 @include('partials._left_sidebar')
                </div>
                <div class="col-10">
                    <div class="content" style="padding-left: 30px; padding-top:30px" >

                    @yield('content_page')
                    </div>
                </div>
             </div>
    </div>
@endsection
