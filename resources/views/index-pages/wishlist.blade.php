@extends('front-layout.master')
@section('content')
<div id="page">


    <div class="columns-container" style="padding-top: 20px;">
        <div id="columns" class="container">
            <div id="slider_row" class="row"></div>
            <div class="row">
                <div class="container" style="padding-top: 20px;">
                    <div class="breadcrumb title_font clearfix"> <a class="home title_font" href="{{url('home')}}" title="Return to Home"><span class="title">Home</span></a> <span class="navigation-pipe"><i class="icon-chevron-right"></i></span> Wishlist</div>
                </div>
                <div id="center_column" class="center_column col-xs-12 col-sm-12 col-md-12">
                    @include('front-include.msg')
                    <div class="row">
         
                            @include('front-include.wishlist')
                      

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@include('front-include.titleseo')
@section('css')
<link rel="stylesheet" href="{{url('site-pub/css/v_9131_c26e9ea48d14b55ad2c9ee04e38f30bd_all.css')}}" type="text/css" media="all" />
@endsection

@section('js')


<script type="text/javascript" src="{{url('site-pub/js/v_4_e7928e80154366e778fbeb3f3e4ac066.js')}}"></script>
<script type="text/javascript" src="{{url('site-pub/js/jquery.elevatezoom.min.js')}}"></script>
@include('front-include.cartadd')
@endsection