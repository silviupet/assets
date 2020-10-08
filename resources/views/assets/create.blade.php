@extends('layouts.admin_layout')

@section('title')
    Create Assets
@endsection
@include('include.flash_messages')
@section('content_page')
    <h1>Create an Asset</h1>
    <div class="row">
{!!Form::open(['method'=>'POST', 'action'=> 'AssetsController@store', 'files' => true])!!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control'])!!}

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
