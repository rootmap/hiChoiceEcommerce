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
                    @if($cat_info->layout==1 || $cat_info->layout==3)
                        @include('front-include.bid')
                    @elseif($cat_info->layout==2)
                        @include('front-include.subcatefrmCat')
                    @elseif($cat_info->layout==4)
                        @include('front-include.Categorybid')    
                    @else
                        
                    @endif
                    
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
            "type_lite": "quantity",
            "type": "quantity",
            "id_key": 0,
            "name": "Availability",
            "values": [{
                "name": "Not available",
                "nbr": 2,
                "link": "",
                "rel": "nofollow"
            }, {
                "name": "In stock",
                "nbr": 11,
                "link": "",
                "rel": "nofollow"
            }],
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
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
        }, {
            "type_lite": "id_attribute_group",
            "type": "id_attribute_group",
            "id_key": 3,
            "name": "Color",
            "is_color_group": false,
            "values": {
                "7": {
                    "color": "#f5f5dc",
                    "name": "Beige",
                    "nbr": 1,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-beige",
                    "rel": ""
                },
                "8": {
                    "color": "#ffffff",
                    "name": "White",
                    "nbr": 3,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-white",
                    "rel": ""
                },
                "11": {
                    "color": "#434A54",
                    "name": "Black",
                    "nbr": 6,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-black",
                    "rel": ""
                },
                "13": {
                    "color": "#F39C11",
                    "name": "Orange",
                    "nbr": 6,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-orange",
                    "rel": ""
                },
                "14": {
                    "color": "#5D9CEC",
                    "name": "Blue",
                    "nbr": 5,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-blue",
                    "rel": ""
                },
                "15": {
                    "color": "#A0D468",
                    "name": "Green",
                    "nbr": 2,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-green",
                    "rel": ""
                },
                "16": {
                    "color": "#F1C40F",
                    "name": "Yellow",
                    "nbr": 7,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-yellow",
                    "rel": ""
                },
                "24": {
                    "color": "#FCCACD",
                    "name": "Pink",
                    "nbr": 1,
                    "url_name": null,
                    "meta_title": null,
                    "link": "#color-pink",
                    "rel": ""
                }
            },
            "url_name": "color",
            "meta_title": null,
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "id_feature",
            "type": "id_feature",
            "id_key": 5,
            "values": {
                "5": {
                    "nbr": 5,
                    "name": "Cotton",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#compositions-cotton",
                    "rel": ""
                },
                "1": {
                    "nbr": 3,
                    "name": "Polyester",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#compositions-polyester",
                    "rel": ""
                },
                "3": {
                    "nbr": 5,
                    "name": "Viscose",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#compositions-viscose",
                    "rel": ""
                }
            },
            "name": "Compositions",
            "url_name": null,
            "meta_title": null,
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "id_feature",
            "type": "id_feature",
            "id_key": 6,
            "values": {
                "11": {
                    "nbr": 7,
                    "name": "Casual",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#styles-casual",
                    "rel": ""
                },
                "16": {
                    "nbr": 1,
                    "name": "Dressy",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#styles-dressy",
                    "rel": ""
                },
                "13": {
                    "nbr": 5,
                    "name": "Girly",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#styles-girly",
                    "rel": ""
                }
            },
            "name": "Styles",
            "url_name": null,
            "meta_title": null,
            "filter_show_limit": "0",
            "filter_type": "0"
        }, {
            "type_lite": "id_feature",
            "type": "id_feature",
            "id_key": 7,
            "values": {
                "18": {
                    "nbr": 2,
                    "name": "Colorful Dress",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#properties-colorful_dress",
                    "rel": ""
                },
                "21": {
                    "nbr": 4,
                    "name": "Maxi Dress",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#properties-maxi_dress",
                    "rel": ""
                },
                "20": {
                    "nbr": 2,
                    "name": "Midi Dress",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#properties-midi_dress",
                    "rel": ""
                },
                "19": {
                    "nbr": 2,
                    "name": "Short Dress",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#properties-short_dress",
                    "rel": ""
                },
                "17": {
                    "nbr": 3,
                    "name": "Short Sleeve",
                    "url_name": null,
                    "meta_title": null,
                    "link": "#properties-short_sleeve",
                    "rel": ""
                }
            },
            "name": "Properties",
            "url_name": null,
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
    @include('front-include.cartadd')
    <script type="text/javascript">
        /* <![CDATA[ */ ;
        var zoom_type = 'window';
        var zoom_fade_in = 400;
        var zoom_fade_out = 550;
        var zoom_cursor_type = 'default';
        var zoom_window_pos = 1;
        var zoom_scroll = true;
        var zoom_easing = true;
        var zoom_tint = true;
        var zoom_tint_color = '#333';
        var zoom_tint_opacity = 0.4;
        var zoom_lens_shape = 'round';
        var zoom_lens_size = 420;;

        function applyElevateZoom() {
            var src = $('.thickbox.shown').attr('href');
            var bigimage = $('.fancybox.shown').attr('href');
            $('#bigpic').elevateZoom({
                zoomType: zoom_type,
                cursor: zoom_cursor_type,
                zoomWindowFadeIn: zoom_fade_in,
                zoomWindowFadeOut: zoom_fade_out,
                zoomWindowPosition: zoom_window_pos,
                scrollZoom: zoom_scroll,
                easing: zoom_easing,
                tint: zoom_tint,
                tintColour: zoom_tint_color,
                tintOpacity: zoom_tint_opacity,
                lensShape: zoom_lens_shape,
                lensSize: zoom_lens_size,
                zoomImage: bigimage,
                borderSize: 1,
                borderColour: '#d4d4d4',
                zoomWindowWidth: 535,
                zoomWindowHeight: 535,
                zoomLevel: 0.5,
                lensBorderSize: 0
            });
        }
        $(document).ready(function() {
            applyElevateZoom();
            $('#color_to_pick_list').click(function() {
                restartElevateZoom();
            });
            $('#color_to_pick_list').hover(function() {
                restartElevateZoom();
            });
            $('#views_block li a').hover(function() {
                restartElevateZoom();
            });
        });

        function restartElevateZoom() {
            $(".zoomContainer").remove();
            applyElevateZoom();
        };;
        var input = $("#search_query_top");
        $('document').ready(function() {
            var width_ac_results = input.outerWidth();
            Input_focus()
            $("#search_query_top").autocomplete('search', {
                minChars: 3,
                max: 10,
                width: (width_ac_results > 0 ? width_ac_results : 500),
                selectFirst: false,
                scroll: true,
                dataType: "json",
                formatItem: function(data, i, max, value, term) {
                    return value;
                },
                parse: function(data) {
                    var mytab = new Array();
                    for (var i = 0; i < data.length; i++)
                        mytab[mytab.length] = {
                            data: data[i],
                            value: '<img alt="' + data[i].pname + '" src="' + data[i].image + '"><div class="right-search"><h5>' + data[i].pname + '</h5><span class="price">' + data[i].dprice + '</span></div> '
                        };
                    return mytab;
                },
                extraParams: {
                    ajaxSearch: 1,
                    id_lang: 1,
                    category_filter: $("#category_filter").val()
                }
            }).result(function(event, data, formatted) {
                $('#search_query_top').val(data.pname);
                document.location.href = data.product_link;
            });
            $("#category_filter").change(function() {
                $(".ac_results").remove();
                $("#search_query_top").trigger('unautocomplete');
                Input_focus()
                $("#search_query_top").autocomplete('search', {
                    minChars: 3,
                    max: 10,
                    width: (width_ac_results > 0 ? width_ac_results : 500),
                    selectFirst: false,
                    scroll: true,
                    dataType: "json",
                    formatItem: function(data, i, max, value, term) {
                        return value;
                    },
                    parse: function(data) {
                        var mytab = new Array();
                        for (var i = 0; i < data.length; i++)
                            mytab[mytab.length] = {
                                data: data[i],
                                value: '<img alt="' + data[i].pname + '" src="' + data[i].image + '"><div class="right-search"><h5>' + data[i].pname + '</h5><span class="price">' + data[i].dprice + '</span></div> '
                            };
                        return mytab;
                    },
                    extraParams: {
                        ajaxSearch: 1,
                        id_lang: 1,
                        category_filter: $("#category_filter").val()
                    }
                }).result(function(event, data, formatted) {
                    $('#search_query_top').val(data.pname);
                    document.location.href = data.product_link;
                });
            });
        });

        function Input_focus() {
            $('#search_query_top').on('focus', function() {
                var width_ac_results = input.outerWidth();
                var $this = $(this);
                if ($this.val() == 'Enter your keyword ...') {
                    $this.val('');
                    $('.btn.button-search').addClass('active');
                }
            }).on('blur', function() {
                var $this = $(this);
                if ($this.val() == '') {
                    $this.val('Enter your keyword ...');
                    $('.btn.button-search').removeClass('active');
                }
            });
        }; /* ]]> */
    </script>
       
@endsection