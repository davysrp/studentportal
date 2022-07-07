@extends("layouts.adminapp")
@section("title","Languages")
@section("card-title","Languages")
@section("create-route",route("languages.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
<th>Code</th>

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
                ajax: "{!! route("languages.index") !!}" ,
                columns: [
                    {data: 'name', name: 'name'},
{data: 'code', name: 'code'},

                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection