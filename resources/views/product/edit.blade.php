@extends('layout.master')
@section('title')
Modify Product Info
@endsection
@section('barcum')
<h1>
    Edit Product Info
    <small>Modify Product Info</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{url('admin-ecom')}}"><i class="fa fa-cogs"></i> Product Setting</a></li>
    <li><a href="{{url('admin-ecom/product')}}">Product Info</a></li>
    <li><a href="#" class="active">Modify Product</a></li>
</ol>
@endsection

@include('extra.msg')

@section('content')
<!-- Main content -->
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Edit Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form method="post" role="form" enctype="multipart/form-data" action="{{url('admin-ecom/product-update')}}">
                <div class="box-body">
                    <input type="hidden" name="id" value="<?= $data->id ?>" />
                    <input type="hidden" name="eximage" value="<?= $data->photo ?>" />

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" value="<?= $data->name ?>" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter Name">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Code</label>
                        <input type="text" value="<?= $data->pcode ?>" class="form-control" id="exampleInputEmail1" name="pcode" placeholder="Enter Code">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1"> New Price</label>
                        <input type="text" class="form-control" value="<?= $data->price ?>" id="exampleInputEmail1" name="price" placeholder="Enter New Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Old Price <code>Used to give discount</code></label>
                        <input type="text" value="<?= $data->old_price ?>" class="form-control" id="exampleInputEmail1" name="old_price" placeholder="Enter Old Price">
                    </div>

                    <div class="form-group custom_layout_check">
                        <input type="checkbox" 
                        @if(!empty($data->is_custom_layout))
                                    checked="checked"  
                        @endif 
                            class="minimal" id="custom_layout_check" name="is_custom_layout" value="1"> <label style="margin-left: 5px;" for="exampleInputPassword1"> Is Custom Layout</label>
                    </div>
                    
                    <input type="hidden" name="layout_pr_value"
                    @if(!empty($data->is_custom_layout))
                         value="1" 
                    @else
                         value="0"   
                    @endif 
                    >
                    <div class="form-group is_custom_layout">
                        <label for="exampleInputPassword1">Please Choose a Category Layout</label>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="text-center">
                                    <div class="col-md-12"><b><input 
                                        @if($data->custom_layout==1)
                                            checked="checked" 
                                        @endif
                                        type="radio" value="1" name="custom_layout" id="layout_0" /> Layout One</b></div>
                                    <div class="col-md-12">
                                        <BR>
                                        <img src="{{url('ecom_layout/ByBrand.jpg')}}" />
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="text-center">
                                    <div class="col-md-12"><b><input 
                                        @if($data->custom_layout==2)
                                            checked="checked" 
                                        @endif
                                        type="radio" name="custom_layout" value="2" id="layout_1" /> Layout Two</b></div>
                                    <div class="col-md-12">
                                        <BR>
                                        <img src="{{url('ecom_layout/BySybCategoryOneLayer.jpg')}}" />
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="text-center">
                                    <div class="col-md-12"><b><input 
                                        @if($data->custom_layout==3)
                                            checked="checked" 
                                        @endif
                                        type="radio" name="custom_layout" value="3" id="layout_2" /> Layout Three</b></div>
                                    <div class="col-md-12">
                                        <BR>
                                        <img src="{{url('ecom_layout/SubCategoryTwoLayer.jpg')}}" />
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="text-center">
                                    <div class="col-md-12"><b><input 
                                        @if($data->custom_layout==4)
                                            checked="checked" 
                                        @endif
                                        type="radio" name="custom_layout" value="4" id="layout_3" /> Layout Four</b></div>
                                    <div class="col-md-12">
                                        <BR>
                                        <img src="{{url('ecom_layout/layout_four.jpg')}}" />
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group categoryField">
                        <label for="exampleInputEmail1">Select Category </label>
                        <select class="form-control" id="cid" name="cid">
                            <option value="0">Select Category</option>
                            @if(!empty($cat))
                                @foreach($cat as $ct)
                                    <option 
                                        @if($ct->id==$data->cid)
                                            selected="selected" 
                                        @endif
                                        value="<?= $ct->id ?>"><?= $ct->name ?></option>
                                @endforeach
                            @endif

                        </select>
                    </div>

                    <div class="form-group subcid">
                        <label for="exampleInputEmail1">Select Sub-Category  </label>
                        <select class="form-control" id="subcid" name="scid">
                            <option value="0">Please Select</option>
                            @if(!empty($subcat))
                            @foreach($subcat as $ct)
                            <option 
                                @if($ct->id==$data->scid)
                                    selected="selected" 
                                @endif 
                                value="<?= $ct->id ?>"><?= $ct->name ?></option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="form-group sscid">
                        <label for="exampleInputEmail1">Select Sub-Sub-Category </label>
                        <select class="form-control" name="sscid">
                            <option value="0">Please Select Category</option>
                            @if(!empty($sscat))
                                @foreach($sscat as $ct)
                                <option 
                                    @if($ct->id==$data->sscid)
                                        selected="selected" 
                                    @endif 
                                    value="<?= $ct->id ?>"><?= $ct->name ?></option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                   
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Tag </label>
                        <select id="tid" name="tid[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Tag" style="width: 100%;">
                            @if(!empty($tag))
                            @foreach($tag as $ct)
                            <option 
                                @if(in_array($ct->id,$pt))
                                    selected="selected" 
                                @endif   
                                value="<?= $ct->id ?>"><?= $ct->name ?></option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="form-group bid">
                        <label for="exampleInputEmail1">Select Brand </label>
                        <select class="form-control" id="bid" name="bid">
                            <option value="0">Select Brand</option>
                            @if(!empty($brand))
                            @foreach($brand as $ct)
                            <option 
                            @if($ct->id==$data->bid)
                                selected="selected" 
                            @endif     
                            value="<?= $ct->id ?>"><?= $ct->name ?></option>
                            @endforeach
                            @endif

                        </select>
                    </div>
                    
                    @if(count($child_product)>0)
                    <div class="form-group">
                        <h4 class="page-header">Available Unit</h4>
                        <table class="">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($child_product as $cp)
                                <tr>
                                    <td>
                                        <input type="hidden" name="n_id[]" value="{{$cp->id}}">
                                        <input type="text" name="n_pcode[]" value="{{$cp->pcode}}" class="form-control"></td>
                                    <td><input type="text"  name="n_name[]" value="{{$cp->name}}" class="form-control"></td>
                                    <td><input type="text"  name="n_price[]" value="{{$cp->price}}" class="form-control"></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <input type="hidden" id="isunit" name="isunit" value="{{$data->isunit}}">
                    <input type="hidden" id="unit_type_id" name="unit_type_id" value="{{$data->product_unit_type_id}}">
                    <input type="hidden" id="unit" name="unit" value="{{$data->unit}}">
                    
                    @else
                    
                    <div class="form-group unitcheck">
                        <input type="checkbox" 
                                @if(!empty($data->isunit))
                                    checked="checked"  
                                @endif  
                               class="minimal" id="isunit" name="isunit" value="1"> <label style="margin-left: 5px;" for="exampleInputPassword1"> Is Unit Active</label>
                    </div>

                    <div class="form-group isunit">
                        <label for="exampleInputEmail1">Select Unit Type </label>
                        <select class="form-control" id="unit_type_id" name="unit_type_id">
                            <option value="0">Select Unit Type</option>
                            @if(!empty($unit))
                            @foreach($unit as $ct)
                            <option 
                                @if($ct->id==$data->product_unit_type_id)
                                    selected="selected" 
                                @endif 
                                
                                value="<?= $ct->id ?>"><?= $ct->name ?></option>
                            @endforeach
                            @endif

                        </select>
                    </div>

                    <div class="form-group isunit">
                        <label for="exampleInputEmail1"> Type Available unit</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="{{$data->unit}}" name="unit" placeholder="Type Your Unit With Comma (,) Separated">
                    </div>
                    @endif
                    
                    

                    <div class="form-group colorcheck">

                        <input type="checkbox"  class="minimal" id="iscolor" 
                               @if(!empty($data->iscolor))
                                checked="checked"  
                               @endif 
                               name="iscolor" value="1"> <label style="margin-left: 5px;" for="exampleInputPassword1"> Is Color Available</label>
                    </div>

                    <div class="form-group iscolor">
                        <label for="exampleInputEmail1">Select Colors </label>
                        <select id="color_id" name="color_id[]" class="form-control select2" multiple="multiple" data-placeholder="Select Colors" style="width: 100%;">
                            @if(!empty($color))
                                @foreach($color as $ct)
                                    <option 
                                        @if(in_array($ct->id,$ptc))
                                            selected="selected" 
                                        @endif  
                                        
                                        value="<?= $ct->id ?>"><?= $ct->name ?></option>
                                @endforeach
                            @endif

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Change Brand Image</label>
                        <input type="file" class="form-control" id="brandimage" name="brandimage" placeholder="Enter Name">
                    </div>
                    @if(!empty($data->photo))
                    <div class="form-group">
                        <img height="200" src="{{url('upload/product')}}/<?= $data->photo ?>">
                    </div> 
                    @endif
                    
                    <input type="hidden" id="exbrandimage" name="exbrandimage" value="<?= $data->photo ?>">
                    

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="summernote" name="description" placeholder="Enter Description"><?=$data->description ?></textarea>
                    </div>


                    <div class="form-group">

                        <input type="checkbox"
                               @if(!empty($data->isactive))
                                checked="checked"  
                               @endif
                               class="minimal"  name="isactive" placeholder="Enter Name"> <label style="margin-left: 5px;" for="exampleInputPassword1"> Is Active</label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square"></i> Modify</button> 
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Reset</button>
                    <a class="btn btn-info pull-right" href="{{url('admin-ecom/product')}}"><i class="fa fa-table"></i> Back To List</a>
                </div>
            </form>
        </div>
        <!-- /.box -->

    </div>
    <!--/.col (left) -->
</div>


<!-- /.row -->
<!-- /.content -->
@endsection

@section('css')
<link rel="stylesheet" href="{{url('plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2/select2.min.css')}}">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" />
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<link rel="stylesheet" href="{{url('editor/summernote-master/dist/summernote.css')}}" />
@endsection

@section('js')
<script src="{{url('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{url('plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
        
        @if($bidcatCheck==1)
            $(".bid").fadeOut();
        @endif
        
        @if($subsubcat_active==0)
            $(".sscid").fadeOut();
        @endif

        @if($sidcatCheck==1)
            $(".subcid").fadeOut();    
        @else
            $(".subcid").fadeIn();
        @endif
        
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        @if($data->is_custom_layout==1)
            //$("input[name=custom_layout]").click();

            @if($data->custom_layout==1)
                $("#layout_0").prop("checked");
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeIn();
                $(".sscid").fadeOut();
            @elseif($data->custom_layout==2)
                $("#layout_1").prop("checked");
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeOut();
                $(".sscid").fadeOut();
            @elseif($data->custom_layout==3)
                $("#layout_2").prop("checked");
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeIn();
                $(".sscid").fadeIn();
            @elseif($data->custom_layout==4)
                $("#layout_3").prop("checked");
                $(".categoryField").fadeIn();
                $(".bid").fadeIn();
                $(".subcid").fadeOut();
                $(".sscid").fadeOut();
            @endif

        @endif





        $("input[name=custom_layout]").click(function(){
            var thisID=$(this).attr("id");
            
            if(thisID=="layout_0")
            {
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeIn();
                $(".sscid").fadeOut();
            }
            else if(thisID=="layout_1")
            {
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeOut();
                $(".sscid").fadeOut();
            }
            else if(thisID=="layout_2")
            {
                $(".categoryField").fadeIn();
                $(".subcid").fadeIn();
                $(".bid").fadeIn();
                $(".sscid").fadeIn();
            }
            else if(thisID=="layout_3")
            {
                $(".categoryField").fadeIn();
                $(".bid").fadeIn();
                $(".subcid").fadeOut();
                $(".sscid").fadeOut();
            }
            else
            {
                alert(thisID);
            }
        });

        $(".is_custom_layout").fadeOut();
        @if($data->is_custom_layout==1)
            $(".is_custom_layout").fadeIn();
        @endif
         $(".custom_layout_check .iCheck-helper").click(function () {
            var colorAcLayout = $(this).parent('div').attr('aria-checked');
            //alert(colorAcLayout);        
            if (colorAcLayout == 'true')
            {
                $("input[name=layout_pr_value]").val(1);
                $(".is_custom_layout").fadeIn();
            } 
            else
            {
                $(".is_custom_layout").fadeOut();
                $("input[name=layout_pr_value]").val(0);
            }
        });

        
        $("select[name=scid]").change(function () {
            var category_id = $("select[name=cid]").val();
            var sub_category_id = $(this).val();

            var layout_pr_value=$("input[name=layout_pr_value]").val();
            if(layout_pr_value==0)
            {

                $.post("{{url('admin-ecom/product/filter/extra/category')}}", {'category_id': category_id,'sub_category_id': sub_category_id,'_token':'<?=csrf_token()?>'}, function (data) {
                    if(data==1)
                    {
                        $(".sscid").fadeIn();
                        $.post("{{url('admin-ecom/product/filter/extra/json/category')}}", {'category_id': category_id,'sub_category_id': sub_category_id,'_token':'<?=csrf_token()?>'}, function (data) {
                            var htmlString = '<option value="0">Please Select</option>';
                            $.each(data, function (i, item) {
                                console.log(item.name);
                                htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                            });

                            $("select[name=sscid]").html(htmlString);

                        });
                    }
                    else
                    {
                        $(".sscid").fadeOut();
                    }
                });
            }
            else
            {
                //$(".sscid").fadeIn();
                $.post("{{url('admin-ecom/product/filter/extra/json/category')}}", {'category_id': category_id,'sub_category_id': sub_category_id,'_token':'<?=csrf_token()?>'}, function (data) {
                    var htmlString = '<option value="0">Please Select</option>';
                    $.each(data, function (i, item) {
                        console.log(item.name);
                        htmlString += '<option value="' + item.id + '">' + item.name + '</option>';
                    });

                    $("select[name=sscid]").html(htmlString);

                });
            }
        });
        
        $(".isunit").fadeOut();
        @if(!empty($data->isunit))
           $(".isunit").fadeIn();
        @endif 
        $(".unitcheck .iCheck-helper").click(function(){
            var colorAc=$(this).parent('div').attr('aria-checked');
            //alert(colorAc);        
            if (colorAc == 'true')
            {
                $(".isunit").fadeIn();
            }
            else
            {
                $(".isunit").fadeOut();
            }
        });

        $(".iscolor").fadeOut();
        @if(!empty($data->iscolor))
           $(".iscolor").fadeIn();
        @endif 
        $(".colorcheck .iCheck-helper").click(function(){
            var colorAc=$(this).parent('div').attr('aria-checked');
            //alert(colorAc);        
            if (colorAc == 'true')
            {
                $(".iscolor").fadeIn();
            }
            else
            {
                $(".iscolor").fadeOut();
            }
        });

        
        $("#cid").change(function () {
            var layout_pr_value=$("input[name=layout_pr_value]").val();
            if(layout_pr_value==0)
            {
                $(".sscid").fadeOut();
            }
            var cid = $(this).val();
            if (cid == null || cid == 0)
            {
                var loadingscid = '<option value="0">Please Select Category</option>';
                $("#subcid").html(loadingscid);
            } else
            {
                var loadingscid = '<option value="0">Loading Please Wait...</option>';
                $("#subcid").html(loadingscid);

                $.post("../product-filter-subcat-data", {'cid': cid, '_token': '<?php echo csrf_token(); ?>'}, function (cdata) {
                    //console.log(cdata);
                    var loadingscid = '<option value="0">Please Select Sub Category</option>';

                    $.each(cdata, function (index, val) {
                        //console.log(val);
                        loadingscid += '<option value="' + val.id + '">' + val.name + '</option>';
                    });

                    var getlength = cdata.length;
                    //console.log(getlength);
                    if (getlength == 0)
                    {
                        var loadingscid = '<option value="0">Please Select Another Category</option>';
                        $("#subcid").html(loadingscid);
                    } else
                    {
                        $("#subcid").html(loadingscid);
                    }
//                    if(cdata==null)
//                    {
//                        var loadingscid = '<option value="0">Please Select Category</option>';
//                        $("#subcid").html(loadingscid);
//                    }
//                    else
//                    {
//                        $("#subcid").html(cdata);
//                    }
                });
            }
        });

    });
</script>  


<script type="text/javascript" src="{{url('editor/summernote-master/dist/summernote.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".summernote").summernote({
            height: 300,
            tabsize: 2
        });
    });
</script>
@endsection
