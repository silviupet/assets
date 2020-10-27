@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection
@section('title')
    Categories
@endsection
@include('include.flash_messages')
@section('content_page')
{{--    <h1>Categories</h1>--}}
    <div class="row">
        <div class="col-sm-4">

            {!! Form::open(['method'=>'POST', 'action'=> 'CategoriesController@store']) !!}
                 <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                  {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
                 </div>
            {!! Form::close() !!}



         </div>




        <div class="col-sm-8">


            @if($categories)


            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Created date</th>
                    <th>delete</th>

                </tr>
                </thead>
                <tbody>

                @foreach($categories as $category)

                    <tr>
                        @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
{{--                        <td><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></td>--}}
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['CategoriesController@destroy', $category->id]]) !!}
                            {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    @elseif(Auth::user()->isEditor() && ($category->user_id === Auth::user()->id) )
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                            {{--                        <td><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></td>--}}
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['CategoriesController@destroy', $category->id]]) !!}
                                {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                       @else
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at ? $category->created_at ->diffForHumans():'no date'}}</td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>

            @endif



        </div>



    </div>





@endsection
@include('include.form_error')
