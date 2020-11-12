@extends('layouts.user_page')
@section('meta_titlu')
    Atributele unui activ
@endsection
@section('meta_descriere')
    Aici gasim atributele, caracteristicile, la toate activele asseturi ca de exemplu factura, asigurare, inchiriere, garantie, etc
@endsection
@section('title')
    Assets Attributes
@endsection
@include('include.flash_messages')
@section('content_page')
    @if(count($atributes)==0)
       <table style="width: 100%", class="table">
            <tr>
                <th>Name</th>
                <th>Belong to asset</th>
                <th>Description</th>
                <th>From_date</th>
                <th>Expire_date</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Vendor</th>
                <th>Other Condition</th>
                <th>Tag name</th>
                <th>edit</th>

            </tr>
            @foreach($atributes as $atribute)
               <tr>
                   <td>{{$atribute->name}}</td>
                   <td><a  href="{{route('assets.show', $atribute->asset->slug)}}">{{$asset->name}}</td>
                   <td>{{$atribute->description}}</td>
                   <td>{{$atribute->from_date}}</td>
                   <td>{{$atribute->expiry_date}}</td>
                   <td>{{$atribute->price}}</td>
                   <td>{{$atribute->currency}}</td>
                   <td>{{$atribute->vendor}}</td>
                   <td>{{$atribute->other_conditions}}</td>
                   @if(Auth::user()->isAdmin || Auth::user()->isOwner())
                    <td>
                        {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@edit', $atribute->id ]]) !!}
                        {!! Form::submit('Edit Atribute',[ 'class'=>'btn, btn-primary']) !!}
                        {!! Form::close() !!}
                    </td>
                   @elseif(Auth::user()->isEditor() && $atribute->user_id ==(Auth::user()->id))

                           <td>
                               {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@edit', $atribute->id]]) !!}
                               {!! Form::submit('Edit Atribute', ['class'=>'btn, btn-primary']) !!}
                               {!! Form::close() !!}
                           </td>

                   @endif

               </tr>




           @endforeach



       </table>




    @else

        <h1 class="text-center">No attributes available</h1>

    @endif
@endsection
@include('include.form_error')