@extends('layouts.user_page')
@section('meta_titlu')
    Atributele unui activ
@endsection
@section('meta_descriere')
    Aici putem crea  atributele, caracteristicile, la  activele, asseturi, existente ca de exemplu factura, asigurare, inchiriere, garantie, etc
@endsection
@section('title')
    Create a new Atribute of an existing Asset
@endsection
@include('include.flash_messages')
@section('content_page')
    {!! Form::open(['method'=>'POST', 'action'=>'AtributesController@store', 'files'=>true]) !!}
    {!! Form::token() !!}
<div class="container-fluid">
    <div class="row">

        <div class="col-6">




            <div class="form-group">
                {!!Form::label('asset_id', 'Asset that Atribute belongs to:')!!}
                {!!Form::select('asset_id', [''=>'Choose Asset ..'] + $assets, null , ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('name', 'Atribute name: ')!!}
                {!!FORM::text('name' , null, ['class'=>'form-control'])!!}
            </div>

             <div class="form-group">
                {!!Form::label('description', 'Description: ')!!}
                {!!FORM::text('description' , null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!!Form::label('from_date' , 'From Date: ')!!}
                {!!FORM::date('from_date', \Carbon\carbon::now() , ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('expiry_date' , 'Expiry Date: ')!!}
                {!!FORM::date('expiry_date', \Carbon\carbon::now(), ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('price' ,'Price: (if exist)')!!}
                {!!FORM::number('price' , null , ['class'=>'form-control'])!!}
            </div>

        </div>
        <div class="col-6">

            <div class="form-group">
                {!!Form::label('currency' , 'Currency: (if exist)')!!}
                {!!FORM::select('currency', ['RON'=>'RON', 'EUR'=>'EUR', 'USD'=>'USD'], null, ['placeholder'=>'Select a currency ...' , 'class'=>'form-control'] , )!!}
            </div>
            <div class="form-group">
                {!!Form::label('vendor', 'Vendor: (if exist)')!!}
                {!!FORM::text('vendor' , null, ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('other_conditions', 'Other Conditions: (if exist)')!!}
                {!!FORM::text('other_conditions' , null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!!Form::label('tag_id', 'Tags of attribute:')!!}
                {!!Form::select('tag_id[]', [''=>'chose tags...']+$tags, null , ['class'=>'form-control', 'multiple'=>true ,])!!}
            </div>

            <div class="form-group">
                {!!Form::label('document_name', 'Document name: (if exists)')!!}
                {!! Form::text('document_name', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!!Form::label('document', 'Document attach here : (if exists)')!!}
                {!! Form::file('document', null, ['class'=>'form-control']) !!}
            </div>

        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::submit('Create an Atribute', ['class'=>'btn btn-primary col-12 ']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
@include('include.form_error')

