
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
    {!!Form::open(['method'=>'POST', 'action'=> 'AssetsController@store', 'files' => true])!!}
    {!! Form::token() !!}
    <div class="container-fluid">
    <div class="row">

        <div class="col-8">
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control'])!!}
            </div>




            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control'])!!}
            </div>
        </div>
        

        <div class="col-6">
            <div class="form-group">
                {!! Form::submit('Create Only an  Asset', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!!Form::close()!!}

    </div>
    </div>







<div id="atr_form">

</div>



<script>
        $(document).ready(function(){
            $('#atr_form').hide()

        })
</script>


@endsection


@include('include.form_error')
