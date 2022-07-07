@extends("layouts.adminapp")
@section("title","Labels")
@section("card-title","Labels")
@section("create-route",route("labels.create"))
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
                ajax: "{!! route("labels.index") !!}" ,
                columns: [
                    {data: 'name', name: 'name'},

                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection