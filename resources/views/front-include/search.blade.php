<div id="center_column" class="center_column col-xs-12 col-sm-12 col-md-9">
    
    <h1 class="page-heading title_font"><span class="cat-name">Search Result &nbsp;</span><span class="heading-counter">There are <?=count($product_info)?> products.</span></h1>
    <div class="content_sortPagiBar container clearfix">
        <div class="top-pagination-content sortPagiBar clearfix">
            <script type="text/javascript">
                function showOrderBy(ord)
                {
                    window.location.href="<?=url($urlst)?>/<?=$limit?>/1/"+ord;
                }

                function showLimit(limit)
                {
                    window.location.href="<?=url($urlst)?>/"+limit+"/1";
                }
            </script>
            <ul class="display hidden-xs">
                <li class="display-title">View as:</li>
                <li id="grid"><a rel="nofollow" href="#" title="Grid"><i class="icon-th-large"></i></a></li>
                <li id="list"><a rel="nofollow" href="#" title="List"><i class="icon-th-list"></i></a></li>
            </ul>
            <form id="productsSortForm" action="12-shop" class="productsSortForm">
                <div class="select selector1">
                    <label for="selectProductSort">Sort by</label>
                    
                    <select onchange="showOrderBy(this.value)" id="selectProductSort" class="selectProductSort form-control">
                        <option 
                            @if($ord=="name:asc")
                                selected="selected" 
                            @endif
                            value="name:asc" selected="selected">Position</option>
                        <option 
                            @if($ord=="price:asc")
                                selected="selected" 
                            @endif
                            value="price:asc">Price: Lowest first</option>
                        <option 
                            @if($ord=="price:desc")
                                selected="selected" 
                            @endif
                            value="price:desc">Price: Highest first</option>
                        <option 
                            @if($ord=="name:asc")
                                selected="selected" 
                            @endif
                            value="name:asc">Product Name: A to Z</option>
                        <option 
                            @if($ord=="name:desc")
                                selected="selected" 
                            @endif
                            value="name:desc">Product Name: Z to A</option>
                    </select>
                </div>
            </form>
            <form action="12-shop" method="get" class="nbrItemPage">
                <div class="clearfix selector1">
                    <label for="nb_item"> Show </label>
                    <input type="hidden" name="id_category" value="12" />
                        
                    <select onchange="showLimit(this.value)" name="n" id="nb_item" class="form-control">
                        @for($i=9; $i<=18; $i+=9)
                        <option 
                            @if($i==$limit)
                                selected="selected" 
                            @endif
                             value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select> 
                    
                    <span>per page</span></div>
            </form>
            <div id="pagination" class="pagination clearfix"> 
                <span class="ft_page"> Page: </span>
                <ul class="pagination">
                    <li id="pagination_previous" class="disabled pagination_previous"> <span> <i class="icon-chevron-left"></i> </span></li>
                    @for($i=1; $i<=$pagination; $i++)
                        @if($i==$curpage)
                            <li class="active current">
                                <span> <span>{{$i}}</span> </span>
                            </li>
                        @else
                            <li>
                                <a href="<?=url($urlst)?>/{{$limit}}/{{$i}}"> <span>{{$i}}</span> </a>
                            </li>
                        @endif
                    
                    @endfor
                    <li id="pagination_next" class="pagination_next">
                        <a href="" rel="next"> <i class="icon-chevron-right"></i> </a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
    @if(!isset($product_info_fetch))
    <div class=" hide-color-options hide-stock-info">
        <h3>No Product Found</h3>
    </div>
    @endif
    <div class=" hide-color-options hide-stock-info">
        <ul class="product_list grid row">

            @if(isset($product_info_fetch))
            @foreach($product_info_fetch as $pro)
            <li class="ajax_block_product col-xs-12 col-sm-6 col-lg-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line">
                <div class="product-container" itemscope itemtype="">
                    <div class="item-inner">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link product_img" href="{{url('product')}}/{{$pro->id}}/{{$pro->name}}" title="{{$pro->name}}" itemprop="url"> 
                                    <span class="hover-image"><img class="replace-2x" src="{{url('upload/product')}}/{{$pro->photo}}" alt="{{$pro->name}}" title="{{$pro->name}}" height="344" width="270"/></span> 
                                    <span class="img_root"> <img src="{{url('upload/product')}}/{{$pro->photo}}" height="344" width="270" alt="{{$pro->name}}" /> </span> 
                                </a>
                            </div>
                            <div class="conditions-box"></div>
                            <div class="product-flags"></div>
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name"> 
                                <a class="product-name" href="{{url('product')}}/{{$pro->id}}/{{$pro->name}}" title="{{$pro->name}}" itemprop="url"  style="overflow: hidden; line-height: 40px; height: 40px;"> {{$pro->name}} </a></h5>
                            <p class="product-desc" itemprop="description">{{$pro->description}}</p>
                            <p class="learn-more" itemprop="url"> <a href="" title="See more in the product page">Learn more...</a></p>
                            <div class="price-rating">

                                <div class="content_price" itemprop="offers" itemscope itemtype=""> 
                                    <span itemprop="price" class="price product-price"> ${{$pro->price}} </span>
                                    <meta itemprop="priceCurrency" content="USD" /> 
<!--                                                        <span class="old-price product-price"> $20.50 </span> 
                                    <span class="price-percent-reduction">-20%</span> 
                                    <span class="unvisible">
                                        <link itemprop="availability" href="https://schema.org/OutOfStock" />
                                        Out of stock 
                                    </span>-->
                                </div>

                                <div class="hook-reviews">
                                    <div class="comments_note" itemtype="" itemscope="">
                                        <div class="star_content clearfix" itemtype="" itemscope="" itemprop="aggregateRating">
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star"></div>
                                            <meta itemprop="worstRating" content="0" />
                                            <meta itemprop="ratingValue" content="4" />
                                            <meta itemprop="bestRating" content="5" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="color-list-container"></div> <span class="availability"> <span class=" label-success"> In stock </span> </span>
                            <div class="button-container">
                                <div class="tab_button">
                                    <!-- <a class=" title_font" href="{{url('product/$pro->id/$pro->name')}}" rel=""> 
                                        <span><i class="icon-eye"></i></span> 
                                    </a> 
                                    <a class="add_to_compare title_font" href="" data-id-product="1" data-tooltip="Add to Compare" data-product-cover="images/h3.jpg" data-product-name="Demo text">
                                        <span><i class="icon-plus"></i></span>
                                    </a>
                                    <a class="addToWishlist title_font wishlistProd_1" href="#" data-tooltip="Add to Wishlist" rel="nofollow" onclick="WishlistCart('wishlist_block_list', 'add', '1', false, 1); return false;"> 
                                        <span><i class="icon-heart"></i></span> 
                                    </a> -->
                                    <a class="title_font" href="{{url('product')}}/{{$pro->id}}/{{$pro->name}}" rel="" title="Quick view"> <span><i class="icon-eye"></i></span> </a>
                                        <a class="addToWishlist title_font wishlistProd_1" href="{{url('product-wishlist')}}/{{$pro->id}}/{{$pro->name}}" data-tooltip="Add to Wishlist" rel="nofollow" onclick="WishlistCart('wishlist_block_list', 'add', '{{$pro->id}}', false, 1);
                                                return false;"> <span><i class="icon-heart"></i></span> </a>
                                    <a class="title_font button_cart button ajax_add_to_cart_button btn btn-default" href="{{ route('product.addToCart',['id'=>$pro->id,'reur'=>base64_encode($urlst)]) }}" rel="nofollow" title="Add to cart" data-id-product="1" data-minimal_quantity="1"> 
                                        <i class="icon-shopping-cart"></i> 
                                        <span>Add to cart</span> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            @else
            <li>
                <div class="col-md-12">
                    <h3>No Product Found</h3>
                </div>

            </li>
            @endif

        </ul>
    </div>
    <div class="content_sortPagiBar block">
        <div class="bottom-pagination-content sortPagiBar clearfix">
            
            <ul class="display hidden-xs">
                <li class="display-title">View as:</li>
                <li id="grid"><a rel="nofollow" href="#" title="Grid"><i class="icon-th-large"></i></a></li>
                <li id="list"><a rel="nofollow" href="#" title="List"><i class="icon-th-list"></i></a></li>
            </ul>
            <form id="productsSortForm" action="12-shop" class="productsSortForm">
                <div class="select selector1">
                    <label for="selectProductSort">Sort by</label>
                    
                    <select onchange="showOrderBy(this.value)" id="selectProductSort" class="selectProductSort form-control">
                        <option 
                            @if($ord=="name:asc")
                                selected="selected" 
                            @endif
                            value="name:asc" selected="selected">Position</option>
                        <option 
                            @if($ord=="price:asc")
                                selected="selected" 
                            @endif
                            value="price:asc">Price: Lowest first</option>
                        <option 
                            @if($ord=="price:desc")
                                selected="selected" 
                            @endif
                            value="price:desc">Price: Highest first</option>
                        <option 
                            @if($ord=="name:asc")
                                selected="selected" 
                            @endif
                            value="name:asc">Product Name: A to Z</option>
                        <option 
                            @if($ord=="name:desc")
                                selected="selected" 
                            @endif
                            value="name:desc">Product Name: Z to A</option>
                    </select>
                </div>
            </form>
            <form action="12-shop" method="get" class="nbrItemPage">
                <div class="clearfix selector1">
                    <label for="nb_item"> Show </label>
                    <input type="hidden" name="id_category" value="12" />
                        
                    <select onchange="showLimit(this.value)" name="n" id="nb_item" class="form-control">
                        @for($i=9; $i<=18; $i+=9)
                        <option 
                            @if($i==$limit)
                                selected="selected" 
                            @endif
                             value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select> 
                    
                    <span>per page</span></div>
            </form>
            <div id="pagination" class="pagination clearfix"> 
                <span class="ft_page"> Page: </span>
                <ul class="pagination">
                    <li id="pagination_previous" class="disabled pagination_previous"> <span> <i class="icon-chevron-left"></i> </span></li>
                    @for($i=1; $i<=$pagination; $i++)
                        @if($i==$curpage)
                            <li class="active current">
                                <span> <span>{{$i}}</span> </span>
                            </li>
                        @else
                            <li>
                                <a href="<?=url($urlst)?>/{{$limit}}/{{$i}}"> <span>{{$i}}</span> </a>
                            </li>
                        @endif
                    
                    @endfor
                    <li id="pagination_next" class="pagination_next">
                        <a href="" rel="next"> <i class="icon-chevron-right"></i> </a>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</div>

