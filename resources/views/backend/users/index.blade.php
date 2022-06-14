@extends('layouts.adminapp')
@section('title',"Admin")
@section('card-title',"Administration")
@section('create-route',route('admins.create'))
@section('table')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Rule</th>
            <th>Status</th>
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
                ajax: '{!! route('admins.index') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'firstname', name: 'firstname'},
                    {data: 'lastname', name: 'lastname'},
                    {data: 'gender', name: 'gender'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'rule', name: 'rule'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
