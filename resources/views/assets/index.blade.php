

@extends('layouts.admin_layout')
@section('title')
    Assets
@endsection

@section('content_page')
    @if('assets')

        <table style="width:100%">
            <tr>
                <th>ID</th>
                <th>Assets Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>User Id</th>
            </tr>
            <tr>
                @foreach($assets as $asset)
                    <td>{{$asset->id}}</td>
                    <td>{{$asset->name}}</td>
                    <td>{{$asset->created_at}}</td>
                    <td>{{$asset->updated_at}}</td>
                    <td>{{$asset->user_id}}</td>
                @endforeach
            </tr>

        </table>

    @elseif("no assets available")

    @endif
@endsection


