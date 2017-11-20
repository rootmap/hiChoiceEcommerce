<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use App\category;
use Symfony\Component\HttpFoundation\File;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $this->validate($request,[
            'name'=>'required',
            'layout'=>'required',
        ]);

        //echo $request->name;
        //exit();
        
        $thumbname = "";
        if (!empty($request->file('catimage'))) {
            $img = $request->file('catimage');
            $upload = 'upload/category';
            //$filename=$img->getClientOriginalName();
            $thumbname = time() . "T." . $img->getClientOriginalExtension();
            $img->move($upload, $thumbname);
        }
        
        $bannername = "";
        if (!empty($request->file('bannerimage'))) {
            $img = $request->file('bannerimage');
            $upload = 'upload/category';
            //$filename=$img->getClientOriginalName();
            $bannername = time() . "B." . $img->getClientOriginalExtension();
            $img->move($upload, $bannername);
        }

        $cat=new category;
        $cat->name=$request->name;
        $cat->description=$request->description;
        $cat->thumb=$thumbname;
        $cat->banner=$bannername;
        $cat->layout=$request->layout;
        $cat->save();

        return redirect('admin-ecom/category')->with('status', 'Category Added!');

    }

    public function showjson()
    {
        $json =category::all();

        $retarray=array("data"=>$json,"total"=>count($json));

        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $json=category::find($id);
        return view('category.edit',['data'=>$json]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'layout'=>'required',
        ]);
        
        $thumbname = "";
        if (!empty($request->file('catimage'))) {
            $img = $request->file('catimage');
            $upload = 'upload/category';
            //$filename=$img->getClientOriginalName();
            $thumbname = time() . "T." . $img->getClientOriginalExtension();
            $img->move($upload, $thumbname);
        }
        
        $bannername = "";
        if (!empty($request->file('bannerimage'))) {
            $img = $request->file('bannerimage');
            $upload = 'upload/category';
            //$filename=$img->getClientOriginalName();
            $bannername = time() . "B." . $img->getClientOriginalExtension();
            $img->move($upload, $bannername);
        }
        
        //echo $thumbname;
        //exit();
        if(empty($thumbname))
        {
            $thumbname=$request->exthumb;
        }
        
        if(empty($bannername))
        {
            $bannername=$request->exbanner;
        }


        $id=$request->id;
        $cat=category::find($id);
        $cat->name=$request->name;
        $cat->description=$request->description;
        $cat->thumb=$thumbname;
        $cat->banner=$bannername;
        $cat->layout=$request->layout;
        $cat->save();

        //echo 1;

        //\Session::flash('message','Record Successfullu Updated.');
        //    return redirect()->action("ProjectController@index");

        return redirect('admin-ecom/category')->with('status', 'Category info Modified successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $json=category::find($id);
        $json->delete();
        return response()->json(1);
    }
}
