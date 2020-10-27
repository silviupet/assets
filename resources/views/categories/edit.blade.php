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

            {!! Form::model($cat, ['method'=>'PATCH', 'action'=> ['CategoriesController@update', $cat->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
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
{{--                        <th>delete</th>--}}

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
{{--                            <th><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></th>--}}
                        </tr>
                        @elseif(Auth::user()->isEditor() && ($category->user_id === Auth::user()->id) )
                         <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                         </tr>
                        @else
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            @else
                <h2>no category found for this team</h2>
            @endif



        </div>



    </div>





@endsection
@include('include.form_error')
