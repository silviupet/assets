
@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Site de gestionare a activelor proprii
@endsection

@section('title')
    Create Assets
@endsection
@include('include.flash_messages')
@section('content_page')
    <h1>Create an Asset</h1>
    <div class="row">
        {!!Form::open(['method'=>'POST', 'action'=> 'AssetsController@store', 'files' => true])!!}
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
                {!! Form::submit('Create Asset', ['class'=>'btn btn-primary']) !!}
            </div>
        {!!Form::close()!!}

    </div>



@endsection
@include('include.form_error')
