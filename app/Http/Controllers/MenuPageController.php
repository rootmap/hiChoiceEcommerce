<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use App\Product;
use Session;
use App\Cart;

use Illuminate\Http\Request;
use App\Seo;
use App\QRCode;
use App\category;
use App\SubCategory;
use App\Brand;
use App\Slider;
use App\CustomerSupport;
use App\ContactDetail;
use App\Language;
use App\Currency;
use App\ProductReview;
use App\Shipping;
use App\Orders;
use App\OrdersItem;
use App\DeliveryAddress;
use App\PaymentMethod;
use App\ProductViewByIP;
//MenuPageController::loggedUser('company_prefix')

class MenuPageController extends Facade {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected static function getFacadeAccessor() {
        //what you want
        return $this;
    }

    public static function recentProduct() {
        $countProduct = Product::count();
        if ($countProduct != 0) {
            $sqlProduct = Product::where('isactive', '0')->where('parent_product',0)->orderBy('id','DESC')->take(2)->get();
            return $sqlProduct;
        }
    }
    
    public static function recentProductView($pid=0) {
        $tab=new ProductViewByIP();
        $tab->product_id=$pid;
        $tab->ip=$_SERVER["REMOTE_ADDR"];
        $tab->save();
    }
    
    public static function recentProductViewShow() {
        $countProduct = ProductViewByIP::where('ip',$_SERVER["REMOTE_ADDR"])->count();
        if ($countProduct != 0) {
            $sqlProduct =DB::table('product_view_by_i_ps')
                             ->where('product_view_by_i_ps.ip',$_SERVER["REMOTE_ADDR"])
                             ->join('products','product_view_by_i_ps.product_id','=','products.id')
                             ->select(DB::Raw('products.*'))
                             ->orderBy('product_view_by_i_ps.id','DESC')
                             ->groupBy('product_view_by_i_ps.product_id')
                             ->take(2)
                             ->get();
            
            
            ///$sqlProduct = Product::where('isactive', '0')->where('parent_product',0)->orderBy('id','DESC')->take(2)->get();
            $retArr=array('total'=>count($sqlProduct),'data'=>$sqlProduct);
            return $retArr;
        }
    }
    
    public static function QRCode() {
        $countProduct = QRCode::count();
        if ($countProduct != 0) {
            $sqlProduct = QRCode::find(1);
            return $sqlProduct;
        }
    }

    public static function shoppingCart() {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        $array=[
            'products' => $cart->items,
            'totalQty' => $cart->totalQty,
            'totalPrice' => $cart->totalPrice
        ];
        
        if (isset($array)) {
            return $array;
        }
    }
    
    
    public static function siteBasic()
    {
            $language = Language::all();
            $currency = Currency::all();

            $cs = CustomerSupport::all();
            $cde = ContactDetail::all();

            //$subcat=SubCategory::all();
            $cat = category::take(2)->get();

            $cats = category::all();
            $brn = Brand::all();
            $seo = Seo::all();
        
        
            $arr=
            [
            'language' => $language,
            'currency' => $currency,
            'cussup' => $cs,
            'csudet' => $cde,
            'seo' => $seo,
            'cat' => $cat,
            'brn' => $brn,
            'cats' => $cats
            ];
            
            return $arr;
    }
    
    public static function showSubCategory($cid=0)
    {
        $tab=SubCategory::where('category_id',$cid)->get();
        return $tab;
    }
    
    
    
    

}
