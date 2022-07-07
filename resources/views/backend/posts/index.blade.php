@extends("layouts.adminapp")
@section("title",$postType->name)
@section("card-title",$postType->name)
@section("create-route",route("posts.create",['setId'=>$postType->attribute_set_id,'type'=>$postType->slug]))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Thumbnail</th>
            <th>Status</th>
            <th>Description</th>
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
                ajax: "{!! route("posts.index") !!}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'thumbnail', name: 'thumbnail'},
                    {data: 'status', name: 'status'},
                    {data: 'description', name: 'description'},
                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection
