

{{--@extends('layouts.admin_layout')--}}
@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
    @endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection
@section('title')
    Assets
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
                    <td><a  href="{{route('assets.show', $asset->slug)}}">{{$asset->name}}</td>
                    <td>{{$asset->created_at->diffForhumans()}}</td>
                    <td>{{$asset->updated_at->diffForhumans()}}</td>
                    @if($asset->category_id)
                    <td><a  href="{{route('assets.indexbycategory', $asset->category_id)}}">{{$asset->category->name}}</td>
                    @else
                    <td>{{$asset->category->name ??  "no category"}}</td>
                    @endif
                    @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                     <td>
                         {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->slug]]) !!}
                         {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}
                         {!! Form::close() !!}
                     </td>

                    @elseif(Auth::user()->isEditor() && ($asset->user_id ===Auth::user()->id))
                    <td>
                        {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->slug]]) !!}
                        {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}

                    </td>
                    @endif
                <td>
                    {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@createAtributeOfAnAsset',$asset->id]]) !!}
                    {!! Form::submit('Add an Atribute to this Asset', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </td>

            </tr>
            @endforeach
        </table>

    @else

        <h1 class="text-center">No Assets available</h1>

    @endif
@endsection
@include('include.form_error')

