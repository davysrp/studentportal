@extends("layouts.adminapp")
@section("title","Attribute Sets")
@section("card-title","Attribute Sets")
@section("create-route",route("attribute-sets.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
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
                ajax: "{!! route("attribute-sets.index") !!}" ,
                columns: [
                    {data: 'name', name: 'name'},
                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
