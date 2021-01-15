@extends('layouts.user_page')
@section('meta_titlu')
    Atributele unui activ
@endsection
@section('meta_descriere')
    Aici putem edita atributele, caracteristicile, la  activele, asseturi, existente ca de exemplu factura, asigurare, inchiriere, garantie, etc
@endsection
@section('title')
    Edit an Atribute of an existing Asset
@endsection
@include('include.flash_messages')
@section('content_page')

{{--        {!! Form::open() !!}--}}
        {!! Form::model($atribute, ['method'=>'PATCH', 'action'=> ['AtributesController@update', $atribute->id],'files' => true]) !!}
        {!! Form::token() !!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">




{{--                <div class="form-group">--}}
{{--                    {!!Form::label('asset_id', 'Asset that Atribute belongs to:')!!}--}}
{{--                    {!!Form::select('asset_id', [''=>'Choose Asset ..'] + $assets, null , ['class'=>'form-control'])!!}--}}

{{--                </div>--}}
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
                    {!!FORM::date('from_date', null , ['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('expiry_date' , 'Expiry Date: ')!!}
                    {!!FORM::date('expiry_date', null , ['class'=>'form-control'])!!}
                </div>


            </div>
            <div class="col-6">

                <div class="form-group">
                    {!!Form::label('price' ,'Price: (if exist)')!!}
                    {!!FORM::number('price' , null , ['class'=>'form-control'])!!}
                </div>

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

{{--@foreach($atribute->tags as $tag)--}}
{{--                <div class="form-group">--}}
{{--                    {!!Form::label('tag_id', 'Tags of attribute:')!!}--}}
{{--                    {!! Form::select('tag_id[]',[''=>'choose Tags..'] + $tags, $atribute->tags,  ['class'=>'form-control','multiple'=>true])!!}--}}

{{--                </div>--}}
{{--                @endforeach--}}


{{--@foreach ($atribute->documents as $document)--}}
{{--                <div class="form-group">--}}
{{--                    {!!Form::label('document_name', 'Document name: (if exists)')!!}--}}
{{--                    {!! Form::text('document_name', $document->name, ['class'=>'form-control']) !!}--}}
{{--                    {!! Form::select('document_name', $document->name, ['class'=>'form-control']) !!}--}}
{{--                </div>--}}


{{--                <div class="form-group">--}}

{{--                    {!!Form::label('document', 'Document attach here : (if exists)')!!}--}}

{{--                    {!! Form::file('document', null, ['class'=>'form-control']) !!}--}}
{{--                </div>--}}


{{--                @endforeach--}}
            </div>
            <div class="col-6">
                <div class="form-group">
                {!! Form::submit('Update Atribute', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>
            </div>
             {!! Form::close() !!}
            <div class="col-6">
            {!! Form::open(['method'=>'DELETE', 'action'=> ['AtributesController@destroy', $atribute->id],'onsubmit'=>"return confirm('Are you sure you want to delete this item?')"]) !!}
            {!! Form::token() !!}

                <div class="form-group">
                {!! Form::submit('Delete Atributes', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@include('include.form_error')
