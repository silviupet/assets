

{{--@extends('layouts.admin_layout')--}}
@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection
@section('title')
    Assets of category: {{$category->name}}
@endsection
@include('include.flash_messages')
@section('content_page')
    @if(count($assets)>0)

        <table style="width:100%" class="table">

            <tr>
                <th>ID</th>
                <th>Assets Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Category</th>
            </tr>


            @foreach($assets as $asset)
                <tr>

                    <td>{{$asset->id}}</td>
                    <td><a  href="{{route('assets.show', $asset->id)}}">{{$asset->name}}</td>
                    <td>{{$asset->created_at->diffForhumans()}}</td>
                    <td>{{$asset->updated_at->diffForhumans()}}</td>
                    <td>{{$asset->category->name ??  "no name"}}</td>

                    @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                        <td>
                            {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->id]]) !!}
                            {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </td>

                    @elseif(Auth::user()->isEditor() && ($asset->user->id ===Auth::user()->id))
                        <td>
                            {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->id]]) !!}
                            {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}

                        </td>
                    @endif

                </tr>
            @endforeach
        </table>

    @else

        <h1 class="text-center">No Assets available</h1>

    @endif
@endsection
@include('include.form_error')



