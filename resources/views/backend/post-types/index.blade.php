@extends("layouts.adminapp")
@section("title","Post Types")
@section("card-title","Post Types")
@section("create-route",route("post-types.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Attribute Set Id</th>

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
                ajax: "{!! route("post-types.index") !!}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'attribute_set_id', name: 'attribute_set_id'},

                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
