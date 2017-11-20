<?php

namespace App\Http\Controllers;

use App\Seo;
use App\category;
use App\SubCategory;
use App\Brand;
use App\Product;
use App\Cart;
use App\CustomerSupport;
use App\ContactDetail;
use App\Language;
use App\Currency;
use App\User;
use Session;
use Illuminate\Http\Request;

class searchController extends Controller {

    public function locateSearch(Request $request) {
        if (!empty($request->category_filter) && !empty($request->search_query)) {
            return redirect(url('search/' . $request->category_filter . '/' . $request->search_query));
        } elseif (empty($request->category_filter) && !empty($request->search_query)) {
            return redirect(url('search/0/' . $request->search_query));
        } elseif (!empty($request->category_filter) && empty($request->search_query)) {
            return redirect(url('search/' . $request->category_filter . '/'));
        } else {
            return redirect(url('search/0/'));
        }
    }

    public function searchProduct($catpage = 0, $search = '', $limit = 9, $curpage = 1,$orderby="price:desc",$param1='',$param2='',$param3='',$param4='',$param5='',$param6='') {
        $language = Language::all();
        $currency = Currency::all();
        $cs = CustomerSupport::all();
        $cde = ContactDetail::all();
        $cat = category::take(2)->get();
        $cats = category::all();
        $brn = Brand::all();
        $seo = Seo::all();
        $product = Product::all();
        
        $product_info = Product::where('name', 'LIKE', '%' . $search . '%')->get();
        $orderarray= explode(":",$orderby);
        //print_r($orderarray);
        //exit();
        $genskip=(($curpage-1)*$limit);
        $product_infoget = Product::where('name', 'LIKE', '%' . $search . '%')
                                ->orderBy($orderarray[0],$orderarray[1])
                                ->take($limit)
                                ->skip($genskip)
                                ->get();
        
        $totalpro =count($product_info);
        
        $pagedeviner=floor($totalpro/$limit);
        $genfric=$pagedeviner*$limit;
        $fric=$totalpro-$genfric;
        if(!empty($fric))
        {
            $pagedeviner+=1;
        }
        else
        {
            $pagedeviner=1;
        }
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        
        //echo floor($pagedeviner);
        //exit();

        $urlst = "search/" . $catpage . "/" . $search;
        return view('index-pages.search-result', [
            'language' => $language,
            'currency' => $currency,
            'cussup' => $cs,
            'csudet' => $cde,
            'seo' => $seo,
            'brn' => $brn,
            'brand' => '',
            'cat' => $cat,
            'cats' => $cats,
            'product' => $product,
            'product_info' => $product_info,
            'product_info_fetch' => $product_infoget,
            'urlst' => $urlst,
            'pagination' => $pagedeviner,
            'curpage' =>$curpage,
            'limit' =>$limit,
            'ord'=>$orderarray,
            'products' => $cart->items,
            'totalQty' => $cart->totalQty,
            'totalPrice' => $cart->totalPrice
            
        ]);
    }

}
