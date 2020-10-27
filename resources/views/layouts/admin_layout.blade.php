<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{--    <link href="{{ asset('css/app_1.css') }}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield('styles')
</head>
<body>
@extends('dashboard')

@section('content')
<div id="app">


    <div class="container" style="margin:1px">
        <div class="row">

           @if(Auth::check())





                <div class="col-lg-2">


                    <ul class="list-group">

                        <li class="list-group-item">
                            <a href={{route('assets.index')}}>Team Assets</a>
                        </li>

                        <li class="list-group-item">
                            <a href={{route('assets.create')}}>Create a New Asset</a>
                        </li>
                        <li class="list-group-item">
                            <a href={{route('categories.index')}}>Category List/Create</a>
                        </li>
                        <li class="list-group-item">
                            <a href={{route('tags.index')}}>Tags List/Create</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">Create a new tag</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">All tags</a>
                        </li>

                        <li class="list-group-item">
                            <a href="#">All posts</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">All trashed posts</a>
                        </li>

                        @if(Auth::user()->admin)
                            <li class="list-group-item">
                                <a href="#">Users</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Create a new user</a>
                            </li>

                        @endif

                        <li class="list-group-item">
                            <a href="#">My profile</a>
                        </li>


                        @if(Auth::user()->admin)

                            <li class="list-group-item">
                                <a href="#">Blog settings</a>
                            </li>
                        @endif

                    </ul>
                </div>

            @endif

            <div class="col-lg-10">


                @yield('content_page')

            </div>
        </div>
    </div>


</div>

@endsection

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/toastr.min.js') }}"></script>--}}

{{--<script>--}}
{{--    @if(Session::has('success'))--}}
{{--    toastr.success("{{ Session::get('success') }}")--}}
{{--    @endif--}}
{{--    @if(Session::has('info'))--}}
{{--    toastr.info("{{ Session::get('info') }}")--}}
{{--    @endif--}}
{{--</script>--}}
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>
