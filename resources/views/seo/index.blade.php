@extends('layout.master')
@section('title')
SEO Info
@endsection
@section('barcum')
<h1>
    SEO Info
    <small>SET Website SEO Details</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#" class="active"><i class="fa fa-cogs"></i> SEO Setting</a></li>
</ol>
@endsection

@include('extra.msg')

@section('content')
<!-- Main content -->
<div class="row">
    <!-- left column -->
    <div class="col-md-12">

        @if(isset($data))
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-plus"></i> Update SEO Settings Here</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form  enctype="multipart/form-data"  method="post" role="form" action="{{url('admin-ecom/seo-update')}}">
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $data[0]->id ?>" />
                            <label for="exampleInputEmail1">Website Name / Title</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?= $data[0]->name ?>" placeholder="Enter Name / Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Enter Name">
                        </div>
                        <input type="hidden" name="exlogo" value="<?= $data[0]->site_logo ?>">
                        
                        <div class="form-group">
                            <img height="100" src="{{url('upload/logo')}}/<?= $data[0]->site_logo ?>">
                        </div> 

                        <div class="form-group">
                            <label for="exampleInputEmail1">Website Meta Data</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="meta" value="<?= $data[0]->meta ?>" placeholder="Enter Meta by separated with comma (,)">
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Description"><?= $data[0]->description ?></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square"></i> Modify</button> 
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Reset</button>
                    </div>
                </form>
            </div>
            @else
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-plus"></i> Fillup SEO Settings Here</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form  enctype="multipart/form-data"  method="post" role="form" action="{{url('admin-ecom/seo-add')}}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Website Name / Title</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter Name / Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Enter Name">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Website Meta Data</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="meta" placeholder="Enter Meta by separated with comma (,)">
                        </div>


                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create</button> 
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Reset</button>
                    </div>
                </form>
            </div>
            @endif
        <!-- general form elements -->







        <!-- /.box -->

    </div>
    <!--/.col (left) -->
</div>


<!-- /.row -->
<!-- /.content -->
@endsection


