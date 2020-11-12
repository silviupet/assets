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
            {!! Form::open(['method'=>'DELETE', 'action'=>['TagsController@destroy', $t->id], 'onsubmit'=>"return confirm('Are you sure you want to delete this item?')"]) !!}
            {!! Form::submit('Delete tag', ['class'=>'btn btn-danger']) !!}
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

                        @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td><a href="{{route('tags.edit', $tag->id)}}">{{$tag->name}}</a></td>
                                <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'no date'}}</td>
                                {{--                        <td><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></td>--}}
                                <td>
                                    {!! Form::open(['method'=>'GET', 'action'=>['TagsController@edit', $tag->id]]) !!}
                                    {!! Form::submit('Edit Tag', ['class'=>'btn btn-primary']) !!}
                                    {!! Form::close() !!}

                                </td>


                            </tr>
                        @elseif(Auth::user()->isEditor())
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td><a href="{{route('tags.edit', $tag->id)}}">{{$tag->name}}</a></td>
                                <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'no date'}}</td>
                                {{--                        <td><a href ="{{route('categories.destroy', $category->id)}}" style="color:red">delete</a></td>--}}
                                @if($tag->user_id===(Auth::user()->id))
                                    <td>
                                        {!! Form::open(['method'=>'GET', 'action'=>['TagsController@edit', $tag->id]]) !!}
                                        {!! Form::submit('Edit Tag', ['class'=>'btn btn-primary']) !!}
                                        {!! Form::close() !!}

                                    </td>
                                @endif

                            </tr>
                        @else
                            <td>{{$tag->id}}</td>
                            <td>{{$tag->name}}</a></td>
                            <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'no date'}}</td>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            @else
                <h2>no tags found for this team</h2>
            @endif



        </div>



    </div>





@endsection
@include('include.form_error')
