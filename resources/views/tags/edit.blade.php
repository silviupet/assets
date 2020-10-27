@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection
@section('title')
    Tags
@endsection
@include('include.flash_messages')
@section('content_page')
    <h1>Tags</h1>
    <div class="row">
        <div class="col-sm-4">

            {!! Form::model($t,['method'=>'PATCH', 'action'=> ['TagsController@update', $t->id]]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Tag', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}



        </div>




        <div class="col-sm-8">


            @if($tags)


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

                    @foreach($tags as $tag)

                        <tr>
                            <td>{{$tag->id}}</td>
                            <td><a href="{{route('tags.edit', $tag->id)}}">{{$tag->name}}</a></td>
                            <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'no date'}}</td>
                            {{--                        <td><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></td>--}}
{{--                            <td>--}}
{{--                                {!! Form::open(['method'=>'DELETE', 'action'=>['TagsController@destroy', $tag->id]]) !!}--}}
{{--                                {!! Form::submit('Delete tag', ['class'=>'btn btn-danger']) !!}--}}
{{--                                {!! Form::close() !!}--}}
{{--                            </td>--}}


                        </tr>
                    @endforeach

                    </tbody>
                </table>

            @endif



        </div>



    </div>





@endsection
@include('include.form_error')
