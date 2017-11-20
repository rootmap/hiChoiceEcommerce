@extends('layout.master')
@section('title')
Products Info
@endsection
@section('barcum')
<h1>
    <i class="fa fa-tag"></i> Products Info
    <small>All Product List</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-tags"></i> Product Info</a></li>
    <li><a href="#" class="active">Product List</a></li>
</ol>
@endsection

@include('extra.msg')

@section('content')
<!-- Main content -->
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-table"></i> Product List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">                
                    <div id="grid"></div>

                </div>
                <!-- /.box-body -->
            </form>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col (left) -->
</div>
<!-- /.row -->
<!-- /.content -->
@endsection



@section('js')
@include('extra.kendo')


<script id="edit_client" type="text/x-kendo-template">
    <a class="k-button k-button-icontext k-grid-delete" href="{{url('admin-ecom/product')}}/#= id #"><span class="k-icon k-edit"></span>Edit</a> 
    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
</script>  
<script type="text/javascript">
    function deleteClick(id) {
        var c = confirm("Do you want to delete?");
        if (c === true) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "product-delete/" + id,
                success: function (result) {
                    $(".k-i-refresh").click();
                }
            });
        }
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {



        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: "product-data",
                    type: "GET",
                    datatype: "JSON"

                }
            },
            autoSync: false,
            schema: {
                data: "data",
                total: "data.length",
                model: {
                    id: "id",
                    fields: {
                        id: {nullable: true},
                        pcode: {type: "string"},
                        name: {type: "string"},
                        price: {type: "string"},
                        photo: {type: "string"},
                        cname: {type: "string"},
                        scname: {type: "string"},
                        bname: {type: "string"},
                        isactive: {type: "string"},
                        created_at: {type: "string"},
                        updated_at: {type: "string"}

                    }
                }
            },
            pageSize: 10,
            serverPaging: false,
            serverFiltering: false,
            serverSorting: false
        });
        $("#grid").kendoGrid({
            dataSource: dataSource,
            filterable: true,
            pageable: {
                refresh: true,
                input: true,
                numeric: false,
                pageSizes: true,
                pageSizes: [10, 20, 50, 100, 200, 400]
            },
            sortable: true,
            groupable: true,
            columns: [
                {field: "id", title: "BID", width: "80px"},
                {field: "pcode", title: "Code"},
                {field: "name", title: "Name"},
                {template: "<img width='100' src='<?= url('upload/product') ?>/#=photo#'>", title: "Image"},
                {field: "price", title: "Price"},
                {field: "cname", title: "Category"},
                {field: "scname", title: "Sub-Category"},
                {field: "bname", title: "Brand"},
                {field: "isactive", title: "Is Active"},
                //{template: kendo.toString("#=created_at#", "dd/MM/yyyy"), title: "Created", width: "150px"},
                {
                    title: "Action", width: "170px",
                    template: kendo.template($("#edit_client").html())
                }
            ],
        });
    });

</script>

@endsection