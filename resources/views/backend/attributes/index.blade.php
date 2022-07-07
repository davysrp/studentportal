@extends("layouts.adminapp")
@section("title","Attributes")
@section("card-title","Attributes")
@section("create-route",route("attributes.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Type</th>
            <th>Name</th>
            <th>Is Required</th>
            <th>Action</th>

        </tr>
        </thead>
    </table>
@endsection
@section("datatable")
    <script>
        $(document).ready(function () {
            $("table").dataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route("attributes.index") !!}",
                columns: [
                    {data: 'type', name: 'type'},
                    {data: 'name', name: 'name'},
                    {data: 'is_required', name: 'is_required'},

                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
