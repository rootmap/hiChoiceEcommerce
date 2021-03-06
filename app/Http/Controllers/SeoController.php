<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File;
use App\Seo;
class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat=Seo::all();
        if(count($cat)!=0)
        {
            return view('seo.index',['data'=>$cat]);
        }
        else
        {
            return view('seo.index',['data'=>array()]);
        }
        
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
        ]);

        //echo $request->name;
        //exit();
        
        $site_logo = "";
        if (!empty($request->file('logo'))) {
            $img = $request->file('logo');
            $upload = 'upload\logo';
            //$filename=$img->getClientOriginalName();
            $site_logo = time() . "L." . $img->getClientOriginalExtension();
            $img->move($upload, $site_logo);
        }

        $cat=new Seo;
        $cat->name=$request->name;
        $cat->meta=$request->meta;
        $cat->site_logo=$site_logo;
        $cat->description=$request->description;
        $cat->save();

        return redirect()->action("SeoController@index")->with('status', 'Seo info Modified successfully!');

    }

    public function showjson()
    {
        $json =Category::all();

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
        $json=Category::find($id);
        return view('category.edit',['data'=>$json]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
        ]);

        $site_logo = "";
        if (!empty($request->file('logo'))) {
            $img = $request->file('logo');
            $upload = 'upload\logo';
            //$filename=$img->getClientOriginalName();
            $site_logo = time() . "L." . $img->getClientOriginalExtension();
            $img->move($upload, $site_logo);
        }
        
        if(empty($site_logo))
        {
            $site_logo=$request->exlogo;
        }

        $id=$request->id;
        $cat=Seo::find($id);
        $cat->name=$request->name;
        $cat->meta=$request->meta;
        $cat->site_logo=$site_logo;
        $cat->description=$request->description;
        $cat->save();

        //echo 1;

        //\Session::flash('message','Record Successfullu Updated.');
        //    return redirect()->action("ProjectController@index");

        return redirect()->action("SeoController@index")->with('status', 'Seo info Modified successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $json=Category::find($id);
        $json->delete();
        return response()->json(1);
    }
}
