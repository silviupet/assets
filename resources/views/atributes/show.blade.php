@extends('layouts.user_page')
@section('meta_titlu')
    Site de gestionare a activelor proprii
@endsection
@section('meta_descriere')
    Aici gasim toate atributele  unui asset
@endsection
@section('title')
    Atributes
@endsection
@include('include.flash_messages')
@section('content_page')

    <div>
        <h5>Atribute name: {{$atribute->name}}</h5>
    </div>
{{--    <table style="width:100%" class="table">--}}

{{--        <tr>--}}
{{--            <th>ID</th>--}}
{{--            <th>Assets Name</th>--}}
{{--            <th>Created at</th>--}}
{{--            <th>Updated at</th>--}}
{{--            <th>Category</th>--}}
{{--            <th>Edit</th>--}}
{{--            <th>Add an Atribute</th>--}}
{{--        </tr>--}}



{{--        <tr>--}}

{{--            <td>{{$asset->id}}</td>--}}
{{--            <td><a  href="{{route('assets.show', $asset->slug)}}">{{$asset->name}}</td>--}}
{{--            <td>{{$asset->created_at->diffForhumans()}}</td>--}}
{{--            <td>{{$asset->updated_at->diffForhumans()}}</td>--}}
{{--            @if($asset->category_id)--}}
{{--                <td><a  href="{{route('assets.indexbycategory', $asset->category_id)}}">{{$asset->category->name}}</td>--}}
{{--            @else--}}
{{--                <td>{{$asset->category->name ??  "no category"}}</td>--}}
{{--            @endif--}}
{{--            @if(Auth::user()->isAdmin() || Auth::user()->isOwner())--}}
{{--                <td>--}}
{{--                    {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->slug]]) !!}--}}
{{--                    {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}

{{--            @elseif(Auth::user()->isEditor() && ($asset->user_id ===Auth::user()->id))--}}
{{--                <td>--}}
{{--                    {!! Form::open(['method'=>'GET', 'action'=>['AssetsController@edit', $asset->slug]]) !!}--}}
{{--                    {!! Form::submit('Edit Assets', ['class'=>'btn btn-primary']) !!}--}}
{{--                    {!! Form::close() !!}--}}

{{--                </td>--}}
{{--            @endif--}}
{{--            <td>--}}
{{--                {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@createAtributeOfAnAsset', $asset->id]]) !!}--}}
{{--                {!! Form::submit('Add an Atribute', ['class'=>'btn btn-primary']) !!}--}}
{{--                {!! Form::close() !!}--}}

{{--            </td>--}}

{{--        </tr>--}}

{{--    </table>--}}
{{--    <div>--}}
{{--        <!-- button collapse-->--}}

{{--        <p>--}}
{{--            <a class="btn btn-outline-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                Atributes--}}
{{--            </a>--}}
{{--            <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                Documents--}}
{{--            </button>--}}

{{--            <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                Tags--}}
{{--            </button>--}}
{{--        </p>--}}
{{--        <!-- end Button Collapse-->--}}
{{--        <div class="collapse" id="collapseExample">--}}
{{--            <!-- Colapse atributes -->--}}
{{--            <div class="card card-body">--}}
{{--                <h5>Atributes of asset: {{$asset->name}}</h5>--}}
{{--            </div>--}}



                <table style="width: 100%", class="table">
                    <tr>
                        <th>Name</th>
                        {{--                        <th>Belong to asset</th>--}}
                        <th>Description</th>
                        <th>From_date</th>
                        <th>Expire_date</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th>Vendor</th>
                        <th>Other Condition</th>

                        <th>edit</th>

                    </tr>
{{--                    @foreach($atributes as $atribute)--}}

                        <tr>
                            <td>{{$atribute->name}}</td>

                            {{--                            <td><a  href="{{route('assets.show', $atribute->asset->slug?? "salut")}}">{{$atribute->asset->name?? "asset deleted"}}</td>--}}


                            <td>{{$atribute->description}}</td>
                            <td>{{$atribute->from_date}}</td>
                            <td>{{$atribute->expiry_date}}</td>
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



{{--                    @endforeach--}}



                </table>

    <p>

    <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
        Documents
    </button>

    <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
        Tags
    </button>
    </p>

    <!-- Colapse documents-->

    <div class="collapse" id="collapseExample1">
        <div class="card card-body">

                <div>


                    Atribute : {{$atribute->name}}

                    @if(count($atribute->documents)>0)
                        <table style="width: 100%", class="table">
                            <tr>

                                <th>Document Name</th>
                                <th>Upload by</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>



                            @foreach($atribute->documents as $key_document=>$document)

                                <tr>
                                    <td><a href="{{route('documents.show', $document->id)}}">{{$document->name}}</td>
                                    {{--                           <td><a href = "{{asset('/documents/' .$document->link)}}"><img src="{{asset('/documents/' .$document->link)}}" alt=""></td>--}}

                                    <td>{{$document->name}}</td>
                                    {{--                           <td>{{$document->atribute->asset->user->name}}</td>--}}

                                    <td>{{$users->find($document->user_id)->name}}</td>

                                    <!-- Edit button-->

                                    @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDocAdmin{{$key_document}}">
                                                Edit document
                                            </button>
                                            <!-- Modal for edit a document -->
                                            <div class="modal fade" id="editDocAdmin{{$key_document}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">


                                                                {!! Form::model($document, ['method'=>'PATCH', 'action'=> ['DocumentsController@update', $document->id],'files' => true]) !!}



                                                                <div class="form-group">
                                                                    {!!Form::label('document_name', 'Document name: ')!!}
                                                                    {!! Form::text('document_name', $document->name, ['class'=>'form-control']) !!}
                                                                </div>


                                                                <div class="form-group">
                                                                    {!!Form::label('document', 'Document attach here : ')!!}
                                                                    {!! Form::file('document', null , ['class'=>'form-control']) !!}
                                                                </div>

                                                                <div class="form-group">
                                                                    {!! Form::submit('edit a Document', ['class'=>'btn btn-primary']) !!}
                                                                </div>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                   {!! Form::open(['method'=>'GET', 'action'=>['AtributesController@edit', $atribute->id ]]) !!}--}}
                                            {{--                                   {!! Form::submit('Edit Document',[ 'class'=>'btn btn-primary']) !!}--}}
                                            {{--                                   {!! Form::close() !!}--}}
                                        </td>
                                    @elseif(Auth::user()->isEditor() && $document->user_id ==(Auth::user()->id))

                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDocEditor{{$key_document}}">
                                                Edit document
                                            </button>
                                            <!-- Modal for edit a document -->
                                            <div class="modal fade" id="editDocEditor{{$key_document}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            {!! Form::model($document, ['method'=>'PATCH', 'action'=> ['DocumentsController@update', $document->id],'files' => true]) !!}
                                                            {!! Form::token() !!}


                                                            <div class="form-group">
                                                                {!!Form::label('document_name', 'Document name: ')!!}
                                                                {!! Form::text('document_name', $document->name, ['class'=>'form-control']) !!}
                                                            </div>


                                                            <div class="form-group">
                                                                {!!Form::label('document', 'Document attach here : ')!!}
                                                                {!! Form::file('document', null , ['class'=>'form-control']) !!}
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::submit('edit a Document', ['class'=>'btn btn-primary']) !!}
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            {{--                                                   <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                   {!! Form::open(['method'=>'GET', 'action'=>['DocumentsController@edit', $atribute->id]]) !!}--}}
                                            {{--                                   {!! Form::submit('Edit Atribute', ['class'=>'btn btn-primary']) !!}--}}
                                            {{--                                   {!! Form::close() !!}--}}
                                        </td>

                                    @endif

                                <!-- END Edit button-->

                                    <!-- delete button-->
                                    @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                                        <td>
                                            {!! Form::open(['method'=>'DELETE', 'action'=>['DocumentsController@destroy', $document->id],'onsubmit'=>"return confirm('Are you sure you want to delete this item?')" ]) !!}
                                            {!! Form::submit('Delete Document',[ 'class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    @elseif(Auth::user()->isEditor() && $document->user_id ==(Auth::user()->id))

                                        <td>
                                            {!! Form::open(['method'=>'DELETE', 'action'=>['DocumentsController@destroy', $document->id],'onsubmit'=>"return confirm('Are you sure you want to delete this item?')"]) !!}
                                            {!! Form::submit('Delete Document', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>

                                @endif
                                <!-- end delete button-->


                                </tr>



                            @endforeach

                        </table>

                    @else
                        <h5>no documents available</h5>
                @endif

                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addDoc">
                        Add a document
                    </button>
                    <!-- Modal for add a document -->
                    <div class="modal fade" id="addDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    {!! Form::open(['method'=>'POST', 'action'=>['DocumentsController@storeDocumentOfAnAtribute' , $atribute->id] , 'files'=>true]) !!}
                                    {!! Form::token() !!}

                                    <div class="form-group">
                                        {!!Form::label('document_name', 'Document name: ')!!}
                                        {!! Form::text('document_name', null, ['class'=>'form-control']) !!}
                                    </div>


                                    <div class="form-group">
                                        {!!Form::label('document', 'Document attach here : ')!!}
                                        {!! Form::file('document', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Create a Document', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>



        </div>
    </div>


    <!-- Colapse tags-->
    <div class="collapse" id="collapseExample2">
        <div class="card card-body">

            @if(count($tags)>0)
{{--                @foreach ($atributes as $key => $atribute)--}}

                   Tags of  Atribute: {{$atribute->name}}
                    <p>
                        @foreach ($atribute->tags  as $tag)
{{--                            <button type="button" class="btn btn-outline-primary">{{$tag->name}}</button>--}}
                            <a href="{{route('atributes.indexbytag' ,  $tag->id )}}" class="btn btn-outline-primary" role="button" aria-pressed="true">{{$tag->name}}</a>
                        @endforeach


                        <button type="button" class="btn btn-primary"  data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample" >Add a tag</button>
                        <button type="button" class="btn btn-danger"  data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">Delete a tag</button>
                    </p>
                    <!--colapse add a tag-->


                    <div class="collapse" id="collapseExample3">
                        <!--find collection of tags that not belong to an attribute--!>
                        @php



                            $diff = $tags->diff($atribute->tags);

                        @endphp

                        <div class="card card-body">
                            <p>
                                @foreach ($diff as $tag)

{{--                                    <button type="button" class="btn btn-outline-primary">{{$tag->name}}</button>--}}
                                    <a href="{{route('atribute.addTag' , [$atribute->id, $tag->id ])}}" class="btn btn-outline-primary" role="button" aria-pressed="true">{{$tag->name}}</a>

                                @endforeach
                            </p>
                        </div>
                    </div>
                    <!--end colapse add a tag-->



                    <!-- colapse delete a tag-->
                    <div class="collapse" id="collapseExample4">
                        <div class="card card-body">
                            <p>

                                @foreach ($atribute->tags as $tag)
{{--                                    <button type="button" class="btn btn-outline-primary">{{$tag->name}}</button>--}}
                                    <a href="{{route('atribute.deleteTag' , [$atribute->id, $tag->id ])}}" class="btn btn-outline-primary" role="button" aria-pressed="true">{{$tag->name}}</a>

                                @endforeach

                            </p>
                        </div>
                    </div>

                    <!--end colapse delete a tag-->




{{--                @endforeach--}}

            @else

                <h1 class="text-center">No tags available</h1>

    @endif





@endsection
@include('include.form_error')

