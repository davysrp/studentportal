@extends('layouts.adminapp')
@section('title',"Rule")
@section('card-title',"Permission")
@section('create-route',route('permissions.create'))
@section('table')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Permission Name</th>
            <th>Slug</th>
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
                ajax: '{!! route('permissions.index') !!}',
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
