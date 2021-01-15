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
    @if(count($atributes)>0)

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

                <th>edit</th>

            </tr>
            @foreach($atributes as $atribute)
{{--            @if($atribute->asset)--}}
               <tr>
                   <td><a href="{{route('atributes.show', $atribute->id)}}">{{$atribute->name}}</td>

                  <td><a  href="{{route('assets.show', $atribute->asset->slug?? "salut")}}">{{$atribute->asset->name?? "asset deleted"}}</td>


                   <td>{{$atribute->description}}</td>
{{--                   {{var_dump($atribute->from_date)}}--}}
                   <td>{{\Carbon\carbon::parse($atribute->from_date)->format('d-m-Y')}}</td>
                   <td>{{\Carbon\carbon::parse($atribute->expiry_date)->format('d-m-Y')}}</td>
                   <td>{{$atribute->price}}</td>
                   <td>{{$atribute->currency}}</td>
                   <td>{{$atribute->vendor}}</td>
                   <td>{{$atribute->other_conditions}}</td>

                   @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                    <td>
                        {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@edit', $atribute->id ]]) !!}
                        {!! Form::submit('Edit Atribute',[ 'class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </td>
                   @elseif(Auth::user()->isEditor() && $atribute->user_id ==(Auth::user()->id))

                           <td>
                               {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@edit', $atribute->id]]) !!}
                               {!! Form::submit('Edit Atribute', ['class'=>'btn btn-primary']) !!}
                               {!! Form::close() !!}
                           </td>

                   @endif

               </tr>


{{--            @endif--}}

           @endforeach



       </table>

{{$atributes->links()}}


    @else

        <h1 class="text-center">No attributes available</h1>

    @endif
@endsection
@include('include.form_error')
