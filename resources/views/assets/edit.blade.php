@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection

@section('title')
    Edit Assets
@endsection
@include('include.flash_messages')
@section('content_page')
{{--    <h1>Edit an Asset</h1>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-12">--}}



            {!!Form::model($asset, ['method'=>'PATCH', 'action'=> ['AssetsController@update', $asset->id],'files' => true])!!}
            {!! Form::token() !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control'])!!}
                </div>

                 <div class="form-group">
                     {!! Form::label('category_id', 'Category:') !!}
                     {!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control'])!!}
                 </div>



                <div class="form-group">
                    {!! Form::submit('Update Asset', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!!Form::close()!!}
            {!! Form::open(['method'=>'DELETE', 'action'=> ['AssetsController@destroy', $asset->id],'onsubmit'=>"return confirm('Are you sure you want to delete this item?')"]) !!}
                {!! Form::token() !!}
            <div class="form-group">
                {!! Form::submit('Delete Asset', ['class'=>'btn btn-danger col-sm-6']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
@include('include.form_error')
