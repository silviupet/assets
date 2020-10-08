

@extends('layouts.admin_layout')
@section('title')
    Assets
@endsection
@include('include.flash_messages')
@section('content_page')
    @if('assets')

        <table style="width:100%">
            <tr>
                <th>ID</th>
                <th>Assets Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Category</th>
                <th>edit</th>


            </tr>
            @foreach($assets as $asset)
            <tr>

                    <td>{{$asset->id}}</td>
                    <td><a  href="{{route('assets.show', $asset->id)}}">{{$asset->name}}</td>
                    <td>{{$asset->created_at->diffForhumans()}}</td>
                    <td>{{$asset->updated_at->diffForhumans()}}</td>
                    <td>{{$asset->category->name ??  "no name"}}</td>
{{--                    <td><a  href ="{{route('assets.edit', $asset->id)}}">edit asset</td>--}}
                <td>
                    {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->id]]) !!}
                    {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </td>



            </tr>
            @endforeach
        </table>

    @elseif("no assets available")

    @endif
@endsection


