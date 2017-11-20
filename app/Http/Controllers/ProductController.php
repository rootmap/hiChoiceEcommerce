<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\category;
use App\SubCategory;
use App\Brand;
use App\Tag;
use App\Product;
use App\ProductTag;
use App\ProductUnitType;
use App\ProductColor;
use App\ColorInProduct;
use Symfony\Component\HttpFoundation\File;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $cat = category::all();
        $brand = Brand::all();
        $tag = Tag::all();
        $unit = ProductUnitType::all();
        $color = ProductColor::all();
        return view('product.create', ['cat' => $cat, 'tag' => $tag, 'brand' => $brand, 'unit' => $unit, 'color' => $color]);
    }

    public function filtersubcat(Request $request) {
        $query = DB::table('sub_categories')->where('category_id', $request->cid)->get();
        return response()->json($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'pcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'cid' => 'required',
            'scid' => 'required'
        ]);
        
        $catCheck=Category::where('id',$request->cid)->where('layout',3)->count();
        if($catCheck==1)
        {
            $this->validate($request, [
                'sscid' => 'required'
            ]);
        }
        
        $bidcatCheck=Category::where('id',$request->cid)->where('layout',2)->count();
        $sidcatCheck=Category::where('id',$request->cid)->where('layout',4)->count();

        
        $iscolor = $request->iscolor ? 1 : '0';
        if ($iscolor == 1) {
            $this->validate($request, ['color_id' => 'required']);
        }

        $isunit = $request->isunit ? 1 : '0';
        if ($isunit == 1) {
            $this->validate($request, ['isunit' => 'required']);
        }

        $isactive = $request->isactive ? 1 : 0;


        $filename = "";
        if (!empty($request->file('brandimage'))) {
            $img = $request->file('brandimage');
            $upload = 'upload/product';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }

        //echo "<pre>";
        //print_r($request->unit_price);
        //exit();


        
        
            $pro = new Product;
            $pro->pcode = $request->pcode;
            $pro->name = $request->name;
            $pro->price = $request->price;
            $pro->old_price = $request->old_price;
            $pro->cid = $request->cid;

            if($sidcatCheck==0)
            {
                $pro->scid = $request->scid;
            }
            


            if($catCheck==1 && $bidcatCheck==0)
            {
                $pro->sscid = $request->sscid;
            }
            
            if($bidcatCheck==0)
            {
                $pro->bid = $request->bid;
            }



            $pro->isunit = $isunit;
            $pro->product_unit_type_id = $request->unit_type_id;
            $pro->unit = $request->unit;

            $pro->iscolor = $iscolor;

            $pro->photo = $filename;
            $pro->description = $request->description;
            $pro->isactive = $isactive;
            $pro->save();
        
        
        
        
        

        $pid = $pro->id;
        //print_r($request->tid);


        if (count($request->tid) != 0) {

            foreach ($request->tid as $index => $td):
                $protag = new ProductTag();
                $protag->pid = $pid;
                $protag->tid = $td;
                $protag->isactive = 1;
                $protag->save();
            endforeach;
        }

        if (count($request->color_id) != 0) {

            foreach ($request->color_id as $index => $td):
                $protag = new ColorInProduct();
                $protag->pid = $pid;
                $protag->color_id = $td;
                $protag->save();
            endforeach;
        }



        if (isset($request->unit_price)) {
            //print_r($request->unit_price);

            foreach ($request->unit_price as $index => $unitP):
                //echo $request->unit_names_param[$index];
                //exit();
                $pro = new Product;
                $pro->pcode = $request->pcode . "" . $index;
                $pro->name = $request->unit_names_param[$index];  //unit_names_param
                $pro->price = $unitP;
                $pro->old_price = 0;
                $pro->cid = $request->cid;
                if($sidcatCheck==0)
                {
                    $pro->scid = $request->scid;
                }

                if($catCheck==1 && $bidcatCheck==0)
                {
                    $pro->sscid = $request->sscid;
                }
                
                if($bidcatCheck==0)
                {
                    $pro->bid = $request->bid;
                }
                $pro->isunit = 0;
                $pro->product_unit_type_id = 0;
                $pro->multi_product = 1;
                $pro->parent_product = $pid;
                $pro->unit = 0;

                $pro->iscolor = $iscolor;

                $pro->photo = $filename;
                $pro->description = $request->description;
                $pro->isactive = $isactive;
                $pro->save();

                //$pid = $pro->id;
                //print_r($request->tid);


                if (count($request->tid) != 0) {

                    foreach ($request->tid as $index => $td):
                        $protag = new ProductTag();
                        $protag->pid = $pid;
                        $protag->tid = $td;
                        $protag->isactive = 1;
                        $protag->save();
                    endforeach;
                }

                if (count($request->color_id) != 0) {

                    foreach ($request->color_id as $index => $td):
                        $protag = new ColorInProduct();
                        $protag->pid = $pid;
                        $protag->color_id = $td;
                        $protag->save();
                    endforeach;
                }
            endforeach;
        }

        // exit();

        \Session::flash('status', 'Successfully Added To Product List');
        //->with('status', 'Successfully Added To Product List.')
        return redirect()->action('ProductController@index');
    }

    public function showjson() {
        $json = DB::table('products as p')
                ->leftjoin('categories as c', 'p.cid', '=', 'c.id')
                ->leftjoin('sub_categories as sc', 'p.scid', '=', 'sc.id')
                ->leftjoin('brands as b', 'p.bid', '=', 'b.id')
                ->select('p.*', 'c.name as cname', 'sc.name as scname', 'b.name as bname')
                ->where('p.multi_product', 0)
                ->orderBy('p.id', 'desc')
                ->get();

        $retarray = array("data" => $json, "total" => count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }
    
    public function SubSubCategory(Request $request) {
        $json = DB::table('categories')
                ->where('categories.id',$request->category_id)
                ->where('categories.layout',3)
                ->count();

        return response()->json($json);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }
    
    public function DedSubCategory(Request $request) {
        $json = DB::table('categories')
                ->where('categories.id',$request->category_id)
                ->where('categories.layout',2)
                ->count();

        return response()->json($json);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function DedSubCategoryShowBrand(Request $request) {
        $json = DB::table('categories')
                ->where('categories.id',$request->category_id)
                ->where('categories.layout',4)
                ->count();

        return response()->json($json);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }
    
    public function JsonSubSubCategory(Request $request) {
        $json = DB::table('sub_sub_categories')
                ->where('sub_sub_categories.category_id',$request->category_id)
                ->where('sub_sub_categories.sub_category_id',$request->sub_category_id)
                ->get();
        
        //echo "<pre>";
        //print_r($json);
        //exit();

        return response()->json($json);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $cat = category::all();
        $brand = Brand::all();
        $tag = Tag::all();
        $subcat = SubCategory::all();
        $json = Product::find($id);
        $unit = ProductUnitType::all();
        $color = ProductColor::all();

        $producttag = DB::table('product_tags as pt')
                ->select('pt.tid')
                ->where('pt.pid', '=', $id)
                ->get();
        $tpt = array();
        foreach ($producttag as $td):
            array_push($tpt, $td->tid);
        endforeach;


        $productcolor = DB::table('color_in_products as pt')
                ->select('pt.color_id')
                ->where('pt.pid', '=', $id)
                ->get();

        $tpc = array();
        foreach ($productcolor as $td):
            array_push($tpc, $td->color_id);
        endforeach;
        $child_product = array();
        $parent_id_check = Product::where('parent_product', $id)->count();
        if ($parent_id_check != 0) {
            $child_product = Product::where('parent_product', $id)->get();
        }

        $sscat=array();
        $catCheck=Category::where('id',$json->cid)->where('layout',3)->count();
        if($catCheck==1)
        {
            $sscat=DB::table('sub_sub_categories')->where('category_id',$json->cid)->where('sub_category_id',$json->scid)->get();
        }
        
        $bidcatCheck=Category::where('id',$json->cid)->where('layout',2)->count();
        $sidcatCheck=Category::where('id',$json->cid)->where('layout',4)->count();

        return view('product.edit', ['data' => $json,
            'cat' => $cat,
            'subcat' => $subcat,
            'subsubcat_active' => $catCheck,
            'bidcatCheck' => $bidcatCheck,
            'sidcatCheck' => $sidcatCheck,
            'sscat' => $sscat,
            'pt' => $tpt,
            'ptc' => $tpc,
            'tag' => $tag,
            'brand' => $brand,
            'unit' => $unit,
            'child_product' => $child_product,
            'color' => $color]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'pcode' => 'required',
            'name' => 'required',
            'price' => 'required',
            'cid' => 'required',
            'scid' => 'required'
        ]);

        // print_r($request->unit);
        //exit();
        
        $catCheck=Category::where('id',$request->cid)->where('layout',3)->count();
        if($catCheck==1)
        {
            $this->validate($request, [
                'sscid' => 'required'
            ]);
        }
        
        $bidcatCheck=Category::where('id',$request->cid)->where('layout',2)->count();
        $sidcatCheck=Category::where('id',$request->cid)->where('layout',4)->count();

        $iscolor = $request->iscolor ? 1 : '0';
//        if ($iscolor == 1) {
//            $this->validate($request, ['color_id' => 'required']);
//        }

        $isunit = $request->isunit ? 1 : '0';
//        if ($isunit == 1) {
//            $this->validate($request, ['unit' => 'required']);
//        }

        $filename = $request->exbrandimage;
        if (!empty($request->file('brandimage'))) {
            $img = $request->file('brandimage');
            $upload = 'upload/product';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }

        $isactive = $request->isactive ? 1 : 0;


        $pid = $request->id;
        $pro = Product::find($pid);
        $pro->pcode = $request->pcode;
        $pro->name = $request->name;
        $pro->price = $request->price;
        $pro->old_price = $request->old_price;
        $pro->cid = $request->cid;



        
        if($catCheck==1 && $bidcatCheck==0)
        {
            $pro->sscid = $request->sscid;
        }
        
        if($bidcatCheck==0)
        {
            $pro->bid = $request->bid;
        }
        if (!isset($request->n_id)) {

            $pro->isunit = $isunit;
            if ($isunit == 1) {
                $pro->product_unit_type_id = $request->unit_type_id;
                $pro->unit = $request->unit;
            } else {
                $pro->product_unit_type_id = 0;
                $pro->unit = "";
            }

            if ($isunit == 1) {
                $pro->iscolor = $iscolor;
            } else {
                $pro->iscolor = 0;
            }
        }

        $pro->photo = $filename;
        $pro->description = $request->description;
        $pro->isactive = $isactive;
        $pro->save();


        //print_r($request->tid);


        if (isset($request->n_id)) {
            foreach ($request->n_id as $index => $npid):
                $pron = Product::find($npid);
                $pron->pcode = $request->n_pcode[$index];
                $pron->name = $request->n_name[$index];
                $pron->price = $request->n_price[$index];
                $pron->save();
            endforeach;
        }


        if (count($request->tid) != 0) {
            $cleantag = DB::table('product_tags')->where('pid', '=', $pid)->delete();
            foreach ($request->tid as $index => $td):
                $protag = new ProductTag();
                $protag->pid = $pid;
                $protag->tid = $td;
                $protag->isactive = 1;
                $protag->save();
            endforeach;
        }

        if (count($request->color_id) != 0) {
            $cleancolor = DB::table('color_in_products')->where('pid', '=', $pid)->delete();
            foreach ($request->color_id as $index => $td):
                $protag = new ColorInProduct();
                $protag->pid = $pid;
                $protag->color_id = $td;
                $protag->save();
            endforeach;
        }


        \Session::flash('status', 'Successfully Updated To Product List');
        //->with('status', 'Successfully Added To Product List.')
        return redirect()->action('ProductController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $cleantag = DB::table('product_tags')->where('pid', '=', $id)->delete();
        $delinfo = Product::find($id);
        $delinfo->delete();
        //\Session::flash('status', 'Successfully Updated To Product List');
        //
        return response()->json(1);
    }

}
