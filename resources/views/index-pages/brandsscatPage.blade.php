@extends('front-layout.master')


@section('content')
<div id="page">
        
        <div class="columns-container">
            <div id="columns" class="container">
                <div id="slider_row" class="row"></div>
                <div class="row" style="padding-top: 15px;">
                    
                    <div id="left_column" class="column col-xs-12 col-sm-12 col-md-3">
                        
                        @include('front-include.categoryfilter')
                         @include('front-include.topseller')
                       
                        
                    </div>
                        @include('front-include.branwSubCat')
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

<script type="text/javascript">
        /* <![CDATA[ */ ;
        var CUSTOMIZE_TEXTFIELD = 1;
        var FIELD_enableCountdownTimer = true;
        var FIELD_mainLayout = 'fullwidth';
        var FIELD_stickyCart = true;
        var FIELD_stickyMenu = true;
        var FIELD_stickySearch = true;
        var FancyboxI18nClose = 'Close';
        var FancyboxI18nNext = 'Next';
        var FancyboxI18nPrev = 'Previous';
        var LANG_RTL = '0';
        var added_to_wishlist = 'The product was successfully added to your wishlist.';
        var ajax_allowed = true;
        var ajaxsearch = true;
        var baseDir = 'index.php';
        var baseUri = 'index.php';
        var blocklayeredSliderName = {
            "price": "price",
            "weight": "weight"
        };
        var comparator_max_item = 3;
        var compare_add_text = 'Add to Compare';
        var compare_remove_text = 'Remove from Compare';
        var comparedProductsIds = [];
        var contentOnly = false;
        var countdownDay = 'Day';
        var countdownDays = 'Days';
        var countdownHour = 'Hour';
        var countdownHours = 'Hours';
        var countdownMinute = 'Min';
        var countdownMinutes = 'Mins';
        var countdownSecond = 'Sec';
        var countdownSeconds = 'Secs';
        var currency = {
            "id": 1,
            "name": "Dollar",
            "iso_code": "USD",
            "iso_code_num": "840",
            "sign": "$",
            "blank": "0",
            "conversion_rate": "1.000000",
            "deleted": "0",
            "format": "1",
            "decimals": "1",
            "active": "1",
            "prefix": "$ ",
            "suffix": "",
            "id_shop_list": null,
            "force_id": false
        };
        var currencyBlank = 0;
        var currencyFormat = 1;
        var currencyRate = 1;
        var currencySign = '$';
        var customizationIdMessage = 'Customization #';
        var delete_txt = 'Delete';
        var displayList = false;
        var fieldbestsellers_autoscroll = false;
        var fieldbestsellers_items = '1';
        var fieldbestsellers_mediumitems = '1';
        var fieldbestsellers_navigation = false;
        var fieldbestsellers_pagination = false;
        var fieldbestsellers_pauseonhover = false;
        var fieldblocksearch_type = 'top';
        var fieldbs_autoscroll = '5000';
        var fieldbs_maxitem = '5';
        var fieldbs_minitem = '2';
        var fieldbs_navigation = false;
        var fieldbs_pagination = false;
        var fieldbs_pauseonhover = false;
        var filters = [{
            "type_lite": "condition",
            "type": "condition",
            "id_key": 0,
            "name": "Condition",
            "values": {
                "new": {
                    "name": "New",
                    "nbr": 6,
                    "link": "",
                    "rel": "nofollow"
                },
                "used": {
                    "name": "Used",
                    "nbr": 7,
                    "link": "#condition-used",
                    "rel": "nofollow"
                },
                "refurbished": {
                    "name": "Refurbished",
                    "nbr": 0,
                    "link": "#condition-refurbished",
                    "rel": "nofollow"
                }
            },
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "manufacturer",
            "type": "manufacturer",
            "id_key": 0,
            "name": "Manufacturer",
            "values": {
                "1": {
                    "name": "Fashion Manufacturer",
                    "nbr": "1",
                    "link": "#manufacturer-fashion_manufacturer",
                    "rel": "nofollow"
                },
                "2": {
                    "name": "Manufacture 1",
                    "nbr": "12",
                    "link": "#manufacturer-manufacture_1",
                    "rel": "nofollow"
                }
            },
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "price",
            "type": "price",
            "id_key": 0,
            "name": "Price",
            "slider": true,
            "max": "53",
            "min": "16",
            "values": {
                "1": "53",
                "0": "16"
            },
            "unit": "$",
            "format": "1",
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "id_attribute_group",
            "type": "id_attribute_group",
            "id_key": 1,
            "name": "Size",
            "is_color_group": false,
            "values": {
                "1": {
                    "color": null,
                    "name": "S",
                    "nbr": 12,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#size-s",
                    "rel": ""
                },
                "2": {
                    "color": null,
                    "name": "M",
                    "nbr": 12,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#size-m",
                    "rel": ""
                },
                "3": {
                    "color": null,
                    "name": "L",
                    "nbr": 12,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#size-l",
                    "rel": ""
                }
            },
            "url_name": "size",
            "meta_title": null,
            "filter_show_limit": "0",
            "filter_type": "0"
        }];
        var freeProductTranslation = 'Free!';
        var freeShippingTranslation = 'Free shipping!';
        var generated_date = 1480748048;
        var hasDeliveryAddress = false;
        var highDPI = false;
        var id_lang = 1;
        var img_dir = 'images/';
        var instantsearch = false;
        var isGuest = 0;
        var isLogged = 0;
        var isMobile = false;
        var langIso = 'en-us';
        var loggin_required = 'You must be logged in to manage your wishlist.';
        var max_item = 'You cannot add more than 3 product(s) to the product Comparison';
        var min_item = 'Please select at least one product';
        var mywishlist_url = '';
        var page_name = 'category';
        var param_product_url = '#';
        var placeholder_blocknewsletter = 'Your e-mail';
        var priceDisplayMethod = 1;
        var priceDisplayPrecision = 2;
        var quickView = true;
        var removingLinkText = 'remove this product from my cart';
        var request = '12-shop';
        var roundMode = 2;
        var search_url = 'search';
        var static_token = 'cf034011c60a29a745742ca00eb50882';
        var toBeDetermined = 'To be determined';
        var token = '1781ddff19ab1fd7c75d1f91a7f58d3f';
        var usingSecureMode = false;
        var wishlistProductsIds = false; /* ]]> */
    </script>
    <script type="text/javascript" src="{{url('site-pub/js/v_4_88b46a65e7da4beebc125a31b0cb58ec.js')}}"></script>
    <script type="text/javascript" src="{{url('site-pub/js/jquery.elevatezoom.min.js')}}"></script>
    <script type="text/javascript">
        
    </script>
       @include('front-include.cartadd')
@endsection