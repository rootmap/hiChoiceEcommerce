@extends('layout.master')
@section('title')
View Order Info
@endsection
@section('barcum')
<h1>
    View Order Info
    <small>View Order Detail</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-tags"></i> Order Info</a></li>
    <li><a href="#"><i class="fa fa-tags"></i> Manual Order Info</a></li>
    <li><a href="#" class="active">Create New Manual Order</a></li>
</ol>
@endsection

@include('extra.msg')

@section('content')
<!-- Main content -->
<div class="row" id="printsss">
    <?php //print_r($order); ?>
    <div class="col-md-12">
        <div class="panel panel-invoice rounded">
            <div class="panel-heading">
                <div class="pull-left">
                    <h3 class="no-margin"> <code>Tracking No.#<?= $order[0]->tracking?></code></h3>
                </div>
                <div class="pull-right">
                    <div class="logo-block"><img data-no-retina src="{{url('plugins/def.jpg')}}" alt="Logo"></div>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.panel-heading -->
            <div class="panel-sub-heading">
                <div class="row inner-all">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="text-left mb-10">
                            <h3 class="mt-0">Company information</h3>
                            <strong>FROM</strong>
                            <address>
                                <strong>Djava UI, Inc.</strong><br>
                                Tambak bayan no.13, Babarsari, Sleman<br>
                                Yogyakarta, DIY 94107<br>
                                <abbr title="Phone">P:</abbr> (777) 777-66666
                            </address>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="text-right">
                            <h3 class="mt-0">Client information</h3>
                            <strong>TO</strong>
                            <address>
                                <strong><?= $order[0]->name?></strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            <br/>
                            <p class="text-right"><strong>Invoice Date:</strong> <?= $order[0]->invoice_date?></p>
                            <p class="text-right"><strong>Due Date:</strong> <?= $order[0]->due_date?></p>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel-sub-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                     
                    <table class="table table-striped table-theme">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th style="width: 100px !important;">Qty</th>
                                <th>Unit Price $</th>
                                <th>Tax Rate %</th>
                                <th>Tax</th>
                                <th style="width: 50px !important;">Total Price $</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rowtotal=0;
                            $quantity=0;
                            $vatamount=0;
                            
                            ?>
                            @if(isset($order_item))
                            @foreach($order_item as $item)
                            <tr>
                                <td><?=$item->name?></td>
                                <td><?=$item->quantity?>
                                   @if(!empty($item->unit))
                                   <br>
                                    [<b>Unit : </b> {{$item->unit}} ]
                                   @endif 
                                   @if(!empty($item->color))
                                    <br>
                                    [<b>Color : </b> {{$item->color}} ]
                                   @endif
                                
                                </td>
                                <td><?=$item->unit_price?></td>
                                <td><?=$item->tax_rate?></td>
                                <td><?=$item->tax_amount?></td>
                                <td><?=$item->row_total?></td>
                            </tr>
                            <?php 
                            $rowtotal+=$item->row_total;
                            $quantity+=$item->quantity;
                            $vatamount+=$item->tax_amount;
                            ?>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" rowspan="5" style="margin-top:0px;">
                                    <?php
                                            $paid=0;
                                            $mp=false;
                                            ?>
                                            @if(isset($ot))
                                            @if(count($ot)>0)
                                    <table style="width: 70%;" class="table table-striped">
                                       <tbody>
                                            <tr>
                                                <td>Transaction</td>
                                                <td>Payment Method</td>
                                                <td>Order Amount</td>
                                                <td>Payment Status</td>
                                            </tr>
                                            
                                            @foreach($ot as $tt)
                                            <tr>
                                                <td>TR100<?=$tt->id?></td>
                                                <td><?=$tt->name?></td>
                                                <td><?=$tt->amount?></td>
                                                <td><?=$tt->status?></td>
                                            </tr>
                                            <?php
                                            $paid+=$tt->amount;
                                            ?>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                            @endif
                                            @endif
                                </td>
                                <td colspan="2">Total (Net)</td>
                                <td colspan="2"><?=$rowtotal?></td>
                            </tr>
                            <tr>
                                <td colspan="2">VAT</td>
                                <td colspan="2"><?=$vatamount?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td colspan="2"><b><?php 
                                $total=$rowtotal+$vatamount;
                                echo $total;
                                ?></b></td>
                            </tr>
                            @if(isset($ot))
                            <tr>
                                <td colspan="2"><b>Paid</b></td>
                                <td colspan="2"><b><?=$paid?></b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Due</b></td>
                                <td colspan="2"><b>
                                    
                                        <?php 
                                $due=$total-$paid;
                                if($due>0)
                                {
                                    echo $due;
                                }
                                else
                                {  
                                    $mp=TRUE;
                                    echo 0;
                                }
                                ?>
                                    </b></td>
                            </tr>
                            @endif
                        </tfoot>

                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.panel-body -->
            <div class="panel-footer">
                <div class="pull-left hidden-sm hidden-xs">
                    <button style="margin-right: 20px;" onclick="window.print();" class="btn btn-default pull-right mr-5 rounded"><i class="fa fa-print"></i> Print</button>
                </div>
                <?php if($mp==FALSE){ ?>  
                <div class="pull-right">
                    <a href="{{url('admin-ecom/payment')}}/<?php echo $total; ?>/<?= $order[0]->id?>" class="btn btn-success pull-right rounded"><i class="fa fa-fw fa-arrow-right"></i> Proceed to Payment</a>
                    
                </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div><!-- /.panel-footer -->
        </div><!-- /.panel-invoice -->
    </div>
</div><!-- /.row -->
<!-- /.content -->
@endsection

@section('css')
<link rel="stylesheet" href="{{url('plugins/iCheck/all.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/invoice.css')}}">
<link rel="stylesheet" href="{{url('plugins/default.theme.css')}}">
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#printsss * { visibility: visible; }
#printsss { position: absolute; top: 40px; left: 30px; }

}
</style>
@endsection

@section('js')
<script src="{{url('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{url('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{url('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
@endsection