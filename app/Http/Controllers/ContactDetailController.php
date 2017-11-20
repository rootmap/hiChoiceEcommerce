<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ContactDetail;

class ContactDetailController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $cat = ContactDetail::all();
        if (isset($cat)) {
            return view('contactdetail.index', ['data' => $cat]);
        } else {
            return view('contactdetail.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {
        $this->validate($request, [
            'contact_title' => 'required',
            'contact_address' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'site_terms_condition'=>'required'
        ]);

        //echo $request->name;
        //exit();

        $cat = new ContactDetail;
        $cat->contact_title = $request->contact_title;
        $cat->contact_address = $request->contact_address;
        $cat->contact_phone = $request->contact_phone;
        $cat->contact_email = $request->contact_email;
        $cat->site_terms_condition = $request->site_terms_condition;
        $cat->save();

        return redirect()->action("ContactDetailController@index")->with('status', 'Contact detail info saved successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
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
            'id' => 'required',
            'contact_title' => 'required',
            'contact_address' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'site_terms_condition'=>'required'
        ]);

        //echo $request->name;
        //exit();

        $cat =ContactDetail::find($request->id);
        $cat->contact_title = $request->contact_title;
        $cat->contact_address = $request->contact_address;
        $cat->contact_phone = $request->contact_phone;
        $cat->contact_email = $request->contact_email;
        $cat->site_terms_condition = $request->site_terms_condition;
        $cat->save();

        return redirect()->action("ContactDetailController@index")->with('status', 'Contact detail info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
