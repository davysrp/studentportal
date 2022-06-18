@extends('layouts.adminapp')
@section('title',"Role")
@section('card-title',"Role")
@section('create-route',route('rules.create'))
@section('table')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Rule Name</th>
            <th>Rule Slug</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
@endsection

@section('datatable')
    <script>
        $(document).ready(function () {
            $('table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('rules.index') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
