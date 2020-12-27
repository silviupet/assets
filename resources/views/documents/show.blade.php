@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Aici afisam toate documentele
@endsection
@section('title')
 Documents
@endsection
@include('include.flash_messages')
@section('content_page')



        <div>

         @if(pathinfo('documents/'.$document->link, PATHINFO_EXTENSION) =="pdf")
                <iframe src="{{asset('documents/'.$document->link)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>;
            @elseif (in_array(pathinfo('documents/'.$document->link, PATHINFO_EXTENSION) , ['xls', 'xlsx', 'doc', 'docx', 'csv']) )
{{--                {{asset('documents/'.$document->link)}}--}}


{{--
   <iframe src="http://docs.google.com/gview?url={{asset('documents/'.$document->link)}}&embedded=true" frameborder="0" style="width:100%;min-height:640px;"></iframe>--}}
                <button class="btn btn-primary " type ="submit", onclick="window.open('{{asset('documents/'.$document->link)}}')"><i class="fa fa-download"></i> Download</button>


            @else

                <img src="{{asset('/documents/'.$document->link)}}" alt=""style="width:100%;min-height:640px;">
         @endif

{{--            @if(upload is image)--}}
{{--                <img src="{{image url}}"/>--}}
{{--            @elseif(upload is pdf)--}}
{{--                <iframe src="{{pdf url}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>--}}
{{--            @elseif(upload is document)--}}
{{--                <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{urlendoe(doc url)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>--}}
{{--            @else--}}
{{--                //manage things here--}}
{{--            @endif--}}

{{--            <img src="{{asset('storage/1608842074fact enel 21 rez dec 2020.pdf')}}" width="20px" height="20px"/>--}}
{{--            <img src="{{asset('/documents/'.$document->link)}}" alt="">--}}

{{--            <img src="https://www.w3schools.com/images/w3schools_green.jpg"alt="">--}}

{{--            <img src="{{url("documents/".$document->link)}}" alt=""/>--}}
{{--           {{asset('/documents/'.$document->link)}}--}}
{{--            {{public_path() . '\documents\\' . $document->link}}--}}
{{--            <img src="{{Storage::url($document->link)}}" alt="">--}}
        </div>


@endsection
@include('include.form_error')
