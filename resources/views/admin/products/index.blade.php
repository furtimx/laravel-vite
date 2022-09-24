@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Products</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Laravel Ajax CRUD Tutorial Example - ItSolutionStuff.com</h1>
                    <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page_plugins_css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('page_plugins_js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
@stop

@section('adminlte_js')
    <script type="text/javascript">
        $.product_functions = {
            edit: function(_id)
            {
                var url = '{{ route("product.edit", ":id") }}';
                url = url.replace(':id', _id);

                window.location.href = url;
            },
            delete: function(_id)
            {

                var url = '{{ route("product.destroy", ":id") }}';
                _url = url.replace(':id', _id);

                $.ajax({
                    type: "POST",
                    url: _url,
                    dataType: 'json',
                    success: function (res) {
                        var oTable = $('.data-table').dataTable();
                        oTable.fnDraw(false);

                        // $.admin_global.globalAlert("Deleted successfully!", "success");
                    }
                });
            }
        };

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },
                {
                    data: null,
                    render: function ( data, type, row ) {

                        var _html = "";
                            _html += '<a href="javascript:void(0)" onClick="$.product_functions.edit('+row.id+');" class="tooltip-tippy text-secondary">Edit</a>&nbsp;&nbsp;';
                            _html += '<a href="javascript:void(0)" onClick="$.product_functions.delete('+row.id+');" class="tooltip-tippy text-secondary">Delete</a>';
                        return _html;
                    },
                    searchable: false,
                    orderable: false,
                    width: "5%"
                }
            ]
            });
        });
    </script>
@stop
